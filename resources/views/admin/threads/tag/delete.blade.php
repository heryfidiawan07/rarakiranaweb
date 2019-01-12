<!-- Button trigger modal -->
@if($tag->parent()->count() < 1)
  <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{$tag->id}}" @if($tag->setting==1) disabled @endif>Delete</button>
@else
  <button class="btn btn-danger btn-xs" disabled>Delete</button>
@endif
<!-- Modal -->
<div class="modal fade" id="delete_{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_{{$tag->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Delete {{$tag->name}} ?</b><hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <a href="/tag/delete/{{$tag->id}}" class="btn btn-danger btn-sm">Delete !</a>
        </div>
      </div>
    </div>
  </div>
</div>