<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#acomment_{{$product->id}}">
</span> <span class="caret"></span> Comment
@if($product->allowed_comment == 1)
  <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
@else
  <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
@endif
</button>
<!-- Modal -->
<div class="modal fade" id="acomment_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="acomment_{{$product->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Allowe comment this product ?</b><hr>
            <form method="POST" action="/product/acomment/{{$product->id}}">
              {{ csrf_field() }}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" name="acomment" value="1" class="btn btn-success btn-sm">Allow</button>
                <button type="submit" name="acomment" value="0" class="btn btn-danger btn-sm">Not Allow</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>