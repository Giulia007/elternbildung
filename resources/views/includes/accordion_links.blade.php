@foreach($items as $item)
    <a href="{{ $item }}" class="d-block p-2 " target="_blank" title="Link zu {{ $link_definition }} " >

    @if($items === $meta_info['pdf'])
        @php
            $pos = strrpos($item, '/');
            $title_string = $pos === false ? $item : substr($item, $pos + 1);
            $title_pdf = ucwords(str_replace("-", " ", $title_string));
            $title = preg_replace('/\\.[^.\\s]{3,4}$/', '', $title_pdf);
        @endphp
        <div>
            <img src="{{asset($icon)}}">
            <span class="">{{ $title }}</span>
        </div>

    @endif
        @unless($items === $meta_info['pdf'])
            <img src="{{asset($icon)}}"><span class=""> {{ $link_definition }}</span>
        @endunless
</a>
@endforeach
