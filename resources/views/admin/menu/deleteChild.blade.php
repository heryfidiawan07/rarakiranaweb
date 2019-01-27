<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{$child->id}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
<!-- Modal -->
<div class="modal fade" id="delete_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_{{$menu->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>DELETE MENU {{$child->name}} ?</b><hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <a href="/menu/delete/{{$child->id}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
        </div>
      </div>
    </div>
  </div>
</div>