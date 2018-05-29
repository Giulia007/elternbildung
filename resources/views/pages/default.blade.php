@extends('layouts.app')
@section('title', $page['title']['rendered'])
@section('content')
<div class="row">
    <div class="col-12">
        <h1>{{ $page['title']['rendered'] }}</h1>
        
            <div id="content" class="text-justify">
                {!! $page['content']['rendered'] !!}

                @if (isset($organisationen))
                  <div class="map">
                      <script type="text/javascript" language="javascript">
                          $(document).ready(function(){
                              $("#austriaMap area").hover(
                                  function () {
                                      $("#austriaMapImage").attr("src", "http://www.elternbildung.or.at/images/site/" + $(this).attr("id") + ".png");
                                  },
                                  function () {
                                      $("#austriaMapImage").attr("src", "http://www.elternbildung.or.at/images/site/" + $("#austriaMapImage").attr("rel"));
                                  }
                              );
                          });
                      </script>
                      <img alt="image" id="austriaMapImage" src="http://www.elternbildung.or.at/images/site/map_austria_all.png" width="500" height="261" border="0" usemap="#austriaMap" rel="map_austria_all.png">
                      <map name="austriaMap" id="austriaMap">
                          <area href="/kontakt/burgenland" target="_blank" id="map_austria_bgld" shape="poly" coords="502,91,504,130,465,135,476,149,462,199,430,215,437,187,431,168,451,147,449,118,484,91" title="Burgenland" alt="Burgenland">
                          <area href="http://www.elternbildung.or.at/elternbildung/kontakt/steiermark" target="_blank" id="map_austria_stmk" shape="poly" coords="437,186,429,167,440,158,387,118,349,134,343,126,303,134,278,129,280,152,268,158,269,174,281,169,293,187,283,211,307,196,336,199,362,201,363,236,429,234" title="Steiermark" alt="Steiermark">
                          <area href="http://www.elternbildung.or.at/elternbildung/kontakt/wien" target="_blank" id="map_austria_wien" shape="poly" coords="474,87,463,66,446,60,438,66,430,75,434,89,449,94" title="Wien" alt="Wien">
                          <area href="http://www.elternbildung.or.at/elternbildung/kontakt/niederoesterreich" target="_blank" id="map_austria_noe" shape="poly" coords="481,28,493,33,496,41,485,65,464,66,445,59,428,80,443,93,473,89,464,67,487,65,501,92,482,91,450,118,452,145,438,157,386,117,348,134,343,104,329,102,328,78,363,77,342,38,362,1,389,4,420,18,451,27,463,19" title="Niederösterreich" alt="Niederösterreich">
                          <area href="http://www.elternbildung.or.at/elternbildung/kontakt/oberoesterreich" target="_blank" id="map_austria_ooe" shape="poly" coords="314,42,344,40,363,77,329,79,327,89,331,103,346,107,347,129,301,134,286,129,277,129,280,151,268,158,255,119,247,101,219,99,211,90,251,61,285,24" title="Oberösterreich" alt="Oberösterreich">
                          <area href="http://www.elternbildung.or.at/elternbildung/kontakt/kaernten" target="_blank" id="map_austria_ktn" shape="poly" coords="361,200,362,234,333,261,217,237,210,231,228,220,210,191,236,200,260,191,286,209,309,195" title="Kärnten" alt="Kärnten">
                          <area href="http://www.elternbildung.or.at/elternbildung/kontakt/salzburg" target="_blank" id="map_austria_sbg" shape="poly" coords="246,101,268,155,269,176,281,169,293,183,285,210,260,190,237,203,208,187,173,191,171,173,210,158,199,137,213,134,237,155,219,99" title="Salzburg" alt="Salzburg">
                          <area href="http://www.elternbildung.or.at/elternbildung/kontakt/vorarlberg" target="_blank" id="map_austria_vlbg" shape="poly" coords="45,164,37,216,4,192,1,152,16,143,31,151" title="Vorarlberg" alt="Vorarlberg">
                          <area href="http://www.elternbildung.or.at/elternbildung/kontakt/tirol" target="_blank" id="map_austria_tir" shape="poly" coords="46,171,57,167,64,145,111,153,170,134,196,131,211,156,170,174,172,190,208,187,229,220,209,231,198,238,176,212,177,193,146,203,111,204,98,227,60,212,37,217" title="Tirol" alt="Tirol">
                      </map>
                      <div style="display:none;" class="hidden_preload">
                          <img alt="image" src="http://www.elternbildung.or.at/images/site/map_austria_bgld.png">
                          <img alt="image" src="http://www.elternbildung.or.at/images/site/map_austria_stmk.png">
                          <img alt="image" src="http://www.elternbildung.or.at/images/site/map_austria_wien.png">
                          <img alt="image" src="http://www.elternbildung.or.at/images/site/map_austria_noe.png">
                          <img alt="image" src="http://www.elternbildung.or.at/images/site/map_austria_ooe.png">
                          <img alt="image" src="http://www.elternbildung.or.at/images/site/map_austria_ktn.png">
                          <img alt="image" src="http://www.elternbildung.or.at/images/site/map_austria_sbg.png">
                          <img alt="image" src="http://www.elternbildung.or.at/images/site/map_austria_vlbg.png">
                          <img alt="image" src="http://www.elternbildung.or.at/images/site/map_austria_tir.png">
                          <img alt="image" src="http://www.elternbildung.or.at/images/site/map_austria_all.png">
                      </div>
                  </div>

                  @endif
            </div>
        </div>
    </div>

@endsection