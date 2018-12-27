@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-4">@include('admin.dashboard-menu')</div>
        <div class="col-md-8">
            <h4 class="text-center">TAMBAH PRODUK KATEGORI</h4><hr>
            <form class="form-horizontal" role="form" method="POST" action="/product/category/store">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="category" class="col-md-4 control-label">Nama Kategori</label>

                    <div class="col-md-6">
                        <input id="category" type="text" class="form-control" name="category" value="{{ old('category') }}" required autofocus>

                        @if ($errors->has('category'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                    <label for="parent_id" class="col-md-4 control-label">Parent</label>

                    <div class="col-md-6">
                        <select name="parent_id" class="form-control">
                            <option value="0">Select parent</option>
                            @if($categories->count())
                                @foreach($categories as $parent)
                                    <option value="{{$parent->id}}">{{$parent->menu}}</option>
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
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </div>
            </form>
            
            <hr>

            <h4 class="text-center"><b>DAFTAR PRODUK KATEGORI</b></h4>
            @if(session('warningEdit'))
                <div class="alert alert-warning">
                    {{session('warningEdit')}}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hovered">
                <tr>
                    <th>CATEGORY</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                    <th>STATUS</th>
                    <th>POSTED BY</th>
                </tr>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->menu}}</td>
                        <td>@include('admin.products.category.edit')</td>
                        <td>@include('admin.products.category.delete')</td>
                        <td>@include('admin.products.category.status')</td>
                        <td>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <small><i>{{$category->user->name}}</i></small>
                        </td>
                        <tr>
                    <tr>
                    @foreach($category->parent as $child)
                    <tr>
                        <td> -> {{$child->menu}}</td>
                        <td>@include('admin.products.category.editChild')</td>
                        <td>@include('admin.products.category.deleteChild')</td>
                        <td>@include('admin.products.category.statusChild')</td>
                        <td>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <small><i>{{$child->user->name}}</i></small>
                        </td>
                    @endforeach
                @endforeach
                </table>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/product/create" class="btn btn-primary btn-sm pull-left">TULIS PRODUK</a>
                    <h4 class="text-center"><b>DAFTAR PRODUK</b></h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            @foreach($products as $product)
                            <tr>
                                <td rowspan="3">@include('products.thumb')</td>
                                <td colspan="7">{{$product->title}}</td>
                            </tr>
                            <tr>
                                <td><a href="/product/{{$product->id}}/edit" class="btn btn-primary btn-xs">EDIT</a></td>
                                <td>@include('admin.products.delete')</td>
                                <td><a href="/show/product/{{$product->slug}}" class="btn btn-success btn-xs">SHOW</a></td>
                                <td>
                                    <a href="/products/category/{{$product->menu->slug}}" class="btn btn-default btn-xs">
                                    <span class="glyphicon glyphicon-tag"></span>{{$product->menu->menu}}</a>
                                </td>
                                <td>@include('admin.products.status')</td>
                                <td><span class="glyphicon glyphicon-comment"> {{$product->prodcomments->count()}}</span></td>
                                <td>@include('admin.products.acomment')</td>
                            </tr>
                            <tr>
                                <td colspan="3"><span class="glyphicon glyphicon-user"></span> <small><i>{{$product->user->name}}</i></small></td>
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
        </div>
    </div>
</div>
@endsection
