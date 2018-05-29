<div class="sticky-top mt-4" id="article_accordion">
    <div class="mobile-background"></div>
    <a class="rounded p-2" id="accordion_toggle">show details</a>
    <div id="accordion" class="slide-in-on-mobile">
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                   title="Inhaltsverzeichnis">
                    Inhaltsverzeichnis
                </a>
            </div>
            <div id="collapseOne" class="collapse show">
                <div class="card-body toc">
                    {!! $table_of_contents !!}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    Autor
                </a>
            </div>
            <div id="collapseTwo" class="collapse">
                <div class="card-body">
                    <h5><img src="{{ $author['avatar_urls'][48]}}" id="avatar_img"> {{  $author['name'] }}</h5>
                    <small> {{ $author['description'] }}</small>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                   title="Informationen zum Artikel">
                    Informationen zum Artikel
                </a>
            </div>
            <div id="collapseThree" class="collapse">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li id="number_words">{{ $stats['number_words'] }} Wörter</li>
                        <li id="reading_time">{{ $stats['reading_time'] }} Minuten Lesen</li>
                        <li id="number_images">{{ $stats['number_images'] }} Bilder</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                   title="Waitere Informationen">
                    Weitere Informationen
                </a>
            </div>
            <div id="collapseFour" class="collapse">
                <div class="card-body">
                    @if($meta_info['video'])
                        @include('includes.accordion_links', [
                                  'items' => $meta_info['video'],
                                  'icon' => "icons/web_video_g.svg",
                                  'link_definition' => 'Video'
                              ])
                    @endif
                    @if($meta_info['link'])
                        @include('includes.accordion_links', [
                                  'items' => $meta_info['link'],
                                  'icon' => "icons/web_link_g.svg",
                                  'link_definition' => 'Artikel'
                              ])
                    @endif
                    @if($meta_info['pdf'])
                        @include('includes.accordion_links', [
                                  'items' => $meta_info['pdf'],
                                  'icon' => "icons/web_pdf_g.svg",
                                  'link_definition' => 'PDF'
                              ])
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                   title="Sehschwäche Hilfe">
                    Sehschwäche Hilfe
                </a>
            </div>
            <div id="collapseFive" class="collapse">
                <div class="card-body">
                    <span>Schriftgröße</span>
                    <span id="font_minus" onclick="resizeText(-1)"><i
                                class="accordion_hover fa fa-minus-circle"></i></span>
                    <span id="font_plus" onclick="resizeText(1)"><i
                                class="accordion_hover fa fa-plus-circle"></i></span>
                    <br>
                    <span>Schriftfarbe</span>
                    <span class="circle black accordion_hover" onclick="changeTexColour('black');"></span>
                    <span class="circle white accordion_hover" onclick="changeTexColour('white');"></span>
                    <span class="circle yellow accordion_hover" onclick="changeTexColour('yellow');"></span>
                    <span class="circle blue accordion_hover" onclick="changeTexColour('blue');"></span>
                    <br>
                    <span>Hintergrundfarbe</span>
                    <span class="circle black accordion_hover" onclick="changeBackground('black');"> </span>
                    <span class="circle white accordion_hover" onclick="changeBackground('white');"> </span>
                    <span class="circle yellow accordion_hover" onclick="changeBackground('yellow');"> </span>
                    <span class="circle blue accordion_hover" onclick="changeBackground('blue');"> </span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseSix"
                   title="PDF Download & Drucken">
                    PDF Download & Drucken
                </a>
            </div>
            <div id="collapseSix" class="collapse">
                <div class="card-body">
                    <a href="{{ action('ContentController@download', $article['id']) }}">
                        <i class="fa fa-download accordion_hover"></i>Artikel Download</a>
                </div>
            </div>
        </div>
    </div>
</div>