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

    $(document).on('click', '#kabupaten', function(){
        $(this).val('');
    });

    $(document).on('click','.list-kabupaten-item', function() {
        var text   = $(this).text();
        var cityId = $(this).attr('data-id');
        $('#kabupaten').val(text);
        $('#kabupaten').attr('value',cityId);
        $('.list-kabupaten-item').fadeOut();
    });

    $('#cek').on('click',function(e){
        e.preventDefault();
        var kabupaten = $('#kabupaten').attr('value')
        var kurir     = $('#kurir').val();
        var tcr       = $('#kurir option:selected').text()
        var urll      = $('#form-ongkir').attr('action')+'/'+kabupaten+'/'+kurir;
        $.ajax({
            type: 'POST',
            url : urll,
            success : function(data, statusTxt, xhr){
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