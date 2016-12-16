<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title','To Do List')
    </title>

    <meta charset='utf-8'>

    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='/css/nav.css' type='text/css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/lumen/bootstrap.min.css' rel='stylesheet'>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>




        @yield('head')

</head>
<body>

<nav id= 'nav'>
  <!-- Dropdown -->

      <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="#">To Do List</a>
      </div>
      <ul class="nav navbar-nav">
        @if(Auth::check())
        <li class="active"><a href="/">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="/show">View Tasks
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href='/show'>View All Tasks</a></li>
              <li><a href='/show/incomplete'>View Incomplete Tasks only</a></li>
              <li><a href='/show/complete'>View Completed Tasks only</a></li>
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
    <!--
    <section>
        {{-- Main page content will be yielded here --}}
        @yield('ipsum')
    </section>
    <section>
      @yield('name')
    </section>
    <section>
      @yield('landing')
    </section>
  -->
    @yield('body')
</body>

</html>
