<div class="teaser_image">
    <a href="{{ url('post/' . $article['slug']) }}">
        <img src="{{ $article['featured_media'] > 1 ? $article['_embedded']['wp:featuredmedia'][0]['media_details']['sizes']['medium_large']['source_url'] : asset('images/block 1 home.jpg')}}" class="background_image">
        @include('includes.icon', [
            'icon_list' => $article['tags']
        ])
        <div class="teaser">
            <h3>{!! $article['title']['rendered'] !!}</h3>
            {!! $article['excerpt']['rendered'] !!}
        </div>
    </a>
</div>