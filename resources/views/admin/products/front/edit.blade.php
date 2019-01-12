<!-- Button trigger modal -->
@if($front->parent()->count() < 1)
    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$front->id}}" @if($front->setting==1) disabled @endif>Edit</button>
@else
    <button class="btn btn-primary btn-xs" disabled>Edit</button>
@endif
<!-- Modal -->
<div class="modal fade" id="edit_{{$front->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$front->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/etalase/update/parent/{{$front->id}}">
            {{ csrf_field() }}
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                @if($front->parent()->count() > 0)
                    <option value="0">This etalase is a parent</option>
                @else
                    <option value="0">NO PARENT</option>
                    @foreach($fronts->where('parent_id',0)->where('setting',0) as $frontEdit)
                        @if($frontEdit->id == $front->id)
                            @continue
                        @endif
                        <option value="{{$frontEdit->id}}">{{$frontEdit->name}}</option>
                    @endforeach
                @endif
            </select>
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-warning btn-sm">UPDATE</button>
        </form>
      </div>
    </div>
  </div>
</div>