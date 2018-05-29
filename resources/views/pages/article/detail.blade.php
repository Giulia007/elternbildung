@extends('layouts.app')

@section('title', $article['title']['rendered'])

@php

$header_image = asset('images/block 1 home.jpg');

if($article['featured_media'] > 1) {

    if(isset($article['_embedded']['wp:featuredmedia'][0]['media_details']['sizes']['large'])) {
        $header_image = $article['_embedded']['wp:featuredmedia'][0]['media_details']['sizes']['large']['source_url'];
    } else {
        foreach( $article['_embedded']['wp:featuredmedia'][0]['media_details']['sizes'] as $sizes)
            $header_image = $sizes['source_url'];
    }
}
@endphp


@section('header_image', $header_image)

@section('bottom')
    <!-- Modal -->
    @if (request()->input('token') == md5(date('Y-m-d').'xadcetopy'))
        @include('includes.author_notes_modal', [ 'comments' => $private_notes ])
    @elseif( Auth::check() )
        @include('includes.reader_notes_modal', [ 'comments' => $private_notes->where('user_id', Auth::id()) ])

        @include('includes.reader_comments_modal', [ 'comments' => $comments_only ])
    @endif
@endsection

@section('content')

    <article class="row">
        <div class="col-lg-6 col-md-9">
            <div class="mt-4" id="article" data-id="{{ $article['id'] }}">

                @if (request()->input('token') == md5(date('Y-m-d').'xadcetopy'))

                    <a href="#" id="show_comm" onclick="toggleComments()">
                        Zeige Kommentare
                    </a>
                    <a href="#" data-toggle="modal" data-target="#modalAuthor">
                        Alle Kommentare
                    </a>
                    <a href="#" id="show_accordion" onclick="toggleAccordion()">
                        Zeige Metainfo
                    </a>
                @elseif (Auth::check() ? Auth::user()->hasAccessToArticle($article['id']) : false)
                    <div class="row">
                        {{--this button shows only on medium and large screens--}}
                        <button class="btn btn-light d-none d-md-block mr-1">
                            <a href="#" id="show_comm" onclick="toggleComments()">
                                Zeige Kommentare
                            </a>
                        </button>
                        {{--this button shows only on small screens--}}
                        <button class="btn btn-light d-block d-md-none ml-3 mr-1">
                            <a href="#" id="" data-toggle="modal" data-target="#modalReaderXs">
                                Meine Kommentare
                            </a>
                        </button>
                        <button class="btn btn-light mr-1">
                            <a href="#" id="show_comm" data-toggle="modal" data-target="#modalReader">
                                Meine Notizen
                            </a>
                        </button>
                        <button class="btn btn-light hide_on_sm mr-1">
                            <a href="#" id="show_accordion" onclick="toggleAccordion()">
                                Zeige Metainfo
                            </a>
                        </button>
                    </div>



                @endif
                    <h1>{{$article['title']['rendered']}}</h1>
                
                {{-- not a paid article --}}
                @if (! in_array(25, $article['tags']))
                    {!! $article_body !!}
                @elseif (Auth::check() ? Auth::user()->hasAccessToArticle($article['id']) : false)
                    <span id="user_id" data-user_id="{{ Auth::user()->id }}"></span>
                    {!! $article_body !!}
                @else
                    {!! $article['excerpt']['rendered'] !!}
                    @include('includes.paywall')
                @endif

                <span class="editorBar" id="editBar">
                        <a href="#"><i class="fa fa-pencil" id="edit-highlight" onclick="highlightSelection()"></i></a>
                        <a href="#"><i class="fa fa-comment" id="edit-comment" onclick="placeCommentBox(event)"></i></a>
                </span>
                <span id="comment_symbol"></span>

                @include('includes.comment_box')

            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <div class="d-none" id="pen_icon">{{ $pen_icon_src }}</div>
            <div id="comments"></div>
            <div id="notes"></div>
            @include('includes.article_accordion')
        </div>
        <div class="col-md-3 col-sm-12 order-lg-first">
            @include('includes.left_sideBar')
        </div>
    </article>
    <div hidden id="selected_text" data-selected_text="" data-selection_pos_top_plusScroll=""
         data-articleDiv_right="" data-selection_pos_top_noScroll="">
    </div>



@endsection


