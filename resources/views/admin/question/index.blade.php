@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        @include('admin.dashboard-menu')
        <div class="col-md-12"><hr>
            <h4 class="text-center"><b>MESSAGES LIST</b></h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    @foreach($questions as $question)
                        <tr>
                            <td>
                                {{$question->subject}}
                                <a data-toggle="collapse" href="#questionDesc_{{$question->id}}" role="button" aria-expanded="false" aria-controls="questionDesc_{{$question->id}}" class="btn btn-success btn-xs"><span class="caret"></span> Open</a>
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
        </div>
        <div class="text-center">
            <ul class="pagination pagination-sm">{{$questions->links()}}</ul>
        </div>

    </div>
</div>
@endsection
