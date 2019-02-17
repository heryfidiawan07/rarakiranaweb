<form method="POST" action="/send/message/contact">
	{{csrf_field()}}
	@if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <div class="form-group">
        <label class="control-label">Subject</label>
        <input type="text" name="subject" class="form-control" value="{{old('subject')}}" required>
    </div>
    <div class="form-group">
        <label class="control-label">Email</label>
        @if(Auth::check())
            @if(Auth::user())
                <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" readonly>
            @else
                <input type="email" name="email" class="form-control" value="{{old('email')}}" required>
            @endif
        @endif
    </div>
    <div class="form-group">
        <label class="control-label">Telp / Hp</label>
        <input type="text" name="phone" class="form-control" value="{{old('phone')}}" required>
    </div>
    <div class="form-group">
        <label class="control-label">Isi</label>
        <textarea class="form-control" rows="10" name="description" required>{{old('description')}}</textarea>
    </div>
    <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6LcHNV4UAAAAAC_pZPPJHAevKgPTiQr5CdnRrzcO" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
        <br>
        <?php $url = Request::url(); $cekUrl = explode('/', $url);
            if ($cekUrl[3] == 'show' && $cekUrl[4] == 'product') { ?>
                <input type="hidden" name="product_id" value="<?=$product->id?>">
        <?php }else{ ?>
                <input type="hidden" name="product_id" value="0">
        <?php } ?>
        @if ($errors->has('g-recaptcha-response'))
            <span class="help-block">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-send"></span>
        </button>
    </div>
</form>