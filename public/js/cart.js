$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    
    $('#kabupaten').keyup(function(){
        var filter = $(this).val(), count = 0;
        $("#list-kabupaten .list-kabupaten-item").each(function () {
            var current = $('.list-kabupaten-item').attr('data-name');
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });
        if (this.value.length < 4) {
            $('.list-kabupaten-item').hide();
        }
    });

    $('#kecamatan').on('focus',function(){
        $('.list-kabupaten-item').hide();
    });

    $(document).on('click', '#kabupaten', function(){
        $(this).val('');
        $('#services .list-service').remove();
        $('#ongkir').text('Rp -');
        $('#tagihan').text('Rp -');
    });

    $(document).on('click','.list-kabupaten-item', function() {
        var kabupatenText = $(this).text();
        var kabupatenId   = $(this).attr('data-id');
        $('#kabupaten').val(kabupatenText);
        $('#kabupaten').attr('value',kabupatenId);
        $('#kabHidden').attr('value',kabupatenId);
        $('.list-kabupaten-item').fadeOut();
        $('#kurir').prop("disabled", false);
        $('#kecamatan').prop("readonly", false);
    });

    if ($('#kabHidden').val() > 0) {
        $('#kurir').prop("disabled", false);
    }

    $('#kurir').change(function(){
        var kabupaten = $('#kabHidden').attr('value');
        var kurir     = $('#kurir').val();
        var urll      = '/get-services/'+kabupaten+'/'+kurir;
        $.ajax({
            type: 'POST',
            url : urll,
            success : function(data){//, statusTxt, xhr
                for (var i = data[0]['costs'].length - 1; i >= 0; i--) {
                    $('#services').append(
                        '<option class="list-service" data-key="'+i+'" value="'+data[0]['costs'][i]['service']+'">'
                        +data[0]['costs'][i]['service']+'</option>'
                    );
                }
                $('#services').prop("disabled", false);
            },error: function(data){
                console.log('error');
                alert('Kurir yang anda pilih belum tersedia, silahkan ganti kurir pengiriman yang lain !')
            }
        });
    });

    $('#kurir').click(function(){
        $('#services .list-service').remove();
    });

    $('#services').on('change', function(){
        var kabupaten  = $('#kabHidden').attr('value');
        var kurir      = $('#kurir').val();
        var services   = $('#services').val();
        var keyService = $(this).find(':selected').attr('data-key');
        var subtotal   = $('#subtotal').attr('data-price');
        var urll       = '/get-ongkir-services/'+kabupaten+'/'+kurir+'/'+keyService;
        $.ajax({
            type: 'POST',
            url : urll,
            success : function(data){
                $('#keyService').val(keyService);
                $('#ongkir').text('Rp '+data.ongkir);
                $('#inputOngkir').val(data.intOngkir);
                $('#tagihan').text('Rp '+data.tagihan);
                if ($('#kabHidden').val() > 0) {
                    if ($('#kurir').val() != 0) {
                        if ($('#services').val() != 10) {
                            $('#checkout').prop("disabled", false);
                        }
                    }
                }
            },error: function(data){
                console.log('error');
            }
        });
    });

    // $('#checkout').on('click',function(e){
    //     e.preventDefault();
    //     console.log(
    //             'Penerima: '+$('#penerima').val()+
    //             ' Alamat rumah: '+$('#address').val()+
    //             ' Kabupaten: '+$('#kabupaten').val()+
    //             ' kab-id: '+$('#kabHidden').val()+
    //             ' Kecamatan: '+$('#kecamatan').val()+
    //             ' kec-id: 0'+
    //             ' Catatan: '+$('#note').val()+
    //             ' Kurir: '+$('#kurir').val()+
    //             ' Service: '+$('#services').val()
    //         );
    // });
    // Cart Qty
    $('.plus').on('click', function(){
        var key = $(this).attr('data-key');
        $.ajax({
            type: 'POST',
            url : $(this).attr('data-url')+'/'+key,
            success : function(data){
                $('#price_'+key).text('Rp '+data.price);
                $('#totalPrice').text('Subtotal: Rp '+data.totalPrice);
            },error: function(data){
                console.log('error');
            }
        });
        $(this).prev().val(+$(this).prev().val()+1);
    });
    $('.min').on('click', function(){
        if ($(this).next().val() > 1) {
            var key = $(this).attr('data-key');
            $.ajax({
                type: 'POST',
                url : $(this).attr('data-url')+'/'+key,
                success : function(data){
                    $('#price_'+key).text('Rp '+data.price);
                    $('#totalPrice').text('Subtotal: Rp '+data.totalPrice);
                },error: function(data){
                    console.log('error');
                }
            });
            $(this).next().val(+$(this).next().val()-1);
        }
    });

});