<h3>
    {{$user->name}}
    @if(Auth::check())
        @if(Auth::user()->id == $user->id)
            <a data-toggle="collapse" href="#userName" role="button" aria-expanded="false" aria-controls="userName" class="btn btn-default btn-xs">Edit Nama <span class="caret"></span></a>
        @endif
    @endif
</h3>
@if(Auth::check())
    @if(Auth::user()->id == $user->id)
    <div class="collapse" id="userName">
      <div class="card card-body">
        <form method="POST" action="/user/change/name/{{$user->id}}" class="form-inline">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" name="name" class="form-control input-sm" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-success btn-sm">
            </div>
        </form>
      </div>
    </div>
    @endif
@endif