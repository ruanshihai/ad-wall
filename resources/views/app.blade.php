<!DOCTYPE html>  
<html lang="en">  
<head>  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AD-WALL</title>

  <link href="/css/app.css" rel="stylesheet">
  <link href="/css/custom.css" rel="stylesheet">
  <link href="/css/jquery-ui.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link href='http://fonts.useso.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
  <link href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css" rel='stylesheet' type='text/css'>

  <!-- Scripts -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>  
<body>  
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">AD-WALL</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          @if (Auth::guest())

          @elseif (Auth::user()->type == 0)
            <li><a href="/admin/home">主页</a></li>
            <li><a href="/admin/ad">广告管理</a></li>
          @elseif(Auth::user()->type == 1)
            <li><a href="/user/home">主页</a></li>
            <li><a href="/user/ad">广告管理</a></li>
          @endif
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if (Auth::guest())
            <li><a href="/auth/login">Login</a></li>
            <li><a href="/auth/register">Register</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                @if (Auth::user()->type == 0)
                  <li><a href="/admin/info">Info</a></li>
                @elseif (Auth::user()->type == 1)
                  <li><a href="/user/info">Info</a></li>
                @endif
                <li><a href="/auth/logout">Logout</a></li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  @if (strpos(URL::current(), 'admin/ad') !== false || strpos(URL::current(), 'user/ad') !== false)
    @include('sidebar')
  @else
    @yield('content') 
  @endif
  
  <div id="footer" style="text-align: center;">
    Copyright © 2015 <a href="/">AD-WALL</a> 版权所有
  </div>

</body>  
</html> 