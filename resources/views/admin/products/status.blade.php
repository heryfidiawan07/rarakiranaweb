<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#status_{{$product->id}}"><span class="caret"></span> Status
@if($product->status == 1)
  <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
@else
  <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
@endif
</button>
<!-- Modal -->
<div class="modal fade" id="status_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="status_{{$product->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Change status this product ?</b><hr>
            <form method="POST" action="/product/status/{{$product->id}}">
              {{ csrf_field() }}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" name="status" value="1" class="btn btn-success btn-sm">Active</button>
                <button type="submit" name="status" value="0" class="btn btn-danger btn-sm">Not Active</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>