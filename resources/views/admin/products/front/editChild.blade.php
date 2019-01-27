<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$child->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
<!-- Modal -->
<div class="modal fade" id="edit_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$child->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/etalase/update/parent/{{$child->id}}">
            {{ csrf_field() }}
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                <option value="{{$child->parent_id}}">{{$child->childs->name}}</option>
                <option value="0">NO PARENT</option>
                @if($fronts->count())
                    @foreach($fronts->where('setting',0)->where('parent_id',0) as $frontEdit)
                        <option value="{{$frontEdit->id}}">{{$frontEdit->name}}</option>
                    @endforeach
                @endif
            </select>
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
        </form>
      </div>
    </div>
  </div>
</div>