$(document).ready(function(){
	var ar = $('#tbl-clients').DataTable({
	    processing: true,
	    serverSide: true,
	    order: [[ 3, "DESC" ]],
	    ajax: 'clients/get',
	    columns: [
	    	{data: 'first_name', name: 'first_name'},
	        {data: 'middle_name', name: 'Middle_name'},
	        {data: 'last_name', name: 'last_name'},
	        {data: 'status', name: 'status',orderable: false, searchable: false},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ],
	    "columnDefs":[
	    	{"width":"25%", "targets":4}
	    ],
	});
});