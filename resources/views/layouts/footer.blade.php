<div class="footer">
	<div class="container">
		<div class="col-md-6">
			<p class="share">
				<i>Share : </i>
				@if($mainShares)
                    @foreach($mainShares as $share)
                        <a href="{{$share->url}}{{Request::url()}}"><i class="{{$share->class}} img-circle"></i></a>
                    @endforeach
                @endif
            </p>
            <div class="footerMenu">
                <p>| <a href="/">HOME</a></p>
                @if(Auth::guest())
                    <p>| <a href="/login">LOGIN</a></p>
                    <p>| <a href="/register">REGISTER</a></p>
                @endif
                @foreach($mainMenus->where('parent_id',0) as $menu)
                	<p>| <a href="/{{$menu->slug}}">{{$menu->name}}</a></p>
                @endforeach
                @if($mainTag)
                	<p>| <a href="/page/{{$mainTag->slug}}">{{$mainTag->name}}</a></p>
                @endif
                @if($mainStore)
                	<p>| <a href="/all/{{$mainStore->slug}}">{{$mainStore->name}}</a></p>
                @endif
                @if(Auth::check())
                    @if(Auth::user())
                        <p>| <a href="/user/{{Auth::user()->slug}}">PROFIL</a></p>
                        <p>| <a href="{{ url('/logout') }}">LOGOUT</a></p>
                    @endif
                @endif
    		</div>
		</div>
		<div class="col-md-6">
			<div class="pull-right">
				<p><i>Copyright &copy; 2019 
					<b><a href="/">Rarakirana</a></b>, All Rights Reserved.</i>
				</p>
				<p class="text-center">
					<small>by <a href="mailto:heryfidiawan07@gmail.com"><i><b>Hery_Dev__</b></i></a></small>
				</p>
			</div>
		</div>
	</div>
</div>