@extends('layouts.app')

@section('title', 'Elternbildung Inhaltsseiten')

@section('content')

<div class="row d-flex">
    <div class="col-lg-4 col-md-6 mt-4">
        @include('includes.teaser_list', [
            'headline' => 'Empfehlungen für Eltern Kind GruppenleiterInnen',
            'list' => $fur_leiter->take(6)
        ])
    </div>
    <div class="col-lg-4 col-md-6 mt-4">
        @include('includes.teaser_fixed', [
            'article' => $fixed
        ])
    </div>
    <div class="col-lg-4 col-md-6 mt-4">
        @include('includes.teaser_list', [
            'headline' => 'Empfehlungen für ElternbildnerInnen',
            'list' => $fur_elternbilder->take(6)
        ])
    </div>
    <div class="col-lg-8 col-md-6 mt-4">
        @include('includes.teaser_image', [
            'article' => $latest->get(9)
        ])
    </div>
    <div class="col-lg-4 col-sm-12 mt-4">
        @include('includes.teaser_image', [
            'article' => $latest->get(2)
        ])
    </div>
</div>
@endsection