<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$child->id}}">Edit</button>
<!-- Modal -->
<div class="modal fade" id="edit_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$child->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center">EDIT PARENT {{$child->name}}</h4>
        <form method="POST" action="/tag/update/parent/{{$child->id}}">
            {{ csrf_field() }}
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                <option value="{{$child->parent_id}}">{{$child->childs->name}}</option>
                <option value="0">NO PARENT</option>
                @if($tags->count())
                    @foreach($tags->where('setting',0)->where('parent_id',0) as $tagEdit)
                        <option value="{{$tagEdit->id}}">{{$tagEdit->name}}</option>
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