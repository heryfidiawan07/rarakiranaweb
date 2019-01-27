<!-- Button trigger modal -->
@if($menu->parent()->count() < 1)
  <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{$menu->id}}" @if($menu->setting==1) disabled @endif ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
@else
  <button class="btn btn-danger btn-xs" disabled><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
@endif
<!-- Modal -->
<div class="modal fade" id="delete_{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_{{$menu->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>DELETE MENU {{$menu->name}} ?</b><hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <a href="/menu/delete/{{$menu->id}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
        </div>
      </div>
    </div>
  </div>
</div>