<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$child->id}}">Edit</button>
<!-- Modal -->
<div class="modal fade" id="edit_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$child->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/menu/update/{{$child->id}}">
        {{ csrf_field() }}
            <label>Menu</label>
            <input type="text" name="menuEdit" value="{{$child->menu}}" class="form-control">
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                <option value="{{$child->parent_id}}">{{$child->childs->menu}}</option>
                <option value="0">NO PARENT</option>
                @if($menus->count())
                    @foreach($menus->where('parent_id',0) as $menu)
                        @if($menu->setting != 0)
                            @continue
                        @endif
                        <option value="{{$menu->id}}">{{$menu->menu}}</option>
                    @endforeach
                @endif
            </select>
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning btn-sm">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>