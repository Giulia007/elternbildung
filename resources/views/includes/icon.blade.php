@php
    $paid = in_array(25, $icon_list);
@endphp
@if ($paid)
    <img src="{{asset('\icons\paid.svg')}}" class="icon">
@elseif (in_array(26, $icon_list))
    <img src="{{asset('\icons\cam.svg')}}" class="icon">
@elseif (in_array(27, $icon_list))
    <img src="{{asset('\icons\pdf.svg')}}" class="icon">
@elseif (in_array(34, $icon_list))
    <img src="{{asset('\icons\info.svg')}}" class="icon">
@else
    <img src="{{asset('\icons\info.svg')}}" class="icon">
@endif