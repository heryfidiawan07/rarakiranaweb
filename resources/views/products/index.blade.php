@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-3">@include('products.tags-category')</div>
        <div class="col-md-9">
            @foreach($newproducts->where('menu.status',1) as $product)
                @include('products.content-index')
            @endforeach
            <div class="col-md-12 text-center">
		            <ul class="pagination pagination-sm">{{$newproducts->links()}}</ul>
		        </div>
        </div>

    </div>
</div>
@endsection
