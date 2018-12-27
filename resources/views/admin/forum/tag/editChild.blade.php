<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$child->id}}">Edit</button>
<!-- Modal -->
<div class="modal fade" id="edit_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$child->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/forum/tag/{{$child->id}}/update">
        {{ csrf_field() }}
            <label>Menu</label>
            <input type="text" name="tagEdit" value="{{$child->menu}}" class="form-control" required>
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                <option value="{{$child->parent_id}}">{{$child->childs->menu}}</option>
                <option value="0">--NO PARENT--</option>
                @if($tags->count())
                    @foreach($tags->where('setting',20) as $tag)
                        <option value="{{$tag->id}}">{{$tag->menu}}</option>
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