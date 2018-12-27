<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#status_{{$article->id}}"><span class="caret"></span> Status
@if($article->status == 1)
  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
@else
  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
@endif
</button>
<!-- Modal -->
<div class="modal fade" id="status_{{$article->id}}" tabindex="-1" role="dialog" aria-labelledby="status_{{$article->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Change status this article ?</b><hr>
            <form method="POST" action="/article/status/{{$article->id}}">
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