<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Comment;
use App\User;
use PDF;


class ContentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showArticle(Request $request, $slug)
    {
        $article = $this->getFromWp('posts?per_page=50')->where('slug', $slug)->first();

        //get meta info for accordion Weitere Informationen section
       $meta_info = $article['meta'];

        if (!$article)
            return abort(404);

        $article_body = $article['content']['rendered'];

        $table_of_contents = "<small>Kein Inhaltsverzeichnis</small>";

        // Table of Contents (only when it has content)
        if(strlen($article_body) > 10) {
            $markupFixer  = new \TOC\MarkupFixer();
            $tocGenerator = new \TOC\TocGenerator();
            $article_body = $markupFixer->fix($article['content']['rendered']);
            $table_of_contents = $tocGenerator->getHtmlMenu($article_body);
        }

        $author     = $this->getFromWp('users/' . $article['author']);
        $stats      = $this->getStats($article_body);
        $categories = $this->getFromWp('categories')->reject(function ($value, $key) {
            return $value['name'] == 'Uncategorized';
        });
        $comments   = Comment::where('article_id', $article['id'])
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $private_notes = $comments->reject(function($value){return $value['private_note'] == null;});
        $comments_only = $comments->reject(function($value){return $value['comment'] == null;});

        //render highlighted selections
        foreach ($comments as $comment) {
                //highlight only
            if ($comment->highlight) {

                $article_body = str_replace(
                    $comment->selection,
                    '<span class="highlight_yellow" title="' .
                        $comment->comment . 
                        '">' . 
                        $comment->selection . 
                    '</span>',
                    $article_body
                );

                //comment is a comment plus highlight
            } elseif ($comment->comment) {
                $article_body = str_replace(
                    $comment->selection,
                    '<span 
                            class="highlight_blue" data-comment_text="' . $comment->comment .
                    '" data-comment_id=" ' . $comment->id .
                    ' " id="'.$comment->id.'" >' .
                    $comment->selection .
                    '</span>',
                    $article_body
                );
            }
        }

        $pen_icon_src = asset('icons/pen50px.PNG');

        $searchbar = null;
        return view('pages.article.detail', compact(
            'article', 'article_body', 'author', 'stats', 'categories', 'comments', 'private_notes',
                    'comments_only', 'table_of_contents', 'searchbar', 'pen_icon_src', 'meta_info'
        ));
    }


    public function download($article_id, Request $request)
    {
        $user = Auth::user();

        $article = $this->getFromWp('posts?per_page=50')->where('id', $article_id)->first();
        $pdf = PDF::loadView('layouts.pdf', compact('article'));

        // check if free article
        if (!in_array(25, $article['tags']))
            return $pdf->download($article['title']['rendered'] . '.pdf');


        //check if article exists and user is logged in
        if (!$article)
            return abort(404, 'Artikel nicht gefunden.');
        if (!$user)
            return abort(403, 'Benutzer nicht eingeloggt.');

        // check if user has permission
        if (!$user->hasAccessToArticle($article_id))
            return abort(403, 'BenutzerIn hat keinen Zugriff auf den Artikel.');

        //download
        return $pdf->download($article['title']['rendered'] . '.pdf');

    }

    public function download_invoice($invoice_id, Request $request) {

        $user = Auth::user();
        $invoice = $user->invoices()->where('id', $invoice_id)->first();
        if($invoice) {
            $invoice_pdf = PDF::loadView('layouts.invoice', compact('invoice'));
            //download
            return $invoice_pdf->download('invoice#' .$invoice->id. '.pdf');
        }
        return abort(404, 'Rechnung nicht verfügbar.');
    }


    public function showArticlesPerCategory($category_name, $category_id)
    {
        //get categories for left sidebar
        $categories = $this->getFromWp('categories')->reject(function ($value, $key) {
            return $value['name'] == 'Uncategorized';
        });

        $articles = $this->getFromWp('posts?per_page=50')->filter(function ($article, $key) use ($category_id) {
            return in_array($category_id, $article['categories']);
        });

        $searchbar = null;
        return view('pages.article.posts_by_category', compact('articles', 'category_name', 'categories', 'searchbar'));
    }

    public function getPage(Request $request, $slug)
    {
        $page = $this->getFromWp('pages?per_page=50')->where('slug', $slug)->first();

        // throw 404 if we don't find one
        if (!$page)
            return abort(404);

        if ($request->is('pages/organisationen')) {
            $organisationen = true;
        }

        $searchbar = null;

        return view('pages.default', compact('page', 'searchbar', 'organisationen'));
    }


    public function searchByKeyword(Request $request)
    {
        $search = $request->validate([
            'keyword' => 'required'
        ]);

        $articles = $this->getFromWp('posts?search=' . $search['keyword']);

        return view('pages.search_result', compact('search', 'articles'));
    }

    // prepare stats of article
    private function getStats($article_body)
    {
        $stats = [];

        //get number of images in the article
        preg_match('/(<img[^>]+>)/i', $article_body, $matches);
        $stats['number_images'] = count($matches);

        //count words and calculate reading time (based on average reading speed of 275 wpm)
        $stats['number_words'] = str_word_count($article_body);
        $stats['reading_time'] = ceil($stats['number_words'] / 250);

        return $stats;

    }

}

