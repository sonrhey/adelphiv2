$(document).ready(function(){
	var id = 0;
	var ar = $('#tbl-nationality').DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'nationality/get',
	    columns: [
	        {data: 'name', name: 'name'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ],
	    "columnDefs":[
	    	{"width":"30%", "targets":1}
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
			url:'nationality/'+id,
			beforeSend:function(){
				$('#confirm-button').text('Deleting...');
			},
			success:function(data){
				$('#confirm-button').text('Yes');
				$('#confirm-modal').modal('hide');
				$('#tbl-nationality').DataTable().ajax.reload();
				// location.reload();

			}
		})
	});
	
});

