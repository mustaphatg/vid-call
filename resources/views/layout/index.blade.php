<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/aos.css') }}">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Supermercado+One&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="theme-color" content="#0F071B">
	<link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
	@yield("css")
</head>

<body class="bg-app">


	<nav class="navbar  navbar-expand-md fixed-top ">
		<a href="/" class="ac navbar-brand">Vid Call</a>
		<button class="navbar-toggler " data-target="#co" data-toggle="collapse">
			<span class="fa fa-bars text-white"></span>
		</button>
		<div class="collapse navbar-collapse  " id="co">
			<ul class="nav navbar-nav ml-auto mr-5">
				<a class="nav-item nav-link" href="/">Home</a>
			</ul>
		</div>
	</nav>


	@yield("content")


	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/aos.js') }}"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
	@yield("js")
</body>

</html>