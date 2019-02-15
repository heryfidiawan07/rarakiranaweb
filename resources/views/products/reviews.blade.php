<br>
@if($product->reviews->count())
    @foreach($reviews as $review)
        <div class="product-discus-show">
            <div class="product-discus-body">
                <p>{!! nl2br($review->description) !!}</p>
            </div>
            <div class="product-discus-user">
                <a href="/user/{{$review->user->slug}}" class="author">
                    <img src="<?php if ($review->user->img != null){ echo "/users/".$review->user->img;}else if($review->user->graph != null){echo $review->user->graph;}else{echo $review->user->avatar();} ?>" class="img-circle" width="30">
                    {{$review->user->name}}
                </a>
                - <small><i>{{ date('d F, Y', strtotime($review->created_at))}}</i></small>
            </div>
        </div>
        <hr>
    @endforeach
    
    <div class="text-center">
        <ul class="pagination pagination-sm">{{$reviews->links()}}</ul>
    </div>
    
@endif
