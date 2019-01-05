<form method="POST" action="/send/message/contact">
	{{csrf_field()}}
	@if(session('success'))
      <div class="alert alert-success">
          {{session('success')}}
      </div>
  @endif
	<label>Email</label>
	<input type="email" name="email" class="form-control" value="{{old('email')}}" required>
	<label>Isi Pesan</label>
	<textarea class="form-control" rows="10" name="description" required>{{old('description')}}</textarea>
	<br>
	<div class="g-recaptcha" data-sitekey="6LcHNV4UAAAAAC_pZPPJHAevKgPTiQr5CdnRrzcO" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
  @if ($errors->has('g-recaptcha-response'))
      <span class="help-block">
          <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
      </span>
  @endif
  <input type="submit" class="btn btn-success btn-sm" value="kirim">
</form>