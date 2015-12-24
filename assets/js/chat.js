$(document).ready(function(){	
	$('#chat-box').slimScroll({
		height: '400px',
		start: 'top'
	});
		
	$('#form-chat').bind("keypress", function(e) {
		if (e.keyCode == 13) {               
			e.preventDefault();
		}
	});	
			
	$('input[name="chat"]').keypress(function (e) {
		if (e.which == 13) {
			$('#form-chat').submit();
		}
	});	
	
	$("#form-chat").submit(function(event){
		$.ajax({
			type:'POST',
			url:base_url+'index.php/chat/set',
			data:$(this).serialize(),
			success:function(str){
				$('#form-chat')[0].reset();
				$('input[name="chat"]').focus();
				$('#chat-box').prepend(str);
			}
		});
		event.preventDefault();
	});	
	
	//refresh
	var auto_refresh = setInterval(
	function (){
		load_chat();
	}, 5000);
	
	load_chat();
	function load_chat(){
		$('.chat').load(base_url+'index.php/chat/get');
	}
});
