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
                {data: 'id_number', name: 'id_number'}
            ]
        });
    });