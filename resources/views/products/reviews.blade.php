<br>
@if($product->reviews->count())
    @foreach($reviews as $review)
        <div class="product-discus-show">
            <div class="product-discus-body">
                <p>{!! nl2br($review->description) !!}</p>
            </div>
            <div class="product-discus-user">
                by <a href="/user/{{$review->user->slug}}" class="author">{{$review->user->name}}</a>
                - <small><i>{{ date('d F, Y', strtotime($review->created_at))}}</i></small>
            </div>
        </div>
        <hr>
    @endforeach
    
    <div class="text-center">
        <ul class="pagination pagination-sm">{{$reviews->links()}}</ul>
    </div>
    
@endif
