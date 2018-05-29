@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Suchergebnis für {{ $search['keyword'] }}</h1>
        
        @include('includes.articles_list')
    </div>
</div>
@endsection