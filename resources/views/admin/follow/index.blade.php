@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-4">
            @include('admin.dashboard-menu')
            <h4 class="text-center">ADD FOLLOW</h4><hr>
            <form method="POST" action="/follow/store">
                {{ csrf_field() }}
                <label for="url" class="control-label">Url Follow</label>
                <input id="url" type="text" class="form-control" name="urlFollow" value="{{ old('urlFollow') }}" placeholder="https://www.facebook.com/url" required autofocus><br>
                <label for="followAdmin" class="control-label">Pilih Sosial Media</label>
                <div class="form-check followAdmin">
                    <div class="col-sm-6">
                        <p><input type="radio" name="follow" value="fab fa-facebook"> <i class="fab fa-facebook"> Facebook</i></p>
                        <p><input type="radio" name="follow" value="fab fa-twitter"> <i class="fab fa-twitter"> Twitter</i></p>
                        <p><input type="radio" name="follow" value="fab fa-whatsapp"> <i class="fab fa-whatsapp"> Whatsapp</i></p>
                        <p><input type="radio" name="follow" value="fab fa-instagram"> <i class="fab fa-instagram"> Instagram</i></p>
                        <p><input type="radio" name="follow" value="fas fa-envelope"> <i class="fas fa-envelope"> Mail</i></p>
                    </div>
                    <div class="col-sm-6">
                        <p><input type="radio" name="follow" value="fab fa-youtube"> <i class="fab fa-youtube"> Youtube</i></p>
                        <p><input type="radio" name="follow" value="fab fa-weixin"> <i class="fab fa-weixin"> WeChat</i></p>
                        <p><input type="radio" name="follow" value="fab fa-line"> <i class="fab fa-line"> Line</i></p>
                        <p><input type="radio" name="follow" value="fab fa-linkedin"> <i class="fab fa-linkedin"> LinkedIn</i></p>
                        <p><input type="radio" name="follow" value="fab fa-blackberry"> <i class="fab fa-blackberry"> bbm</i></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr><button type="submit" class="form-control btn btn-primary btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
                </div>
            </form>
        </div>

        <div class="col-md-8"><hr>
            <h4 class="text-center"><b>FOLLOW LIST</b></h4>
            @if(session('warningEdit'))
                <div class="alert alert-warning">
                    {{session('warningEdit')}}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover">
                    @foreach($follows as $follow)
                        <tr>
                            <td><i class="{{$follow->class}}"> {{ucfirst($follow->name)}}</i></td>
                            <td><a href="{{$follow->url}}">{{$follow->url}}</a></td>
                            <td><small>by {{$follow->user->name}}</small></td>
                        </tr>
                        <tr>
                            <td><a href="/follow/delete/{{$follow->id}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                            <td>
                                <a data-toggle="collapse" href="#follow-{{$follow->id}}-user-edit" role="button" aria-expanded="false" aria-controls="follow-{{$follow->id}}-user-edit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            </td>
                            <td>
                                <div class="collapse" id="follow-{{$follow->id}}-user-edit">
                                    <div class="card card-body form-inline">
                                        <form method="POST" action="/follow/update/{{$follow->id}}">
                                            {{csrf_field()}}
                                            <div class="input-group input-group-sm">
                                                <input class="form-control" type="text" name="urlFollowEdit" required value="{{$follow->url}}">
                                                <div class="input-group-addon">
                                                    <button class="glyphicon glyphicon-send"></button>
                                                </div>
                                            </div>
                                        </form>
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
