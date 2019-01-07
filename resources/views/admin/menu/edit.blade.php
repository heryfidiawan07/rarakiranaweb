<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$menu->id}}">Edit</button>
<!-- Modal -->
<div class="modal fade" id="edit_{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$menu->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center">EDIT PARENT {{$menu->menu}}</h4>
        <form method="POST" action="/menu/update/setting/{{$menu->id}}">
        {{ csrf_field() }}
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                @if($menu->setting == 10)
                  <option value="10">PARENT FORUM</option>
                @elseif($menu->setting == 20)
                  <option value="20">PARENT PRODUCT</option>
                @endif
                @if($menu->parent()->count() < 1)
                  <option value="0">NO PARENT</option>
                @endif
                @if($menu->parent()->count() < 1)
                    @if($menu->where('setting',10)->count() == 0)
                      <option value="10">PARENT FORUM</option>
                    @elseif($menu->where('setting',20)->count() == 0)
                      <option value="20">PARENT PRODUCT</option>
                    @endif
                @endif
                @foreach($menus->where('parent_id',0)->where('setting','<',5) as $menuEdit)
                    @if($menu->setting == 10 || $menu->setting == 20)
                        @continue
                    @endif
                    @if($menuEdit->id == $menu->id)
                        @continue
                    @endif
                    @if($menu->parent()->count() < 1)
                        <option value="{{$menuEdit->id}}">{{$menuEdit->menu}}</option>
                    @else
                        @continue
                    @endif
                @endforeach
            </select>
            <label>Set Contact</label>
            <select name="contact" class="form-control">
              @if($menu->setting == 5)
                <option value="5">PARENT CONTACT</option>
              @endif
              <option value="0">DEFAULT</option>
              @if($menu->parent()->count() < 1)
                  @if($menu->setting != 10 && $menu->setting != 20)
                    <option value="5">PARENT CONTACT</option>
                  @endif
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