<div class="thumbnail">
    <div class="form-group">
        <input type="text" name="penerima" id="penerima" placeholder="Nama penerima" class="form-control input-sm" @if($address) value="{{$address->penerima}}" @endif required>
        @if ($errors->has('penerima'))
            <span class="help-block">
                <strong>{{ $errors->first('penerima') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <textarea name="address" id="address" class="form-control" rows="4" placeholder="Alamat rumah" required>@if($address) {!! strip_tags($address->address) !!} @endif</textarea>
        @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <input type="text" name="kabupaten" id="kabupaten" class="form-control input-sm" placeholder="Kabupaten" autocomplete="off" @if($address) value="{{$address->kabupaten}}" @endif required>
        <input type="hidden" name="kabHidden" id="kabHidden" @if($address) value="{{$address->kab_id}}" @endif>
        @if ($errors->has('kabupaten'))
            <span class="help-block">
                <strong>{{ $errors->first('kabupaten') }}</strong>
            </span>
        @endif
        <div id="list-kabupaten-frame">
            <table id="list-kabupaten" class="table table-hover">
                @for($i = 0; $i < count($kabupaten); $i++)
                    <tr>
                        <td class="list-kabupaten-item" data-id="{{$kabupaten[$i]['city_id']}}" data-name="{{$kabupaten[$i]['city_name']}}" postal-code="{{$kabupaten[$i]['postal_code']}}">{{$kabupaten[$i]['type']}} - {{$kabupaten[$i]['city_name']}} - {{$kabupaten[$i]['province']}}</td>
                    </tr>
                @endfor
            </table>
        </div>
    </div>
    <div class="form-group">
        <input type="text" name="kecamatan" id="kecamatan" class="form-control input-sm" placeholder="Kecamatan" autocomplete="off" @if($address) value="{{$address->kecamatan}}" @endif readonly required>
        <input type="hidden" name="kecHidden" id="kecHidden" @if($address) value="{{$address->kec_id}}" @endif>
        @if ($errors->has('kecamatan'))
            <span class="help-block">
                <strong>{{ $errors->first('kecamatan') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <input type="text" name="postal_code" id="postal_code" class="form-control input-sm" placeholder="Kode Pos" autocomplete="off" @if($address) value="{{$address->postal_code}}" @endif readonly required>
    </div>
    <div class="form-group">
        <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Nomor Telephone" autocomplete="off" @if($address) value="{{$address->phone}}" @endif required>
    </div>
</div>
