@extends('app')

@section('title')
Усі {{Session::get('page')}} уроки
@stop

@section(Session::get('page')) 
	active
@stop
@section('content')
	@if (Auth::check())
	<?php $j=1;?>
	<h4 align=center>Курс <span class="upper">{{Session::get('page')}}</span></h4>
		@if(count($allLessons)==0)
			<p><i class="icon-info-sign"></i> Уроків ще немає</p>
		@else
		@foreach($allLessons as $currlesson)
			<article class="lesson">
				<a href="{{route('viewLesson',$currlesson)}}"><h4 class="title">{{$currlesson->Header }}</h4></a>
				<p>{{ $currlesson->about_article }}</p>
				<ul>
					@foreach ($currlesson->tasks as $t)
					<li><a href="{{route('viewTask',$t)}}">Завдання №{{$j}}</a></li>
						<?php $j++;?>
					@endforeach
				</ul>
			</article>
			<?php $j=1;?>
		@endforeach
			<div class="pag">{!! $allLessons->links() !!}</div>
		@endif
	@stop
	@section ('scripts')
		@if(Session::has('success'))
			<script src="/assets/js/bootstrap-dialog.min.js"></script>
			<script>
			$( document ).ready(function() {
				BootstrapDialog.show({
					title: 'Завдання',
					message: {!!Session::get('success')!!},
					type: {!!Session::get('type')!!},
					buttons: [{
					label: 'Ок',
					action: function(dialog) {
						dialog.close();
					}
					}
					@if(Session::has('repeat'))
					, {
						{{Session::forget('repeat')}}
						label: 'Пройти повторно',	 
						action: function() {
							history.go(-1);
						}	  
					} 
					@endif
					]
				});	
			});
			</script>
		@endif
	@endif
	@if(Auth::guest())
		<div class="guest">
			<h3>Контент буде доступний після авторизації</h3>
			<a href="{{ url('/auth/login') }}">Вхід</a>
			<p>Ще досі не з нами?</p>
			<a href="{{ url('/auth/register') }}">Реєстрація</a>
		</div>	
	@endif
@stop