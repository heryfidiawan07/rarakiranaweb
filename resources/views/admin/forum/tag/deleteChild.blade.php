<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{$child->id}}">Delete</button>
<!-- Modal -->
<div class="modal fade" id="delete_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_{{$tag->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Delete category {{$child->menu}} ?</b><hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <a href="/tag/delete/{{$child->id}}" class="btn btn-danger btn-sm">Delete !</a>
        </div>
      </div>
    </div>
  </div>
</div>