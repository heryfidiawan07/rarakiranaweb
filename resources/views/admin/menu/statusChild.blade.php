<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#status_{{$child->id}}"><span class="caret"></span></button>
@if($child->status == 1)
  <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
@else
  <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
@endif
<!-- Modal -->
<div class="modal fade" id="status_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="status_{{$child->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <form method="POST" action="/menu/status/{{$child->id}}">
              {{ csrf_field() }}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" name="status" value="1" class="btn btn-success btn-sm">Active</button>
                <button type="submit" name="status" value="0" class="btn btn-danger btn-sm">No Active</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>