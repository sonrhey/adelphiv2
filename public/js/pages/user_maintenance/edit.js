$(document).ready(function(){

	getChecked();

	function getChecked(){
		$("input[name=hasSub]").click(function(){
			var id = $(this).val();
			console.log(id);
			if ($(this).prop("checked")) {
				
				$('input[data-id=sub'+id+']').prop("checked",true);
			}else{
				$('input[data-id=sub'+id+']').prop("checked",false);
			}

		});
	}
	$('#user-form').submit(function(e){
		e.preventDefault();
		var first_name = $('input[name=first_name]').val();
		var last_name = $('input[name=last_name]').val();
		var username = $('input[name=username]').val();
		var usertypeid = $('select[name=user_type_id]').val();
		$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			method:'POST',
			url: 'store',
			data: {first_name:first_name, last_name:last_name, username:username, usertypeid:usertypeid},
			success:function(data){
			}
		});
		$('input[type=checkbox]').each(function(){
			var id = $(this).val();
			var check = 0;
			if ($(this).prop("checked")) {
				check = 1;
			}else{
				check = 0;
			}
			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method:'POST',
				url: 'storeaccess',
				data: {id:id, check:check},
				success:function(data){
					location.reload();
				}
		});
			
		});

	});
});