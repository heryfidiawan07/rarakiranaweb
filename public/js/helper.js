$(document).ready(function () {

	$('.descriptionEdit').each(function () {
		$(this).val($(this).val().trim());
	});
	
	if($('#product-title').val().length > 50){
		$('#product-title').css('color','red');
		$('#create').attr('disabled',true);
	}
	$('#product-title').keyup(function(){
		//console.log($('#product-title').val().length);
		if($('#product-title').val().length > 50){
			$('#product-title').css('color','red');
			$('#create').attr('disabled',true);
		}else if($('#product-title').val().length < 50){
			$('#product-title').css('color','unset');
			$('#create').attr('disabled',false);
		}
	});

	$("#input-img").on("change", function(){  
	    var countImg = $("#input-img")[0].files.length;
	    if (countImg > 5) {
	    	$("#imgValidate").text(' - File Gambar tidak boleh lebih dari 5 !');
	    	$("#imgValidate").css('display','unset');
	    	$('#create').attr('disabled',true);
	    }
	    if (countImg < 6) {
	    	$("#imgValidate").css('display','none');
	    	$('#create').attr('disabled',false);
	    }
	    //console.log(countImg);
	});

	$("#input-img-edit").on("change", function(){  
		var oldImg 		 = $("#frame-product-img-edit").attr('data-count');
		var inputImg	 = $("#input-img-edit")[0].files.length;
	    var countImgEdit = parseInt(oldImg)+parseInt(inputImg);

	    if (countImgEdit > 5) {
	    	$("#imgEditValidate").text(' - File Gambar tidak boleh lebih dari 5 !');
	    	$("#imgEditValidate").css('display','unset');
	    	$('#create').attr('disabled',true);
	    }
	    if (countImgEdit < 6) {
	    	$("#imgEditValidate").css('display','none');
	    	$('#create').attr('disabled',false);
	    }
	});

});