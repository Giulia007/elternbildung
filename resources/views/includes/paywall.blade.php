<div class="row justify-content-center">
    <div class="col-12">
        IN DIESEM ARTIKEL
        <hr />
    </div>
    <div class="col-4 text-center">
        <img src="{{asset('icons/clock.svg')}}" class="paywall_icon p-2"><br/>
        {{ $stats['reading_time'] }} Minuten Lesen
    </div>
    <div class="col-4 text-center">
        <img src="{{asset('icons/document.svg')}}" class="paywall_icon p-1"><br/>
        {{ $stats['number_words'] }} Wörter

    </div>
    <div class="col-4 text-center">
        <img src="{{asset('icons/picture.svg')}}" class="paywall_icon p-1"><br/>
        {{ $stats['number_images'] }} Bilder
    </div>
    <div class="col-12 mt-4">
        <a href="{{ route('membership') }}" class='btn btn-success btn-lg btn-block'>Jahresabo für 29€ kaufen</a>

        @unless (Auth::check())
        <a href="{{ route('membership') }}" class='btn btn-secondary btn-lg btn-block'>Gutschein einlösen</a>
        @endunless

        @auth
        <a href="" class='btn btn-secondary btn-lg btn-block' data-toggle="modal" data-target="#voucherModal">Gutschein einlösen</a>
        @endauth


        <a href="{{ route('paypal.express-checkout') }}" class='btn btn-outline-secondary btn-lg btn-block'>Artikel für 2,90€ kaufen</a>
    </div>
</div>

@include('includes/gutshein_modal')