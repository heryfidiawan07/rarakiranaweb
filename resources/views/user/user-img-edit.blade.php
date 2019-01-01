@if(Auth::check())
    @if(Auth::user()->id == $user->id)
        <br>
        <a data-toggle="collapse" href="#userImg" role="button" aria-expanded="false" aria-controls="userImg" class="btn btn-default btn-xs">Ganti <span class="caret"></span></a>
        <div class="collapse" id="userImg">
          <div class="card card-body">
          <br>
            <form method="POST" action="/user/image/upload/{{$user->id}}" class="form-inline" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="file" name="img" class="form-control input-sm" required>
                <input type="submit" value="Simpan" class="btn btn-success btn-sm">
            </form>
          </div>
        </div>
    @endif
@endif