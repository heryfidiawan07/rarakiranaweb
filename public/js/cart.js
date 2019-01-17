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

    $(document).on('click','.listcityitem', function() {
        var text = $(this).text();
        var cityId = $(this).attr('data-id');
        console.log(text+'-'+province);
        $('#city').val(text);
        $('#city').attr('value',cityId);
        $('.listcityitem').fadeOut();
    });

    $('#kurir').change(function(){
        var tujuan = $('#tujuan').attr('value')
        var kurir  = $('#kurir').val();
        var tcr    = $('#kurir option:selected').text()
        var urll   = '/cart/';
        $.ajax({
            type: 'POST',
            url : urll,
            // data:  {data:kurir},
            success : function(data, statusTxt, xhr){
                //console.log(data);
                for (var i = data[0]['costs'].length - 1; i >= 0; i--) {
                    $('#cost').append(
                        '<p>'+tcr
                        +' '+data[0]['costs'][i]['service']
                        +' Rp '+data[0]['costs'][i]['cost'][0]['value']
                        +', <i>'+data[0]['costs'][i]['cost'][0]['etd']+' hari'+'</i></p>'
                    );
                }
            },error: function(data){
                console.log('error');
            }
        });
    });

});