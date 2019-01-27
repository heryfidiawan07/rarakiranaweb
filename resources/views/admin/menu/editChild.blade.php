<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$child->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
<!-- Modal -->
<div class="modal fade" id="edit_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$child->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/menu/update/setting/{{$child->id}}">
        {{ csrf_field() }}
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                <option value="{{$child->parent_id}}">{{$child->childs->name}}</option>
                <option value="0">NO PARENT</option>
                @if($menus->count())
                    @foreach($menus->where('parent_id',0) as $menuEdit)
                        <option value="{{$menuEdit->id}}">{{$menuEdit->name}}</option>
                    @endforeach
                @endif
            </select>
            <label>Set Contact</label>
            <select name="contact" class="form-control">
                @if($child->setting == 5)
                    <option value="5">PARENT CONTACT</option>
                @endif
                <option value="0">DEFAULT</option>
                <option value="5">PARENT CONTACT</option>
            </select>
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
        </form>
      </div>
    </div>
  </div>
</div>