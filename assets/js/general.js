$(document).ready(function(){	
	$('.sidebar-toggle').click(function(){
		$.ajax({
			method:"POST",
			url:base_url+'index.php/general/sidebar_toggle'
		});		
	});

	//Tanggal
	$( ".tanggal" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy' 		 
	});

	/* - AutoComplete */		
	autocomplete('sex');
	autocomplete('id_type');
	autocomplete('city');
	autocomplete('brand');
	autocomplete('brand_');
	autocomplete('source_type');
	autocomplete('status_verifikasi');
	
	function autocomplete(id){
		$("#"+id).autocomplete({
			source: base_url+"index.php/individual/autocomplete/"+id
			,minLength: 0
		}).focus(function(){
			$(this).autocomplete("search");
		});			
	}	
});