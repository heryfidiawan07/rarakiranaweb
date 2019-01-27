<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#thread_{{$thread->id}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
<!-- Modal -->
<div class="modal fade" id="thread_{{$thread->id}}" tabindex="-1" role="dialog" aria-labelledby="thread_{{$thread->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <a href="/thread/destroy/{{$thread->id}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
        </div>
      </div>
    </div>
  </div>
</div>