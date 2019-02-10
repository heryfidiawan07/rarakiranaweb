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
                        <a href="/thread/{{$comment->slug}}" class="title">{{$comment->title}}</a>
                        <p>
                            {{strip_tags(str_limit($comment->description, $limit = 60, $end = '...'))}}
                        </p>
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
                <div class="post-comment-show">
                    <div class="post-comment-body">
                        <a href="/read/post/{{$comment->slug}}" class="title">{{$comment->title}}</a>
                        <p>
                            {{str_limit($comment->description, $limit = 60, $end = '...')}}
                        </p>
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
          @foreach($prodcomments as $discus)
                <div class="product-discus-show">
                    <div class="product-discus-body">
                        <a href="/show/product/{{$discus->slug}}" class="title">{{$discus->title}}</a>
                        <p>
                            {{str_limit($discus->description, $limit = 60, $end = '...')}}
                        </p>
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