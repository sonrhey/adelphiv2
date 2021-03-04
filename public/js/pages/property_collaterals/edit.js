$(document).ready(function(){

	var family_member = $('#tbl-property-collaterals').DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'property_collaterals',
	    columns: [
	    	{data: 'name_registered', name: 'name_registered'},
	        {data: 'property_address', name: 'property_address'},
	        {data: 'lot_area', name: 'lot_area'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ]
	});

});