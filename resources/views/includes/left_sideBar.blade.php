<div class="leftbar_wrapper teaser_list below_header" id="categories_bar">
    <div class="list_header">
       <h5>Kategorien</h5>
    </div>
    <ul class="list-unstyled">
        @foreach ($categories as $category)
            <li class="leftbar-link beige_dark_lighter">
                <a href="{{ route('categories', ['category_id' => $category['id'], 'category_name'=> $category['name']])}}">{{ $category['name'] }}</a>
            </li>
        @endforeach
    </ul>
</div>
