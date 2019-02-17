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
            @foreach($thcomments as $thread)
                <div class="thread-comment-show">
                    <div class="thread-comment-body">
                        <a href="/thread/{{$thread->slug}}" class="title">{{$thread->title}}</a>
                        <div class="tag-thread-show">
                            <a href="/user/{{$thread->user->slug}}">
                                <img src="<?php if ($thread->user->img != null){ echo "/users/".$thread->user->img;}else if($thread->user->graph != null){echo $thread->user->graph;}else{echo $thread->user->avatar();} ?>" class="img-circle" width="30">
                                {{$thread->user->name}}
                            </a>
                            - <small><i>{{ date('d F, Y', strtotime($thread->created_at))}}</i></small>,
                            <a href="/threads/{{$thread->tag->slug}}" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                                {{$thread->tag->name}}
                            </a>
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
            @foreach($artcomments as $post)
                <div class="post-comment-show">
                    <div class="post-comment-body">
                        <a href="/read/post/{{$post->slug}}" class="title">{{$post->title}}</a>
                        <div class="tag-art-show">
                            <a href="/user/{{$post->user->slug}}">
                                <img src="<?php if ($post->user->img != null){ echo "/users/".$post->user->img;}else if($post->user->graph != null){echo $post->user->graph;}else{echo $post->user->avatar();} ?>" class="img-circle" width="30">
                                {{$post->user->name}}
                            </a>
                            - <small><i>{{ date('d F, Y', strtotime($post->created_at))}}</i></small>
                            <a href="/{{$post->menu->slug}}" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                                {{$post->menu->name}}
                            </a>
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
            @foreach($prodcomments as $product)
                <div class="product-discus-show">
                    <div class="product-discus-body">
                        <a href="/show/product/{{$product->slug}}" class="title">{{$product->title}}</a>
                    </div>
                    <a href="/{{$product->storefront->slug}}" class="btn btn-default btn-xs">
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                        {{$product->storefront->name}}
                    </a>
                </div>
                <hr>
            @endforeach
            <div class="text-center">
                <ul class="pagination pagination-sm">{{$prodcomments->links()}}</ul>
            </div>
        @endif
    @endif
@endif