<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getFromWP($url)
    {
        if(strpos($url, '?'))
            $url .= '&_embed=true';
        else
            $url .= '?_embed=true';

        $wordpress_url = 'http://wordpress-75836-419934.cloudwaysapps.com/wp-json/wp/v2/' . $url;
        $minutes_in_cache = 0;

        $wordpress_response = Cache::remember($url, $minutes_in_cache, function () use ($wordpress_url) {
            return json_decode(file_get_contents($wordpress_url), TRUE);
        });

        return collect($wordpress_response); 
    }
}
