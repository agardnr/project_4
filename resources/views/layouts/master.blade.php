<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title','To Do List')
    </title>

    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="/js/list.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href='/css/nav.css' type='text/css' rel='stylesheet'>
    <link href='/css/landing.css' type='text/css' rel='stylesheet'>

        @yield('head')

</head>
<body>

<nav id= 'nav'>
  <!-- Dropdown -->
      <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="/show">To Do List</a>
      </div>
      <ul class="nav navbar-nav">
        @if(Auth::check())
        <li class="active"><a href="/">Home</a></li>
        <li><a href='/create'>Add Task</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="/show">View Tasks
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href='/show'>View All Tasks</a></li>
              <li><a href='/show/incomplete'>View Incomplete Tasks</a></li>
              <li><a href='/show/complete'>View Completed Tasks</a></li>
            </ul>
          </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href='/logout'><span class="glyphicon glyphicon-log-out"></span> Logout </a></li>
            </ul>

          @else
            <li><a href='/'>Home</a></li>
            <li><a href='/login'><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>
            <li><a href='/register'><span class="glyphicon glyphicon-user"></span> Register</a></li>
        @endif
    </ul>
  </div>
</nav>


    <section>
        {{-- Main page content will be yielded here --}}
        @yield('task')
    </section>
    @yield('body')
</body>

</html>
