@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        @include('admin.dashboard-menu')
        <div class="col-md-12">
            <div class="table-responsive well">
                <table class="activate-tabel"><tr><td>
                    @if($frontTag)
                        <form class="form-inline" method="POST" action="/product/update/{{$frontTag->id}}">
                            {{csrf_field()}}
                            <div class="input-group input-group-sm">
                                <input type="text" name="frontUpdate" class="form-control" value="{{$frontTag->name}}" required>
                                <div class="input-group-addon">
                                    <button class="glyphicon glyphicon-send"></button>
                                </div>
                            </div>
                        </form>
                    @endif
                    </td>
                    @if($frontTag)
                    <td>
                        <form class="form-inline" method="POST" action="/product/update/status/{{$frontTag->id}}">
                            {{csrf_field()}}
                            <div class="input-group input-group-sm">
                                <select name="statusFront" class="form-control">
                                    @if($frontTag->status==0)
                                        <option value="0">No Activate</option>
                                    @endif
                                    <option value="1">Activate</option>
                                    <option value="0">No Activate</option>
                                </select>
                                <div class="input-group-addon">
                                    <button class="glyphicon glyphicon-send succes"></button>
                                </div>
                            </div>
                        </form>
                    </td>
                    @else
                    <td>
                        <form class="form-inline" method="POST" action="/activate/products">
                            {{csrf_field()}}
                            <div class="input-group input-group-sm">
                                <input type="text" name="productName" class="form-control" placeholder="Create Menu Forum" required>
                                <div class="input-group-addon">
                                    <button class="glyphicon glyphicon-send"></button>
                                </div>
                            </div>
                        </form>
                    </td>
                    @endif
                </tr></table>
            </div>
            <hr>
        </div>
        @if($fronts->where('setting',10)->where('status',1)->count())
            <div class="col-md-4">
                <h4 class="text-center">ADD ETALASE</h4><hr>
                <form class="form-horizontal" role="form" method="POST" action="/etalase/store">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                        <label for="parent_id" class="col-md-4 control-label">Parent</label>

                        <div class="col-md-6">
                            <select name="parent_id" class="form-control">
                                <option value="0">Select Parent</option>
                                @if($fronts->count())
                                    @foreach($fronts->where('setting',0)->where('parent_id',0) as $front)
                                        <option value="{{$front->id}}">{{$front->name}}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->has('parent_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('parent_id') }}</strong>
                                </span>
                            @endif
                            @if(session('warning'))
                                <div class="alert alert-warning">
                                    {{session('warning')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>   
                
            <div class="col-md-8">
                <h4 class="text-center"><b>ETALASE</b></h4>
                @if(session('warningEdit'))
                    <div class="alert alert-warning">
                        {{session('warningEdit')}}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hovered">
                    <tr>
                        <th>ETALASE</th>
                        <th>EDIT NAME</th>
                        <th>EDIT PARENT</th>
                        <th>DELETE</th>
                        <th>STATUS</th>
                        <th>POSTED BY</th>
                    </tr>
                    @foreach($fronts->where('setting','!=',10)->where('parent_id',0) as $front)
                        <tr>
                            <td>{{$front->name}} - <small>{{$front->products->count()}} products</small></td>
                            <td>@include('admin.products.front.edit-name')</td>
                            <td>@include('admin.products.front.edit')</td>
                            <td>@include('admin.products.front.delete')</td>
                            <td>@include('admin.products.front.status')</td>
                            <td>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <small><i>{{$front->user->name}}</i></small>
                            </td>
                            <tr>
                        <tr>
                        @foreach($front->parent as $child)
                        <tr>
                            <td>
                                <span class="glyphicon glyphicon-arrow-right"></span>
                                {{$child->name}} - <small>{{$child->products->count()}} products</small>
                            </td>
                            <td>@include('admin.products.front.edit-child-name')</td>
                            <td>@include('admin.products.front.editChild')</td>
                            <td>@include('admin.products.front.deleteChild')</td>
                            <td>@include('admin.products.front.statusChild')</td>
                            <td>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <small><i>{{$child->user->name}}</i></small>
                            </td>
                        @endforeach
                    @endforeach
                    </table>
                </div>
            </div>
            
            <div class="col-md-12"><hr>
                <h4 class="text-center"><b>PRODUCT LIST</b></h4>
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <a href="/product/create" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>ADD PRODUCT</a>
                        @if(Auth::user()->address == null)
                            <a href="/dashboard/orders" class="alert alert-danger alert-sm">Admin address has not been set</a>
                        @elseif(Auth::user()->rekening == null)
                            <a href="/dashboard/bank-accounts" class="alert alert-danger alert-sm">Admin account <i>(bank)</i> has not been set</a>
                        @endif
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                @foreach($products as $product)
                                <tr>
                                    <td rowspan="3" class="td-admin-img-products">
                                        @include('products.thumb')
                                    </td>
                                    <td colspan="8"><p class="@if($product->sticky == 1) product-sticky @else product-title @endif">{{$product->title}} @if($product->sticky == 1) - <small style="color: black;">This Product Sticky</small>@endif</p></td>
                                </tr>
                                <tr>
                                    <td><a href="/product/{{$product->id}}/edit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                                    <td>@include('admin.products.delete')</td>
                                    <td><a href="/show/product/{{$product->slug}}" class="btn btn-success btn-sm" @if($product->status==0) disabled @endif><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                                    <td>@include('admin.products.status')</td>
                                    <td>@include('admin.products.acomment')</td>
                                    <td>
                                        <form class="form-inline" method="POST" action="/product/sticky/{{$product->id}}">
                                            {{csrf_field()}}
                                            <div class="input-group input-group-sm">
                                                <select class="form-control" name="sticky" required>
                                                    @if($product->sticky == 1)
                                                        <option value="{{$product->sticky}}">Sticky Post</option>
                                                    @endif
                                                    <option value="0">Default</option>
                                                    <option value="1">Set to sticky</option>
                                                </select>
                                                <div class="input-group-addon">
                                                    <button class="glyphicon glyphicon-send"></button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <form class="form-inline" method="POST" action="/product/parent/{{$product->id}}">
                                            {{csrf_field()}}
                                            <div class="input-group input-group-sm">
                                                <select class="form-control input-sm" name="parent_product" required>
                                                    <option value="{{$product->storefront->id}}">{{$product->storefront->name}}</option>
                                                    @foreach($upfronts as $front)
                                                        <option value="{{$front->id}}">{{$front->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-addon">
                                                    <button class="glyphicon glyphicon-send"></button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="/products/{{$product->storefront->slug}}" class="btn btn-default btn-sm">
                                        <span class="glyphicon glyphicon-tag"></span>{{$product->storefront->name}}</a>
                                    </td>
                                    <td><span class="glyphicon glyphicon-comment"> {{$product->comments->count()}}</span></td>
                                    <td><span class="glyphicon glyphicon-user"></span> <small><i>{{$product->user->name}}</i></small></td>
                                    <td colspan="2"><small><i>
                                        <span class="glyphicon glyphicon-time"></span>
                                        Create: {{ date('d F, Y', strtotime($product->created_at))}} - {{date('g:ia', strtotime($product->created_at))}}
                                    </i></small></td>
                                    <td colspan="2"><small><i>
                                        <span class="glyphicon glyphicon-time"></span>
                                        Updated: {{ date('d F, Y', strtotime($product->udated_at))}} - {{date('g:ia', strtotime($product->updated_at))}}
                                    </i></small></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <ul class="pagination pagination-sm">{{$products->links()}}</ul>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
