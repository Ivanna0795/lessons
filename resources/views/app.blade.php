<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>
	  <link href='https://fonts.googleapis.com/css?family=Merriweather&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css/main.css" rel="stylesheet">
	
	<link href="/assets/css/bootstrap-dialog.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/assets/img/brand.png"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="@yield('main')"><a href="/">Головна</a></li>
              <li class="@yield('html')"><a href="{{ url('/html/') }}">Уроки HTML</a></li>
              <li class="@yield('css')"><a href="{{ url('/css/') }}">Уроки CSS</a></li>
              <li class="@yield('about')"><a href="{{ url('/about/') }}">Про нас</a></li>
              @if (Auth::guest())
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						Вхід <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ url('/login') }}">Вхід</a></li>
					<li><a href="{{ url('/register') }}">Реєстрація</a></li>
				</ul>
			  </li>
			  @else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						{{ Auth::user()->name }} <span class="caret"></span>
					</a>

					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('/cabinet') }}">Кабінет</a></li>
						<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Вихід</a></li>
					</ul>
				</li>
             @endif
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      @yield('content')
	  <footer>
	  	<div class="row">
			<div class="col-sm-4">
				<a href="/"><img src="/assets/img/brand.png"></a>
			</div>  
			<div class="col-sm-4">
				<ul>
					<a href="/html/"><li>Всі курси HTML</li></a>
					<a href="/css/"><li>Всі курси CSS</li></a>
					<a href="/about/"><li>Про нас</li></a>
				</ul>
			</div>  
			<div class="col-sm-4">
			</div>  
		</div>
	  </footer>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
	@yield('scripts')
  </body>
</html>
