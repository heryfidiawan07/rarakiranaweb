<div class="header">
    <div class="container">
        <p class="appName"><a href="/">Rarakirana</a></p>
        <p><i>The title of website</i></p>
        <form class="form-inline" action="/search" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <div class="input-group">
                      <input type="text" class="form-control" name="val" required>
                      <div class="input-group-addon"><button class="fa fa-search" id="btnSearch"></button></div>
                </div>
            </div>
        </form>
        <p class="pull-right"><i>Follow us :</i></p>
    </div>
</div>
<nav class="navbar navbar navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <li><a href="/"><b>HOME</b></a></li>
                @if($navMenus->count())
                    @foreach($navMenus->where('parent_id',0) as $menu)
                        <li><a href="/{{$menu->slug}}" class="text-capitalize"><b>{{$menu->menu}}</b></a></li>
                    @endforeach
                @endif
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}"><b>LOGIN</b></a></li>
                    <li><a href="{{ url('/register') }}"><b>REGISTER</b></a></li>
                @else
                    @if(Auth::check())
                        @if(Auth::user()->admin())
                            <li><a href="/dashboard"><b>DASHBOARD</b></a></li>
                        @endif
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <b>{{ Auth::user()->name }}</b> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <b>LOGOUT</b>
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
