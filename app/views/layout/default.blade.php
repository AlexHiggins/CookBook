<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Laravel Cookbook</title>
  {{ HTML::style('css/app.css') }}

  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

@include('layout.header')
@include('partials.notifications')

<div class="container title-container">
	<div class="row">
		<div class="col-md-8">
			@include('partials.title')
		</div>
		<div class="col-md-4">
			@yield('search')
		</div>
	</div>
</div>

@yield('content')
@include('layout.footer')

{{ HTML::script('js/all.min.js') }}
@section('js')
@show

</body>
</html>
