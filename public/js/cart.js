$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $("#inputaddress").keyup(function() {
        var address = $(this).val();
        $("#address").text(address);
    })
      .keyup();

    $('#tujuan').on('click',function(){
        $.ajax({
            type: 'POST',
            url : $(this).attr('data-url'),
            // data:  {data:kurir},
            success : function(data, statusTxt, xhr){
                //console.log(data.length);
                for (var i = data.length - 1; i >= 0; i--) {
                    //console.log(data[i].city_name);
                    $('#listcity').append('<li data-id="'+data[i].city_id+'" data-name="'+data[i].city_name+'" class="listcityitem">'+data[i].city_name+' - '+data[i].type+'</li>');
                }
                $(document).on('click','.listcityitem', function() {
                    var text = $(this).text();
                    var cityId = $(this).attr('data-id');
                    //console.log(text+'-'+cityId);
                    $('#tujuan').val(text);
                    $('#tujuan').attr('value',cityId);
                    $('.listcityitem').fadeOut();
                });
            },error: function(data){
                console.log('error');
            }
        });
    });
    
    $('#tujuan').keyup(function(){
        // var value = $(this).val().toLowerCase();
        // $("#listcity li").filter(function() {
        //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        // });
        //console.log(this.value.length);
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
            $('.listcityitem').fadeOut();
        }
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