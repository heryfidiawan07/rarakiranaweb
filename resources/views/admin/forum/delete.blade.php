<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{$thread->id}}">Delete</button>
<!-- Modal -->
<div class="modal fade" id="delete_{{$thread->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_{{$thread->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Delete thread {{$thread->title}} ?</b><hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <a href="/forum/destroy/{{$thread->id}}" class="btn btn-danger btn-sm">Delete !</a>
        </div>
      </div>
    </div>
  </div>
</div>