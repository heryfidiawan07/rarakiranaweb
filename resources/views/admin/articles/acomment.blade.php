<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#acomment_{{$article->id}}"><span class="caret"></span> Comment
@if($article->allowed_comment == 1)
  <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
@else
  <span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
@endif
</button>
<!-- Modal -->
<div class="modal fade" id="acomment_{{$article->id}}" tabindex="-1" role="dialog" aria-labelledby="acomment_{{$article->id}}_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">s
      <div class="modal-body"> 
        <div class="text-center">
            <b>Allowed comment this article ?</b><hr>
            <form method="POST" action="/article/acomment/{{$article->id}}">
              {{ csrf_field() }}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" name="acomment" value="1" class="btn btn-success btn-sm">Allow</button>
                <button type="submit" name="acomment" value="0" class="btn btn-danger btn-sm">Not Allow</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>