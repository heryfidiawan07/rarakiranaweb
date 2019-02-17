@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        @include('admin.dashboard-menu')
        <div class="col-md-6"><hr>
            <h4 class="text-center"><b>PRODUCT OFFER LIST</b></h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    @foreach($products as $key => $product)
                        <tr class="info">
                            <td>{{$product->subject}}</td>
                            <td>Created : {{$product->question_create}}</td>
                        </tr>
                        <tr>
                            <td>
                                <p><b>{{$product->qEmail}}</b></p>
                                {!! str_limit(nl2br($product->qDescription),100) !!}
                            </td>
                            <td>
                                <p><a href="/show/product/{{$product->slug}}">{{$product->title}}</a></p>
                                <p>
                                    <a href="/dashboard/product/offer/{{$product->slug}}/print" target="_blank">
                                        <span class="glyphicon glyphicon-print"></span> Print
                                    </a>
                                    |
                                    <a href="/dashboard/product/offer/{{$product->slug}}/show">
                                        <span class="glyphicon glyphicon-print"></span> Open
                                    </a>
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="text-center">
                <ul class="pagination pagination-sm">{{$products->links()}}</ul>
            </div>
        </div>
        
        <div class="col-md-6"><hr>
            <h4 class="text-center"><b>MESSAGES SHIPMENT LIST</b></h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    @foreach($questions->where('setting',0) as $question)
                        <tr>
                            <td>
                                <a data-toggle="collapse" href="#questionDesc_{{$question->id}}" role="button" aria-expanded="false" aria-controls="questionDesc_{{$question->id}}" class="btn btn-success btn-xs"><span class="caret"></span> Open</a>
                                {{$question->title}}
                            </td>
                            <td>Created : 
                                {{ date('d F, Y', strtotime($question->created_at))}} - {{date('g:ia', strtotime($question->created_at))}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="collapse" id="questionDesc_{{$question->id}}">
                                  <div class="card card-body">
                                        <p><b>{{$question->email}}</b></p>
                                        {!! nl2br($question->description) !!}
                                  </div>
                                </div>
                            </td>  
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="text-center">
                <ul class="pagination pagination-sm">{{$questions->links()}}</ul>
            </div>
        </div>

    </div>
</div>
@endsection
