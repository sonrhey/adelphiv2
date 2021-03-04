$(document).ready(function(){
	var id = 0;
	var ar = $('#tbl-penalty').DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'penalties/get',
	    columns: [
	        {data: 'name', name: 'name'},
	        {data: 'percentage', name: 'percentage'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ],
	    "columnDefs":[
	    	{"width":"30%", "targets":2}
	    ]
	});

	$(document).on('click','#delete',function(){
	 	id = $(this).attr('data-id');
	 	var name = $(this).attr('data-name');
		$('#to-delete').html(name);
		$('#confirm-modal').modal('show');
	});
	$('#confirm-button').click(function(){
		$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            method:'DELETE',
			url:'penalties/'+id,
			beforeSend:function(){
				$('#confirm-button').text('Deleting...');
			},
			success:function(data){
				$('#confirm-button').text('Yes');
				$('#confirm-modal').modal('hide');
				$('#tbl-penalty').DataTable().ajax.reload();
				// location.reload();

			}
		})
	});
	
});

