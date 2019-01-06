<div class="footer">
	<div class="container">
		<div class="col-md-6">
			<p class="share">
				<i>Share: </i>
				@if($mainShares)
            @foreach($mainShares as $share)
                <a href="{{$share->url}}{{Request::url()}}"><i class="{{$share->class}} img-circle"></i></a>
            @endforeach
        @endif
        </p>
        <p>
        @if(Auth::check())
            @if(Auth::guest())
                <a href="/login">LOGIN</a> |
                <a href="/Register">REGISTER</a> |
            @endif
        @endif
        @foreach($navMenus->where('parent_id',0) as $menu)
        	<a href="{{$menu->slug}}">{{$menu->menu}}</a> |
        @endforeach
				</p>
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