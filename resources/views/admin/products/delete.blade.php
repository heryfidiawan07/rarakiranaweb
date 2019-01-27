<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{$product->id}}">
  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
</button>
<!-- Modal -->
<div class="modal fade" id="delete_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_{{$product->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
            <a href="/product/{{$product->id}}/destroy" class="btn btn-danger btn-sm">
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </a>
        </div>
      </div>
    </div>
  </div>
</div>