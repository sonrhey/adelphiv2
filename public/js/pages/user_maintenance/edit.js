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
	$('#user-form').on('submit', function(e){
		e.preventDefault();
        let number_of_uaccess = $('.user-access').find('input:checkbox').length;
        let iteration_count = 0;

        showLoading();

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

		$('.user-access').find('input:checkbox').each(function(){
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
					iteration_count += 1;
                    if (number_of_uaccess === iteration_count) {
                        location.reload();
                    }
				}
		});

		});

	});
});

const showLoading = () => {
    $('html, body').loadingOverlay(true, {
        backgroundColor: 'rgba(0,0,0,0.65)',
    });
}
