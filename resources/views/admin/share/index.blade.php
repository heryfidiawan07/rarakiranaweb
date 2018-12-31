@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-4">
            @include('admin.dashboard-menu')
            <h4 class="text-center">ADD SHARE</h4><hr>
            <form method="POST" action="/share/store">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="share" class="control-label">Pilih Sosial Media Share</label>
                    <div class="form-check share">
                        <div class="col-xs-6">
                            <p><input type="checkbox" name="share[]" value="1"> <i class="fab fa-facebook"> Facebook</i></p>
                            <p><input type="checkbox" name="share[]" value="2"> <i class="fab fa-twitter"> Twitter</i></p>
                            <p><input type="checkbox" name="share[]" value="3"> <i class="fab fa-whatsapp"> Whatsapp</i></p>
                            <p><input type="checkbox" name="share[]" value="4"> <i class="fab fa-pinterest"> Pinterest</i></p>
                        </div>
                        <div class="col-xs-6">
                            <p><input type="checkbox" name="share[]" value="5"> <i class="fas fa-envelope"> Mail</i></p>
                            <p><input type="checkbox" name="share[]" value="6"> <i class="fab fa-google"> Google</i></p>
                            <p><input type="checkbox" name="share[]" value="7"> <i class="fab fa-linkedin"> LinkedIn</i></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>

        <div class="col-md-8">
            <h4 class="text-center"><b>SHARE LIST</b></h4>
            @if(session('warningEdit'))
                <div class="alert alert-warning">
                    {{session('warningEdit')}}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover">
                    @foreach($shares as $share)
                        <tr>
                            <td><i class="{{$share->class}}"> {{ucfirst($share->name)}}</i></td>
                            <td><a href="/share/delete/{{$share->id}}" class="btn btn-danger btn-sm">Delete !</a></td>
                            <td><small>by {{$share->user->name}}</small></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
