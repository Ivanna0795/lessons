@extends('app')

@section('title')
Тест
@stop
@section('content')
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Завдання</h4>
      </div>
      <div class="modal-body">
       	<p>{{$currtest->task_text}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="history.back(); return false;">Повернутися назад</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Почати виконання</button>
      </div>
    </div>
  </div>
</div>
{!! Form::open(array('route'=>'testAnswer','class' => 'form')) !!}
<div class="row">
	{{ Form::hidden('id', $currtest->id) }}
	<div class="col-sm-6">{!! Form::textarea('content', $currtest->user_task, array('class' => 'test-input')) !!}</div>
	<div class="col-sm-6"><div class="screen"></div></div>
</div>
{!! Form::submit('Перевірити',array('class' => 'btn btn-primary send')) !!}
{!! Form::close() !!}
@stop
@section('scripts')
<script>
	 $('#myModal').modal('show');
	 $('.screen').append($('.test-input').val());
	 $('.test-input').bind('input propertychange', function() {
	 	$('.screen').empty();	$('.screen').append($('.test-input').val());
	 });
</script>
@stop