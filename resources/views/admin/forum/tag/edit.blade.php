<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$tag->id}}">Edit</button>
<!-- Modal -->
<div class="modal fade" id="edit_{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$tag->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/forum/tag/{{$tag->id}}/update">
        {{ csrf_field() }}
            <label>Menu</label>
            <input type="text" name="tagEdit" value="{{$tag->menu}}" class="form-control" required>
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                <option value="0">NO PARENT</option>
                @foreach($tags as $menuEdit)
                    @if($tag->id == $menuEdit->id)
                      @continue
                    @endif
                    @if($tag->parent()->count())
                        @continue
                    @endif
                    <option value="{{$menuEdit->id}}">{{$menuEdit->menu}}</option>
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