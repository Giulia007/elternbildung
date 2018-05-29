<div class="articles_list">
    @foreach ($articles as $article)
    <div class="row mb-4">
        <div class="col-xs-12 col-sm-3 col-md-3 pr-0">
            <a href="{!! url("/post/".$article['slug']); !!}">
                <img src="{{ $article['featured_media'] > 1 ? $article['_embedded']['wp:featuredmedia'][0]['media_details']
                ['sizes']['medium']['source_url'] : asset('images/block 1 home.jpg') }}" class="img-responsive img-box img-thumbnail">
                @include('includes.icon', [
                    'icon_list' => $article['tags']
                ])
            </a>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9">
            <h4>{{ $article['title']['rendered'] }}</h4>
            <p>{!! $article['excerpt']['rendered'] !!}</p>
        </div>
    </div>
    @endforeach
</div>