<nav id="navigation" class="navbar navbar-default">
  <div class="container">

      <div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">Laravel<span class="theme-colour">Cookbook</span></a>
      </div>

      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-left ">
          <li class="hidden active"><a href="#"></a></li>
          <li class="page-scroll">{{ link_to_route('home', 'Browse') }}</li>
          <li class="page-scroll">{{ link_to_route('tag', 'Tags') }}</li>
          <li class="page-scroll">{{ link_to_route('recipe.create', 'Create New') }}</li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if(Auth::check())
            <li>{{ link_to_route('logout', 'Logout') }}</li>
          @else
            <li>{{ link_to_route('login', 'Login') }}</li>
            <li>{{ link_to_route('register', 'Register') }}</li>
          @endif
        </ul>

      </div>
  </div>
</nav>
