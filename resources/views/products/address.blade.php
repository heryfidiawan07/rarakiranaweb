<div class="thumbnail">
    <div class="form-group">
        <input type="text" name="penerima" placeholder="Nama penerima" class="form-control input-sm" @if($address) value="{{$address->penerima}}" @endif required>
    </div>
    <div class="form-group">
        <textarea name="address" class="form-control" rows="4" placeholder="Alamat rumah" id="address" required>
            @if($address) {{ strip_tags($address->address) }} @endif
        </textarea>
    </div>
    <div class="form-group">
        <input type="text" id="city" name="kabupaten" class="form-control input-sm" placeholder="Kabupaten" @if($address) value="{{$address->kabupaten}}" @endif required>
        <input type="hidden" name="kabHidden" id="kabHidden" @if($address) value="{{$address->kab_id}}" @endif>
        <div id="listcity-frame">
            <table id="listcity" class="table table-hover">
                @for($i = 0; $i < count($city); $i++)
                    <tr>
                        <td class="listcityitem" data-id="{{$city[$i]['city_id']}}" data-name="{{$city[$i]['city_name']}}">{{$city[$i]['type']}} - {{$city[$i]['city_name']}} - {{$city[$i]['province']}}</td>
                    </tr>
                @endfor
            </table>
        </div>
    </div>
    <div class="form-group">
        <input type="text" id="kecamatan" name="kecamatan" class="form-control input-sm" placeholder="Kecamatan" @if($address) value="{{$address->kecamatan}}" @endif required>
    </div>
</div>
