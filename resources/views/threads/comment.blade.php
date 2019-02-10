@if($thread->comments->count())
    @foreach($comments as $comment)
        <div class="thread-comment-show">
            <div class="thread-comment-body">{!! nl2br($comment->description) !!}</p></div>
            <div class="thread-comment-user">
                by <a href="/user/{{$comment->user->slug}}" class="author">{{$comment->user->name}}</a>
                - <small><i>{{ date('d F, Y', strtotime($comment->created_at))}}</i></small>
                @if(Auth::check())
                    @if(Auth::user()->id == $comment->user->id)
                        <a data-toggle="collapse" href="#comment-{{$comment->id}}-user-edit" role="button" aria-expanded="false" aria-controls="comment-{{$comment->id}}-user-edit" class="btn btn-success btn-xs">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                        <div class="collapse" id="comment-{{$comment->id}}-user-edit">
                            <div class="card card-body">
                                <form method="POST" action="/thread/comment/{{$comment->id}}/update">
                                    {{csrf_field()}}
                                    <hr>
                                    <textarea rows="5" class="form-control descriptionEdit" name="descriptionEdit" required>
                                        {!! $comment->description !!}
                                    </textarea><br>
                                    <button class="btn btn-warning btn-xs">
                                        <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <hr>
    @endforeach
    
    <div class="text-center">
        <ul class="pagination pagination-sm">{{$comments->links()}}</ul>
    </div>
    
@endif
@if(Auth::check())
    @if(Auth::user())
        @if($thread->allowed_comment == 1)
            <div class="comment-comment-text">
                <div class="comment-body-comment">
                    <form method="POST" action="/thread/comment/{{$thread->slug}}/store">
                        {{csrf_field()}}
                        <label>Komentar</label>
                        <textarea rows="5" class="form-control" name="description" required>{{old('description')}}</textarea>
                        <br>
                        <button class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                        </button>
                    </form>
                </div>
            </div>
        @endif
    @endif
@endif
@if(Auth::guest())
    <label class="">Komentar</label>
    <textarea rows="10" class="form-control" name="description" disabled></textarea><br>
    <button class="btn btn-primary btn-sm" disabled>
        <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
    </button>
@endif