<div class="container">
    <a class="sr-only sr-only-focusable" href="#main">Zum Hauptinhalt springen</a>
    @include('layouts.navigation')
</div>
<div class="container-fluid">

    <div class="row align-items-center justify-content-center">

        <img src="@yield('header_image', asset('images/home_family_with_pc_final.png'))" alt="Familie mit PC und Büchern"
             class="header-image">


        @if(isset($searchbar))
            @include('includes/searchbar')
        @endif


    </div>
</div>



