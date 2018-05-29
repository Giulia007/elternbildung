<!DOCTYPE html>

<html>

<head>
    <title>{{ $article['title']['rendered'] }}</title>
</head>

<body style="font-family: Tahoma, Helvetica, Arial">

<div class="container">
    <div class="row">
        <div class="col md 12">
                <div class="col-md-6">
                    <img src="{{asset('images/Logo_Elternbildung.png')}}" style="width: 40%; margin-bottom: 1rem;">
                </div>
                <div class="col-md-6">
                    <h3>{{ $article['title']['rendered'] }}</h3>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $article['content']['rendered'] !!}
        </div>
    </div>
</div>

</body>

</html>