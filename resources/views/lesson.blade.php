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
@section('scripts')
	<script>
		var i=0;
		$('footer').click(function() {
			i++;
			if (i==10) {
				alert('Attention! Easter egg.');
				i=0;
			}
		});
		$('article').click(function() {
			i=0;
		});
	</script>
@stop