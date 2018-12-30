<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{$logo->id}}">Delete</button>
<!-- Modal -->
<div class="modal fade" id="delete_{{$logo->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_{{$logo->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Delete logo {{$logo->title}} ?</b><hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
            <a href="/logo/delete/{{$logo->id}}" class="btn btn-danger btn-sm">DELETE !</a>
        </div>
      </div>
    </div>
  </div>
</div>