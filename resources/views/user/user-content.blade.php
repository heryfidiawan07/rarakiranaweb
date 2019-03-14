@if(Auth::check())
	@if(Auth::user()->id == $user->id)
		@include('user.orders')
	@endif
@endif

@if($threads->count())
	<h4 class="text-center"><b>THREADS</b></h4>
	@foreach($threads as $thread)
		@include('threads.content-index')
	@endforeach
	<div class="text-center">
		<ul class="pagination pagination-sm">{{$threads->links()}}</ul>
	</div>
@endif

@if(Auth::check())
	@if(Auth::user()->id == $user->id)
		@if($thcomments->count())
			<h4 class="text-center"><b>KOMENTAR PADA THREAD</b></h4>
			@foreach($thcomments as $comment)
				<div class="thread-comment-show">
					<div class="thread-comment-body">
						<a href="/thread/{{$comment->commentable->slug}}" class="title">
							<h5><b>{{$comment->commentable->title}}</b></h5>
						</a>
						<small>
							<a href="/threads/{{$comment->commentable->tag->slug}}" class="btn btn-default btn-xs">
								{{$comment->commentable->tag->name}}
							</a>
						</small>
						- <small><i>{{ date('d F, Y', strtotime($comment->commentable->created_at))}}</i></small>
						
						<p>{!! str_limit($comment->description, 50) !!}</p>
						<div class="tag-thread-show">
							<a href="/user/{{$comment->user->slug}}">
								<img src="<?php if ($comment->user->img != null){ echo "/users/".$comment->user->img;}else if($comment->user->graph != null){echo $comment->user->graph;}else{echo $comment->user->avatar();} ?>" class="img-circle" width="30">
								{{$comment->user->name}}
							</a>
							- <small><i>{{ date('d F, Y', strtotime($comment->created_at))}}</i></small>
						</div>
					</div>
				</div>
				<hr>
			@endforeach
			<div class="text-center">
				<ul class="pagination pagination-sm">{{$thcomments->links()}}</ul>
			</div>
		@endif

		@if($artcomments->count())
			<h4 class="text-center"><b>KOMENTAR PADA POST</b></h4>
			@foreach($artcomments as $comment)
				<div class="thread-comment-show">
					<div class="thread-comment-body">
						<a href="/thread/{{$comment->commentable->slug}}" class="title">
							<h5><b>{{$comment->commentable->title}}</b></h5>
						</a>
						<small>
							<a href="/threads/{{$comment->commentable->menu->slug}}" class="btn btn-default btn-xs">
								{{$comment->commentable->menu->name}}
							</a>
						</small>
						- <small><i>{{ date('d F, Y', strtotime($comment->commentable->created_at))}}</i></small>
						
						<p>{!! str_limit($comment->description, 50) !!}</p>
						<div class="tag-thread-show">
							<a href="/user/{{$comment->user->slug}}">
								<img src="<?php if ($comment->user->img != null){ echo "/users/".$comment->user->img;}else if($comment->user->graph != null){echo $comment->user->graph;}else{echo $comment->user->avatar();} ?>" class="img-circle" width="30">
								{{$comment->user->name}}
							</a>
							- <small><i>{{ date('d F, Y', strtotime($comment->created_at))}}</i></small>
						</div>
					</div>
				</div>
				<hr>
			@endforeach
			<div class="text-center">
				<ul class="pagination pagination-sm">{{$artcomments->links()}}</ul>
			</div>
		@endif
		
		@if($prodcomments->count())
			<h4 class="text-center"><b>DISKUSI PADA PRODUK</b></h4>
			@foreach($prodcomments as $comment)
				<div class="thread-comment-show">
					<div class="thread-comment-body">
						<a href="/thread/{{$comment->commentable->slug}}" class="title">
							<h5><b>{{$comment->commentable->title}}</b></h5>
						</a>
						<small>
							<a href="/threads/{{$comment->commentable->storefront->slug}}" class="btn btn-default btn-xs">
								{{$comment->commentable->storefront->name}}
							</a>
						</small>
						- <small><i>{{ date('d F, Y', strtotime($comment->commentable->created_at))}}</i></small>
						
						<p>{!! str_limit($comment->description, 50) !!}</p>
						<div class="tag-thread-show">
							<a href="/user/{{$comment->user->slug}}">
								<img src="<?php if ($comment->user->img != null){ echo "/users/".$comment->user->img;}else if($comment->user->graph != null){echo $comment->user->graph;}else{echo $comment->user->avatar();} ?>" class="img-circle" width="30">
								{{$comment->user->name}}
							</a>
							- <small><i>{{ date('d F, Y', strtotime($comment->created_at))}}</i></small>
						</div>
					</div>
				</div>
				<hr>
			@endforeach
			<div class="text-center">
				<ul class="pagination pagination-sm">{{$prodcomments->links()}}</ul>
			</div>
		@endif
	@endif
@endif