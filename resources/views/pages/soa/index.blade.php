@extends('layouts.app')
@section('custom_css')
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endsection
@section('title', 'SOA')
    @section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="mb-2"></div>
            <form action="soa/generatesoa" method="POST" id="generatesoa">
                @csrf
                <div class="container">
                    <div class="form-group col-md-4">
                        <label>Client Name</label>
                        <select class="form-control selectpicker" data-live-search="true" data-style="btn-user btn-bordered" name="client_id" required>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Account Number</label>
                        <select class="form-control selectpicker" data-live-search="true" data-style="btn-user btn-bordered" name="account_number" required>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <div></div>
                        <div><button type="submit" class="btn btn-primary btn-md">Generate</button></div>
                    </div>
                </div>
            </form>
            <div class="modal fade" id="modal-soa">
                <div class="modal-dialog modal-size">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container">
                                <div class="form-group button-right">
                                    <button class="btn btn-success" onclick="saveSOA()">Save as Excel</button>
                                </div>
                                <div class="mb-4"></div>
                                <div class="container">
                                    <div class="soa">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--error modal-->
            <div class="modal fade" id="errorPayment">
                <div class="modal-dialog modal-md">
                    <div class="modal-content" style="border: 0;">
                        <div class="modal-header" style="background: #f54b35;color: white;">
                            <h6 style="">Error Generating</h6>
                            <label class="modal-close" data-dismiss="modal" style="margin: 0; color: white;">X</label>
                            </div>
                            <div class="modal-body" style="">
                                <h5>Error Generating, Please try again!</h5>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="preloader" style="display: none"><div class="loader"></div></div>
    @endsection
    @section('custom_js')
    <script src="{{asset('js/jquery.table2excel.js')}}"></script>
    <script src="{{asset('js/pages/soa/soa.js')}}"></script>
    @endsection
