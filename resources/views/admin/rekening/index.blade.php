@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        
        @include('admin.dashboard-menu')
        <div class="col-md-4">
            <h4 class="text-center">ADD BANK ACCOUNT</h4><hr>
            <form action="/bank-accounts/store" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">ATAS NAMA</div>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">NOMOR REKENING</div>
                        <input type="text" name="number" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">BANK</div>
                        <input type="text" name="bank" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-send"></span>
                    </button>
                </div>
            </form>
        </div>

        <div class="col-md-8">
            @if($rekenings->count())
                <h4 class="text-center">BANK ACCOUNT LIST</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Edit</th>
                            <th>Nama</th>
                            <th>Bank</th>
                            <th>Nomor</th>
                            <th>Admin</th>
                            <th>Hapus</th>
                        </tr>
                        @foreach($rekenings as $rekening)
                            <tr>
                                <td>
                                    <a data-toggle="collapse" href="#rekEdit_{{$rekening->id}}" role="button" aria-expanded="false" aria-controls="rekEdit_{{$rekening->id}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                                </td>
                                <td>{{$rekening->name}}</td>
                                <td>{{$rekening->bank}}</td>
                                <td>{{$rekening->number}}</td>
                                <td>{{$rekening->user->name}}</td>
                                <td>
                                    <a href="/bank-accounts/delete/{{$rekening->id}}" class="btn btn-danger btn-xs">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="collapse" id="rekEdit_{{$rekening->id}}">
                                        <div class="card card-body">
                                            <form action="/bank-accounts/update/{{$rekening->id}}" method="POST" class="form-inline">
                                                {{csrf_field()}}
                                                <div class="input-group input-sm">
                                                    <div class="input-group-addon">NAMA</div>
                                                    <input type="text" name="editName" class="form-control" value="{{$rekening->name}}" required>
                                                </div>
                                                <div class="input-group input-sm">
                                                    <div class="input-group-addon">REKENING</div>
                                                    <input type="text" name="editNumber" class="form-control" value="{{$rekening->number}}" required>
                                                </div>
                                                <div class="input-group input-sm">
                                                    <div class="input-group-addon">BANK</div>
                                                    <input type="text" name="editBank" class="form-control" value="{{$rekening->bank}}" required>
                                                </div>
                                                <div class="input-group input-sm">
                                                    <button class="btn btn-warning btn-sm">
                                                        <span class="glyphicon glyphicon-send"></span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
