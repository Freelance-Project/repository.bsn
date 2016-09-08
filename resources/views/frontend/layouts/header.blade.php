 <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BSN SEARCH</title>
<meta name="description" content="">
<meta name="_token" content="{!! csrf_token() !!}"/>
<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<!--Style-->
<link rel="stylesheet" href="{{ asset(null) }}frontend/css/reset.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">

<link rel="stylesheet" href="{{ asset(null) }}frontend/css/bootstrap.css">
<link rel="stylesheet" href="{{ asset(null) }}frontend/css/style.css">
<link rel="stylesheet" type="text/css" href="{{ asset(null) }}frontend/css/media1024.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset(null) }}frontend/css/media768.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset(null) }}frontend/css/media480.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset(null) }}frontend/css/media320.css"/>
<!--link rel="stylesheet" href="css/style-temp.css"-->
<!--js-->
<script src="{{ asset(null) }}frontend/js/vendor/jquery-1.9.1.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ asset(null) }}frontend/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script src="{{ asset(null) }}frontend/js/vendor/modernizr-2.6.2.min.js"></script>
<script src="{{ asset(null) }}frontend/js/SmoothScroll.js"></script>
<script src="{{ asset(null) }}frontend/js/bootstrap.min.js"></script>
<script src="{{ asset(null) }}frontend/js/js_lib.js"></script>
<script src="{{ asset(null) }}frontend/js/js_run.js"></script>
</head>
<body>
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]--> 

<!-- header -->
<header id="mainheader">
	<nav class="navbar navbar-default navbar-fixed-top navbar-bootsnipp ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{url('')}}"><img width="90" src="{{ asset(null) }}frontend/images/material/logo.gif"> 	</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{url('')}}">Home</a></li>
            <li><a href="{{url('request')}}">Daftar Permintaan</a></li>
            <li><a href="{{url('profile')}}">Profile</a></li>
          </ul>		
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" data-toggle="modal" data-target="#RegisterForm"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="#" data-toggle="modal" data-target="#loginForm"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</header>
<!-- end of header -->


