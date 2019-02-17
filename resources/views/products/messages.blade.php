<br>
@if($product->messages->count())
    @foreach($messages as $message)
        @if(Auth::check())
            @if(Auth::user()->id == $message->user_id)
                <div class="product-discus-show">
                    <div class="product-discus-body">
                        <p>{!! nl2br($message->description) !!}</p>
                    </div>
                    <div class="product-discus-user">
                        <a href="/user/{{$message->user->slug}}" class="author">
                            <img src="<?php if ($message->user->img != null){ echo "/users/".$message->user->img;}else if($message->user->graph != null){echo $message->user->graph;}else{echo $message->user->avatar();} ?>" class="img-circle" width="30">
                            {{$message->user->name}}
                        </a>
                        - <small><i>{{ date('d F, Y', strtotime($message->created_at))}}</i></small>
                        <a data-toggle="collapse" href="#message-{{$message->id}}-user-edit" role="button" aria-expanded="false" aria-controls="discus-{{$message->id}}-user-edit" class="btn btn-success btn-xs">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                        <div class="collapse" id="message-{{$message->id}}-user-edit">
                            <div class="card card-body">
                                <form method="POST" action="/product/message/{{$message->id}}/update">
                                    {{csrf_field()}}
                                    <hr>
                                    <textarea rows="3" class="form-control descriptionEdit" name="descriptionMessageEdit" required>
                                        {{strip_tags($message->description)}}
                                    </textarea><br>
                                    <button class="btn btn-warning btn-xs">
                                        <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endif
        @endif
    @endforeach
    
    <div class="text-center">
        <ul class="pagination pagination-sm">{{$messages->links()}}</ul>
    </div>
    
@endif
@if(Auth::check())
    @if(Auth::user())
        @if($product->allowed_comment == 1)
            <div class="discus-discus-text">
                <div class="discus-body-discus">
                    <form method="POST" action="/product/message/{{$product->slug}}/store">
                        {{csrf_field()}}
                        <label class="">Kirim Pesan</label>
                        <textarea rows="3" class="form-control" name="descriptionMessage" required>{{old('descriptionMessage')}}</textarea>
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
    <label class="">Kirim Pesan</label>
    <textarea rows="3" class="form-control" name="" disabled></textarea><br>
    <button class="btn btn-primary btn-sm" disabled>
        <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
    </button>
@endif