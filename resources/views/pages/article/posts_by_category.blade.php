@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="left_bar">
            @include('includes.left_sideBar')
        </div>
    </div>
    <div class="col-md-9">
        <h1>{{ $category_name }}</h1>
        
        @include('includes.articles_list')
    </div>
</div>
@endsection