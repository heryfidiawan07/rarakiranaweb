$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    
    $('#tujuan').keyup(function(){
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

    $(document).on('click', '#tujuan', function(){
        $(this).val('');
    });

    $(document).on('click','.listcityitem', function() {
        var text = $(this).text();
        var cityId = $(this).attr('data-id');
        //console.log(text+'-'+cityId);
        $('#tujuan').val(text);
        $('#tujuan').attr('value',cityId);
        $('.listcityitem').fadeOut();
    });

    $('#cek').on('click',function(e){
        e.preventDefault();
        var tujuan = $('#tujuan').attr('value')
        var kurir  = $('#kurir').val();
        var tcr    = $('#kurir option:selected').text()
        var urll   = $('#form-ongkir').attr('action')+'/'+tujuan+'/'+kurir;
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

    $(document).on('click','#cek',function(e){
        $('#cost p').text('');
    });

});