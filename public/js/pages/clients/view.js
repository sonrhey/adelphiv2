$(document).ready(function(){

	var family_member = $('#tbl-family').DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'viewfamily',
	    columns: [
	    	{data: 'first_name', name: 'first_name'},
	        {data: 'middle_name', name: 'middle_name'},
	        {data: 'last_name', name: 'last_name'},
	        {data: 'relation', name: 'relation'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ]
	});

	var banks = $('#tbl-bank').DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'viewbankaccount',
	    columns: [
	    	{data: 'account_name', name: 'cb.account_name'},
	        {data: 'account_number', name: 'cb.account_number'},
	        {data: 'branch_location', name: 'cb.branch_location'},
	        {data: 'year_opened', name: 'cb.year_opened'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ]
	});
	var banks = $('#tbl-employment').DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'viewemployment',
	    columns: [
	    	{data: 'company_name', name: 'company_name'},
	        {data: 'position', name: 'position'},
	        {data: 'length_stay', name: 'length_stay'},
	        {data: 'monthly_income', name: 'monthly_income'},
	        {data: 'status', name: 'status'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ]
	});
});