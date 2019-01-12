<!-- Button trigger modal -->
@if($menu->parent()->count() < 1)
  <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$menu->id}}" @if($menu->setting==1) disabled @endif>Edit</button>
@else
  <button class="btn btn-primary btn-xs" disabled>Edit</button>
@endif
<!-- Modal -->
<div class="modal fade" id="edit_{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$menu->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center">EDIT PARENT {{$menu->name}}</h4>
        <form method="POST" action="/menu/update/setting/{{$menu->id}}">
        {{ csrf_field() }}
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                <option value="0">NO PARENT</option>
                @foreach($menus->where('parent_id',0)->where('setting',0) as $menuEdit)
                    <option value="{{$menuEdit->id}}">{{$menuEdit->name}}</option>
                @endforeach
            </select>
            <label>Set Contact</label>
            <select name="contact" class="form-control">
              @if($menu->setting == 5)
                <option value="5">PARENT CONTACT</option>
              @endif
              <option value="0">DEFAULT</option>
              @if($menu->parent()->count() < 1)
                  <option value="5">PARENT CONTACT</option>
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