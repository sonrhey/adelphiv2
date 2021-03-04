@extends('layouts.app')
@section('title', 'Banks')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <a class="btn btn-success mb-5 float-right" href="{{URL('banks/create')}}">Add New</a>
                    <table class="table table-bordered datatables" id="tbl-banks">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>    
                    </table>
                </div>
            </div>
        </div>

@include('alerts.confirm')
    @endsection
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.jqueryui.min.css') }}">
@endsection
@section('custom_js')
    <!-- Start datatable js -->
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/pages/banks/index.js') }}"></script>
    <script>
        // $(document).ready(function(){
        //     $(document).on('click','#delete', function(){
        //         var id = $(this).attr('data-id');
        //         var name = $(this).attr('data-name');
        //         $('#to-delete').html(name);
        //         var a = '<form method="POST" action="banks/'+id+'">'
        //             +'@csrf'
        //             +'@method("delete")'
        //             +'<button type="submit" class="btn btn-primary" id="yes">Yes</button> '
        //             +' <button type="button" class="btn btn-danger" id="no">No</button>'
        //             +'</form>';
        //         $('.modal-footer').html(a);
        //         $('#confirm-modal').modal('show');
        //     });
        //     $(document).on('click','#no', function(){
        //         $('#confirm-modal').modal('hide');
        //     });
        // });
    </script>
@endsection