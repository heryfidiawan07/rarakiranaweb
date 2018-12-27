<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#status_{{$category->id}}"><span class="caret"></span></button>
@if($category->status == 1)
  <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
@else
  <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
@endif
<!-- Modal -->
<div class="modal fade" id="status_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="status_{{$category->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Change status category {{$category->menu}} ?</b><hr>
            <form method="POST" action="/product/category/{{$category->id}}/status">
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