@if(Auth::check())
    @if(Auth::user()->id == $user->id)
        <br>
        <a data-toggle="collapse" href="#userImg" role="button" aria-expanded="false" aria-controls="userImg" class="btn btn-default btn-xs">Ganti <span class="caret"></span></a>
        <div class="collapse" id="userImg">
          <div class="card card-body">
          <br>
            <form method="POST" action="/user/image/upload/{{$user->id}}" class="form-inline" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="input-group input-group-sm">
                  <input type="file" name="img" class="form-control" required>
                  <div class="input-group-addon">
                    <button class="glyphicon glyphicon-send"></button>
                  </div>
                </div>
            </form>
          </div>
        </div>
    @endif
@endif