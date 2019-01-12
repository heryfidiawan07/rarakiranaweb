$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    $('#cek').on('click',function(e){
        e.preventDefault();
        $('#cost').text($('#input').val()+' - Under Development');
    });

});