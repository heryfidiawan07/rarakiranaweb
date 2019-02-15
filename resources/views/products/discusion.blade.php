<br>
@if($product->comments->count())
    @foreach($discusions as $discus)
        <div class="product-discus-show">
            <div class="product-discus-body">
                <p>{!! nl2br($discus->description) !!}</p>
            </div>
            <div class="product-discus-user">
                <a href="/user/{{$discus->user->slug}}" class="author">
                <img src="<?php if ($discus->user->img != null){ echo "/users/".$discus->user->img;}else if($discus->user->graph != null){echo $discus->user->graph;}else{echo $discus->user->avatar();} ?>" class="img-circle" width="30">
                    {{$discus->user->name}}
                </a>
                - <small><i>{{ date('d F, Y', strtotime($discus->created_at))}}</i></small>
                @if(Auth::check())
                    @if(Auth::user()->id == $discus->user->id)
                        <a data-toggle="collapse" href="#discus-{{$discus->id}}-user-edit" role="button" aria-expanded="false" aria-controls="discus-{{$discus->id}}-user-edit" class="btn btn-success btn-xs">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                        <div class="collapse" id="discus-{{$discus->id}}-user-edit">
                            <div class="card card-body">
                                <form method="POST" action="/product/discus/{{$discus->id}}/update">
                                    {{csrf_field()}}
                                    <hr>
                                    <textarea rows="5" class="form-control descriptionEdit" name="descriptionEdit" required>
                                        {{strip_tags($discus->description)}}
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
        <ul class="pagination pagination-sm">{{$discusions->links()}}</ul>
    </div>
    
@endif
@if(Auth::check())
    @if(Auth::user())
        @if($product->allowed_comment == 1)
            <div class="discus-discus-text">
                <div class="discus-body-discus">
                    <form method="POST" action="/product/discus/{{$product->slug}}/store">
                        {{csrf_field()}}
                        <label class="">Diskusi</label>
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
    <label class="">Diskusi</label>
    <textarea rows="5" class="form-control" name="" disabled></textarea><br>
    <button class="btn btn-primary btn-sm" disabled>
        <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
    </button>
@endif