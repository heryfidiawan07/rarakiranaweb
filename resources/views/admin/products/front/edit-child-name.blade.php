<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-name_{{$child->id}}">Edit</button>
<!-- Modal -->
<div class="modal fade" id="edit-name_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="edit-name_{{$child->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/etalase/update/name/{{$child->id}}">
            {{ csrf_field() }}
            <label>Name</label>
            <input type="text" name="nameEdit" value="{{$child->name}}" class="form-control" required>
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning btn-sm">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>