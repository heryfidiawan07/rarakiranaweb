@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-4">
            @include('admin.dashboard-menu')
        </div>

        <div class="col-md-12"><hr>
            <h4 class="text-center"><b>INBOX LIST</b></h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    @foreach($inboxs as $inbox)
                        <tr>
                            <td>
                                {{$inbox->subject}}
                                <a data-toggle="collapse" href="#inboxDesc_{{$inbox->id}}" role="button" aria-expanded="false" aria-controls="inboxDesc_{{$inbox->id}}" class="btn btn-success btn-xs"><span class="caret"></span> Open</a>
                            </td>
                            <td>
                                @if($inbox->user_id === null)
                                    Guest
                                @else
                                    {{$inbox->user->name}}
                                @endif
                            </td>
                            <td>Created : 
                                {{ date('d F, Y', strtotime($inbox->created_at))}} - {{date('g:ia', strtotime($inbox->created_at))}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="collapse" id="inboxDesc_{{$inbox->id}}">
                                  <div class="card card-body">
                                        <p><b>{{$inbox->email}}</b></p>
                                        {!! nl2br($inbox->description) !!}
                                  </div>
                                </div>
                            </td>  
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
