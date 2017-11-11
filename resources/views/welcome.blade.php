@extends('app')

@section('content')
<div class="container welcome">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
			<div class="item active">
			  <img src="/assets/img/c1.jpg" alt="html">
			</div>

			<div class="item">
			  <img src="/assets/img/c2.jpg" alt="test">
			</div>

			<div class="item">
			  <img src="/assets/img/c3.jpg" alt="cabinet">
			</div>
			  
			<div class="item">
			  <img src="/assets/img/c4.jpg" alt="lesson">
			</div>
		  </div>

		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Попередній</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Наступний</span>
		  </a>
		</div>
		
			<img src="/assets/img/struct.jpg" class="adaptive">
		
</div>
@endsection
