var ar = $('#tbl-identification-list').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'identification_list/get_all',
    columns: [
        {data: 'code', name: 'code'},
        {data: 'name', name: 'name'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    "columnDefs":[
        {"width":"30%", "targets":2}
    ]
});
