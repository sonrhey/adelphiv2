$(document).ready(function(){


var someTableDT = $("#some-table").on("draw.dt", function () {
    $(this).find(".dataTables_empty").parents('tbody').empty();
}).DataTable(/*init object*/);

	var family_member = $('#id-list').on("draw.dt", function () {
	    $(this).find(".dataTables_empty").parents('tbody').empty();
		}).DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'identification',
	    columns: [
	    	{data: 'name', name: 'name'},
	        {data: 'id_number', name: 'id_number'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ]
	});

	$('[name="idlist"]').on('change', function(){
		var idname = $('[name="idlist"] option:selected').text();
		var id = this.value;
		$('#idlistdata').append(`<tr><td>${idname}</td><td><div class="row"><div class="col-md-6"><input type="text" data-id="${id}" name="idnumber${id}" class="form-control identification"></div></div></td><td><a href="#" class="btn btn-danger btn-rounded btn-xs" id="remove"><span class="fa fa-trash"></span> Remove</a></td></tr>`);
		$(`[name="idnumber${id}"]`).focus();
	});

	$(document).on('click', '#remove', function(){
		$(this).closest('tr').remove();
	});

	$('#identification').on('submit', function(e){
		e.preventDefault();
		var idarray = [];
		var method = $(this).attr('method');
		var url = $(this).attr('action');
		var account_id = $('[name="account_id"]').val();

		$('#idlistdata tr td input.identification').each(function(){
			var id = $(this).attr('data-id');
			var id_number = $(this).val();
			idarray.push({
				"account_id":account_id,
				"identification_list_id":id,
				"id_number":id_number
			});
		});

		$.ajax({ 
			headers:
            {	
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			type: 'post',
			url: url,
			data: 'idsprovided='+JSON.stringify(idarray),
			success: function(response){
				console.log(response);
				window.location.reload();
			},
			error: function(error){
				console.log(idarray);
				alert(error.responseText);
			}
		});
	});

	$(document).on('click', '#finstep', function(){
		$('[name="acctlpid"]').val($(this).attr('data-value'));
		$('#approvemodal').modal("show");
	})

});