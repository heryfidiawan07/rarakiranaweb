<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$menu->id}}">Edit</button>
<!-- Modal -->
<div class="modal fade" id="edit_{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$menu->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/menu/update/{{$menu->id}}">
        {{ csrf_field() }}
            <label>Menu</label>
            <input type="text" name="menuEdit" value="{{$menu->menu}}" class="form-control">
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                @if($menu->setting == 5)
                  <option value="5">Parent Contact</option>
                @elseif($menu->setting == 10)
                  <option value="10">Parent Forum</option>
                @elseif($menu->setting == 20)
                  <option value="20">Parent Product</option>
                @endif
                <option value="0">NO PARENT</option>
                @if($menu->childs)
                  <option value="10">Parent Forum</option>
                  <option value="20">Parent Product</option>
                  <option value="5">Parent Contact</option>
                @endif
                @foreach($menus->where('parent_id',0) as $menuEdit)
                  @if($menuEdit->setting == 10 || $menuEdit->setting == 20)
                    @continue
                  @elseif($menu->id == $menuEdit->id)
                    @continue
                  @endif
                  @if($menu->parent()->count())
                    @continue
                  @else
                    <option value="{{$menuEdit->id}}">{{$menuEdit->menu}}</option>
                  @endif
                @endforeach
            </select>
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning btn-sm">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>