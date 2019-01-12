<!-- Button trigger modal -->
@if($front->parent()->count() < 1)
    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{$front->id}}" @if($front->setting==1) disabled @endif>Delete</button>
@else
    <button class="btn btn-danger btn-xs" disabled>Delete</button>
@endif
<!-- Modal -->
<div class="modal fade" id="delete_{{$front->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_{{$front->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Delete Etalase {{$front->name}} ?</b><hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
            <a href="/etalase/delete/{{$front->id}}" class="btn btn-danger btn-sm">DELETE !</a>
        </div>
      </div>
    </div>
  </div>
</div>