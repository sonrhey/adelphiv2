var releaseSchedules = $('#tbl-payments').DataTable({
    "bPaginate": false, //hide pagination
    "bFilter": false, //hide Search bar
    "bInfo": false, // hide showing entries
    pageLength: 50,
    processing: true,
    serverSide: false,
    ajax: 'releaseschedule',
    columns: [
        {data: 'due_date', name: 'due_date', orderable: false},
        {data: 'due_ammount', name: 'due_ammount', orderable: false},
        {data: 'interest', name: 'interest', orderable: false},
        {data: 'principal', name: 'principal', orderable: false}
    ]
});