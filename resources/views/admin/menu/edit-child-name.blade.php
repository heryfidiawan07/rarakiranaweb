<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-name_{{$child->id}}">Edit</button>
<!-- Modal -->
<div class="modal fade" id="edit-name_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="edit-name_{{$child->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/menu/update/name/{{$child->id}}">
            {{ csrf_field() }}
            <label>Menu</label>
            <input type="text" name="menuEdit" value="{{$child->name}}" class="form-control">
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning btn-sm">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>