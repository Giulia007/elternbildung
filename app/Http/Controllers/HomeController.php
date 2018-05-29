<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latest = $this->getFromWp('posts?per_page=30');

        $fur_elternbilder = $latest->filter(function ($article, $key) {
            return in_array(35, $article['categories']);
        });

        $fur_leiter = $latest->filter(function ($article, $key) {
            return in_array(23, $article['categories']);
        });

        //get post which contains video to be displayed in the center of the homepage
        $fixed_arr = $this->getFromWP('posts?slug=home_fixed');
        $fixed = $fixed_arr[0];

        $paid = $latest->filter(function ($article, $key) {
            return in_array(25, $article['tags']);
        });

        $free = $latest->reject(function ($article, $key) {
            return in_array(25, $article['tags']);
        });

        $searchbar = true;

        return view('pages.home', compact('paid', 'free', 'latest', 'fur_elternbilder', 'fur_leiter',
             'fixed', 'searchbar'));
    }

}
