<div class="modal fade" id="status_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="status_{{$user->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Change status user {{$user->name}} ?</b><hr>
            <form method="POST" action="/user/status/{{$user->id}}">
              {{ csrf_field() }}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" name="status" value="1" class="btn btn-success btn-sm">Aktiv</button>
                <button type="submit" name="status" value="0" class="btn btn-warning btn-sm">No Aktiv</button>
                <button type="submit" name="status" value="2" class="btn btn-danger btn-sm">Banned !!</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>