<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#status_{{$thread->id}}"><span class="caret"></span> Status
@if($thread->status == 1)
  <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
@else
  <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
@endif
</button>
<!-- Modal -->
<div class="modal fade" id="status_{{$thread->id}}" tabindex="-1" role="dialog" aria-labelledby="status_{{$thread->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Change status this thread ?</b><hr>
            <form method="POST" action="/thread/status/{{$thread->id}}">
              {{ csrf_field() }}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" name="status" value="1" class="btn btn-success btn-sm">Aktiv</button>
                <button type="submit" name="status" value="0" class="btn btn-danger btn-sm">No Aktiv</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>