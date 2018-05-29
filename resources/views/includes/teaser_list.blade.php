<div class="teaser_list">
    <h2>{{ $headline }}</h2>
    <ul class="">
        @foreach($list as $item)
            <li>
                @include('includes.icon', [
                    'icon_list' => $item['tags']
                ])
                <a href="{{ url('post/' . $item['slug']) }}">
                    {!! $item['title']['rendered'] !!}
                </a>
            </li>
        @endforeach
    </ul>
</div>
