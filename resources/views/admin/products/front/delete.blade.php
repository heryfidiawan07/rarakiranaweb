<!-- Button trigger modal -->
@if($front->parent()->count() < 1)
    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#etalase_delete_{{$front->id}}" @if($front->setting==1) disabled @endif>
      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    </button>
@else
    <button class="btn btn-danger btn-xs" disabled><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
@endif
<!-- Modal -->
<div class="modal fade" id="etalase_delete_{{$front->id}}" tabindex="-1" role="dialog" aria-labelledby="etalase_delete_{{$front->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
            <a href="/etalase/delete/{{$front->id}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
        </div>
      </div>
    </div>
  </div>
</div>