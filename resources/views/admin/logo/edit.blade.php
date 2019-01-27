<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$logo->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
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
            <textarea id="descriptionEdit" cols="5" class="form-control" name="descriptionEdit" required autofocus>
                {{$logo->description}}
            </textarea>
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
            <button type="submit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
        </form>
      </div>
    </div>
  </div>
</div>