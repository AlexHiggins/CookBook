<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Laravel Cookbook</title>
  {{ HTML::style('css/app.css') }}
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

@include('layout.header')


<div class="container">
	<div class="row">
		<div class="col-md-8">
			@include('partials.title')
		</div>
		<div class="col-md-4">
			@yield('search')
		</div>
	</div>
</div>

@include('partials.notifications')

@yield('content')

@include('layout.footer')

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>$('#flash-overlay-modal').modal();</script>
@section('js')
@show

</body>
</html>
