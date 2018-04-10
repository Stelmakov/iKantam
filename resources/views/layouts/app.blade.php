<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/materialize.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/jquery.min.js" ></script>

    <script src="/assets/js/materialize.min.js"></script>
    <script src="/assets/js/script.js"></script>


</head>
<body>
<nav>
        <div class="nav-wrapper">
            <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul  class="left hide-on-med-and-down">
                <li><a href="/">Home</a></li>
                @if (!Auth::guest() && Auth::user()->isAdmin())
                    <li><a href="/add-article">Add article</a></li>
                @endif
            </ul>
                <ul  class="right hide-on-med-and-down">
                    @if (Auth::guest())
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                    @else
                        <li><a href="/logout">Sign out</a></li>
                    @endif
                </ul>

        </div>
        <ul class="sidenav" id="mobile">3
            <li><a href="/">Home</a></li>
            @if (!Auth::guest() && Auth::user()->isAdmin())
                <li><a href="/add-article">Add article</a></li>
            @endif
            @if (Auth::guest())
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            @else
                <li><a href="/logout">Sign out</a></li>
            @endif
        </ul>


</nav>
<div class="container margin-top-20">

    @yield('content')
</div>

</body>
</html>
