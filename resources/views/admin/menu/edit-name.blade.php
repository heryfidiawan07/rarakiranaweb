<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-name_{{$menu->id}}" @if($menu->setting==1) disabled @endif><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
<!-- Modal -->
<div class="modal fade" id="edit-name_{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="edit-name_{{$menu->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/menu/update/name/{{$menu->id}}">
        {{ csrf_field() }}
            <label>Menu</label>
            <input type="text" name="menuEdit" value="{{$menu->name}}" class="form-control">
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
        </form>
      </div>
    </div>
  </div>
</div>