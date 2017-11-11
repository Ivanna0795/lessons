@extends('app')

@section('title')
{{$currlesson->Header}}
@stop
@section('hlesson')
active
@stop
@section('content')
	<article class="lesson">
		<p class="header">{{$currlesson->Header}}</p>	
		<p class="text">{!!$currlesson->article!!}</p>	
	</article>
@stop