$('#active').change(function(){
	if ($('#active').val() == 'no'){
		$('.current-activities').hide();
	} else {
		$('.current-activities').show();		
	}
});