<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$logo->id}}">Edit</button>
<!-- Modal -->
<div class="modal fade" id="edit_{{$logo->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$logo->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/logo/update/{{$logo->id}}" enctype="multipart/form-data">
        {{ csrf_field() }}
            <label>Title</label>
            <input type="text" name="titleEdit" value="{{$logo->title}}" class="form-control" required>
            <label>Description</label>
            <input type="text" name="descriptionEdit" value="{{$logo->description}}" class="form-control" required>
            <label>Parent</label>
            <select name="menu_edit" class="form-control">
                @if($menus->count())
                    @foreach($menus as $menuEdit)
                        <option value="{{$menuEdit->id}}">{{$menuEdit->menu}}</option>
                    @endforeach
                @endif
            </select>
            <label>Image</label><br>
            <img src="/logo/thumb/{{$logo->img}}" width="100"><br>
            <a data-toggle="collapse" href="#changeArtImg" role="button" aria-expanded="false" aria-controls="changeArtImg">Ganti</a>
            <div class="collapse" id="changeArtImg">
              <div class="card card-body">
                <input type="file" name="imgEdit" class="form-control">
              </div>
            </div>
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-warning btn-sm">UPDATE</button>
        </form>
      </div>
    </div>
  </div>
</div>