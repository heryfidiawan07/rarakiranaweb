@if($front->parent()->count() < 1)
    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#status_{{$front->id}}" @if($front->setting==1) disabled @endif><span class="caret"></span></button>
@else
    <button class="btn btn-default btn-xs" disabled><span class="caret"></span></button>
@endif
@if($front->status == 1)
  <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
@else
  <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
@endif
<!-- Modal -->
<div class="modal fade" id="status_{{$front->id}}" tabindex="-1" role="dialog" aria-labelledby="status_{{$front->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="text-center">
            <b>Change Etalase Status {{$front->name}} ?</b><hr>
            <form method="POST" action="/product/front/{{$front->id}}/status">
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