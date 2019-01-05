<br>
@if($product->prodcomments->count())
    @foreach($discusions as $discus)
        <div class="product-discus-show">
            <div class="product-discus-body">
                <p>{!! nl2br($discus->description) !!}</p>
            </div>
            <div class="product-discus-user">
                by <a href="/user/{{$discus->user->slug}}" class="author">{{$discus->user->name}}</a>
                - <small><i>{{ date('d F, Y', strtotime($discus->created_at))}}</i></small>
                @if(Auth::check())
                    @if(Auth::user()->id == $discus->user->id)
                        <a data-toggle="collapse" href="#discus-{{$discus->id}}-user-edit" role="button" aria-expanded="false" aria-controls="discus-{{$discus->id}}-user-edit" class="btn btn-success btn-xs">Edit</a>
                        <div class="collapse" id="discus-{{$discus->id}}-user-edit">
                            <div class="card card-body">
                                <form method="POST" action="/product/discus/{{$discus->id}}/update">
                                    {{csrf_field()}}
                                    <hr>
                                    <textarea rows="5" class="form-control" name="descriptionEdit" required>
                                        {{$discus->description}}
                                    </textarea><br>
                                    <button class="btn btn-warning btn-xs">Update</button>
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

<div class="discus-discus-text">
    <div class="discus-body-discus">
        <form method="POST" action="/product/discus/{{$product->slug}}/store">
            {{csrf_field()}}
            <textarea rows="5" class="form-control" name="description" required>{{old('description')}}</textarea>
            <br>
            <button class="btn btn-success">Kirim</button>
        </form>
    </div>
</div>