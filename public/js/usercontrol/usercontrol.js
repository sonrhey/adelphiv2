$(document).ready(function(){
	var idHidden;
	var id;
	$("#btnSubmit1").click(function(e){
		var typename = $('#name').val();	
		var action =$('#usertypeform').attr('action');
			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				type: "post",
				url: action,
				data: { typename:typename },
				success: function(data){
				
					window.location.reload();
				},
				error: function(data){
					alert(data);	
				}
			});
		
	});

	$(".editBtn").click(function(){
		var APP_URL = $('meta[name="_base_url"]').attr('content');
		id = $(this).val();
		$.ajax({
			type: 'GET',
			url: APP_URL+'/usermaintenance/getAccess/'+id,
			success: function(data){
				idHidden = id;

				$(".firstbatch").html(data);
				
			}
		});
	});

	var moduleid, checked;
	$("#btnSubmit").click(function(e){
		
		// alert($('#editusertypeform input:checkbox').length);			
		var action = $('#editusertypeform').attr('action');	
		$('#editusertypeform input:checkbox').each(function(){				
			var usertypeid = $(this).attr('id');

			if ($(this).prop("checked")) {				
				moduleid = $(this).val();							
				checked = 'checked';

			}else{
				moduleid = $(this).val();							
				checked = 'notchecked';
			}
			
			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				type: "post",
				url: action,
				data: { moduleid:moduleid, checked:checked, usertypeid:usertypeid },
				success: function(data){
				// alert(data);	
					window.location.reload();
				},
				error: function(data){
					alert(data);	
				}
			});
		});
		
	});

	$(".deleteBtn").click(function(){
		var APP_URL = $('meta[name="_base_url"]').attr('content');
		var uid = $(this).val();
		$.ajax({
			type: 'GET',
			url: APP_URL+'/usermaintenance/getusertype/'+uid,
			success: function(data){
				$(".usertype").html(data);
				
			}
		});
	});

	$("#btndelete").click(function(){

		var userid = $('#uid').val();
		var action = $('#deletemodalform').attr('action');
		// alert(action);
		$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			type: "post",
			url: action,
			data: { userid:userid },
			success: function(data){
				alert(data);	
					window.location.reload();
				},
				error: function(data){
					alert(data);	
				}
		});
	});
	

});