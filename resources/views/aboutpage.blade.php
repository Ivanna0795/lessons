@extends('app')

@section('title')
	Про нас
@stop
@section('content')
	<h3 class="about-header">{{$about->header}}</h3>
	<div class="about-content">
		{!!$about->content!!}
	</div>
@stop