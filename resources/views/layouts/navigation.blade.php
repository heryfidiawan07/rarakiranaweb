<div class="header">
    <div class="container">
        <p class="appName"><a href="/">Rarakirana</a></p>
        @if($mainLogo)
            <p><i>{{$mainLogo->title}}</i></p>
        @endif
        <form class="form-inline" action="/search" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <div class="input-group">
                      <input type="text" class="form-control" name="val" placeholder="search" required>
                      <div class="input-group-addon"><button class="glyphicon glyphicon-search" id="btnSearch"></button></div>
                </div>
            </div>
        </form>
        <p class="pull-right">
            <i>Follow : </i>
            @if($mainFollows)
                @foreach($mainFollows as $follow)
                    <i class="{{$follow->class}} img-circle"></i>
                @endforeach
            @endif
        </p>
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
                @if($mainMenus->count())
                    @foreach($mainMenus->where('parent_id',0) as $menu)
                        <li><a href="/{{$menu->slug}}" class="text-capitalize"><b>{{$menu->name}}</b></a></li>
                    @endforeach
                @endif
                @if($mainTag)
                    <li><a href="/page/{{$mainTag->slug}}" class="text-capitalize"><b>{{$mainTag->name}}</b></a></li>
                @endif
                @if($mainStore)
                    <li><a href="/all/{{$mainStore->slug}}" class="text-capitalize"><b>{{$mainStore->name}}</b></a></li>
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
                    @if(Auth::check())
                        @if(Auth::user())
                            <li><a href="/user/{{Auth::user()->slug}}"><b>PROFIL</b></a></li>
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
