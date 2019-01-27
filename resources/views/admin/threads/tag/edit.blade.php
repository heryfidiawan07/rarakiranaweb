<!-- Button trigger modal -->
@if($tag->parent()->count() < 1)
    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_{{$tag->id}}" @if($tag->setting==1) disabled @endif><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
@else
    <button class="btn btn-primary btn-xs" disabled><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
@endif
<!-- Modal -->
<div class="modal fade" id="edit_{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$tag->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="/tag/update/parent/{{$tag->id}}">
        {{ csrf_field() }}
            <label>Parent</label>
            <select name="parent_edit" class="form-control">
                <option value="0">NO PARENT</option>
                @foreach($tags->where('parent_id',0)->where('setting',0) as $tagEdit)
                    @if($tagEdit->id == $tag->id)
                        @continue
                    @endif
                    <option value="{{$tagEdit->id}}">{{$tagEdit->name}}</option>
                @endforeach
            </select>
            <hr>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
        </form>
      </div>
    </div>
  </div>
</div>