<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$category->id}}">Edit</button>
<!-- Modal -->
<div class="modal fade" id="edit_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$category->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/product/category/{{$category->id}}/update">
        {{ csrf_field() }}
            <label>Menu</label>
            <input type="text" name="categoryEdit" value="{{$category->menu}}" class="form-control" required>
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                <option value="0">NO PARENT</option>
                @foreach($categories as $menuEdit)
                    @if($category->id == $menuEdit->id)
                      @continue
                    @endif
                    @if($category->parent()->count())
                        @continue
                    @endif
                    <option value="{{$menuEdit->id}}">{{$menuEdit->menu}}</option>
                @endforeach
            </select>
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-warning btn-sm">UPDATE</button>
        </form>
      </div>
    </div>
  </div>
</div>