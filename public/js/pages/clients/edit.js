$(document).ready(function(){

	var family_member = $('#tbl-family').DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'family',
	    columns: [
	    	{data: 'first_name', name: 'first_name'},
	        {data: 'middle_name', name: 'middle_name'},
	        {data: 'last_name', name: 'last_name'},
	        {data: 'relation', name: 'relation'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ],
	    "columnDefs":[
	    	{"width":"20%", "targets":4}
	    ],
	});
	var banks = $('#tbl-bank').DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'bank_accounts',
	    columns: [
	    	{data: 'account_name', name: 'account_name'},
	        {data: 'account_number', name: 'account_number'},
	        {data: 'branch_location', name: 'branch_location'},
	        {data: 'year_opened', name: 'year_opened'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ],
	    "columnDefs":[
	    	{"width":"20%", "targets":4}
	    ],
	});
	var banks = $('#tbl-employment').DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'employments',
	    columns: [
	    	{data: 'company_name', name: 'company_name'},
	        {data: 'position', name: 'position'},
	        {data: 'length_stay', name: 'length_stay'},
	        {data: 'monthly_income', name: 'monthly_income'},
	        {data: 'status', name: 'status'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ],
	    "columnDefs":[
	    	{"width":"20%", "targets":5}
	    ],
	});
});