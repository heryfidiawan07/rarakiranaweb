$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    
    $('#city').keyup(function(){
        var filter = $(this).val(), count = 0;
        $("#listcity .listcityitem").each(function () {
            var current = $('.listcityitem').attr('data-name');
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
            } else {
                $(this).show();
                count++;
            }
        });
        if (this.value.length < 4) {
            $('.listcityitem').hide();
        }
    });

    $(document).on('click', '#city', function(){
        $(this).val('');
        $('#services .listservice').remove();
    });

    $(document).on('click','.listcityitem', function() {
        var text = $(this).text();
        var cityId = $(this).attr('data-id');
        //console.log(text+'-'+cityId);
        $('#city').val(text);
        $('#city').attr('value',cityId);
        $('#kabHidden').attr('value',cityId);
        $('.listcityitem').fadeOut();
    });

    $('#kurir').change(function(){
        var city   = $('#city').attr('value')
        var kurir  = $('#kurir').val();
        var urll   = '/get-services/'+city+'/'+kurir;
        if (kurir == 0) {
            console.log('Harap isi kurir pengiriman');
        }else{
            $.ajax({
                type: 'POST',
                url : urll,
                // data:  {data:kurir},
                success : function(data, statusTxt, xhr){
                    //console.log(statusTxt);
                    for (var i = data[0]['costs'].length - 1; i >= 0; i--) {
                        $('#services').append(
                            '<option class="listservice" data-key="'+i+'" value="'+data[0]['costs'][i]['service']+'">'
                            +data[0]['costs'][i]['service']+'</option>'
                        );
                    }
                },error: function(data){
                    console.log('error');
                }
            });
        }
    });

    $('#kurir').click(function(){
        $('#services .listservice').remove();
    });

    $(document).on('change','#services', function(){
        var city     = $('#city').attr('value')
        var kurir    = $('#kurir').val();
        var services = $('#services').val();
        var key      = $(this).find(':selected').attr('data-key');
        var subtotal = $('#subtotal').attr('data-price');
        var urll     = '/get-ongkir-services/'+city+'/'+kurir+'/'+key;
        $.ajax({
            type: 'POST',
            url : urll,
            // data:  {data:kurir},
            success : function(data, statusTxt, xhr){
                //console.log(data); 
                $('#keyServ').val(key);
                $('#ongkir').text('Rp '+data.ongkir);
                $('#tagihan').text('Rp '+data.tagihan);
            },error: function(data){
                console.log('error');
            }
        });
    });

    $('#checkout').on('click', function(e){
        //e.preventDefault();
        //$("#qty").prop('required',true);
        var slug = $('#slug').attr('data-slug');
        var qty  = $('#qty').val();
        var address = $('#address').val();
        var tujuan = $('#city').attr('value');
        var kecamatan = $('#kecamatan').val();
        var kurir  = $('#kurir').val();
        var serv   = $('#services').val();
        
        var urll = '/product/checkout/'+slug+'/'+qty+'/delivery/'+tujuan+'/'+kurir+'/'+serv;
        console.log(urll);
    });

});