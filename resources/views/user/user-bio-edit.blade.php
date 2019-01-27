@if(Auth::check())
    @if(Auth::user()->id == $user->id)
        <h5>
            <a data-toggle="collapse" href="#userbio" role="button" aria-expanded="false" aria-controls="userbio" class="btn btn-default btn-xs">Edit Bio <span class="caret"></span></a>
        </h5>
        <div class="collapse" id="userbio">
          <div class="card card-body">
            <form method="POST" action="/user/update/bio/{{$user->id}}">
                {{csrf_field()}}
                <textarea rows="5" class="form-control" name="bio" required></textarea>
                <br>
                <button class="btn btn-success btn-sm">
                    <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                </button>
            </form>
            <hr>
          </div>
        </div>
    @endif
@endif