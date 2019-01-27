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
            <div class="input-group input-group-sm">
                <input type="text" name="name" class="form-control" required>
                <div class="input-group-addon">
                    <button class="glyphicon glyphicon-send"></button>
                </div>
            </div>
        </form>
      </div>
    </div>
    @endif
@endif