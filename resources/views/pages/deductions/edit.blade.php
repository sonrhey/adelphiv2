@extends('layouts.app')
@section('title', 'Create Deductions')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{URL('loan_amount/'.$id.'/deductions/'.$amount->id.'/update')}}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="loan_amount_id" value="{{ $id }}">
                        <h3>Loan Amount : &#8369; <span id="_loanamount"><?php echo number_format($amount->loanamounts->amount) ?></span></h3>
                        <hr style="border: 1px dashed #afafaf">
                        <div class="mb-3"></div>
                        <fieldset>
                            <legend>Deduction Location</legend>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Select Location</label>
                                    <select class="form-control input-md" name="location_deduction_id">
                                        <option>Select Location</option>
                                        @foreach($dlocation as $dl)
                                            @if($dl->id == $amount->location_deduction_id)
                                                <option value="{{ $dl->id }}" selected>{{ $dl->location_name }}</option>
                                            @else
                                                <option value="{{ $dl->id }}">{{ $dl->location_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <div class="mb-3"></div>
                        <fieldset>
                            <legend>Handling</legend>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Commission Amount</label>
                                    <input type="text" class="form-control" name="commission_amount"  value="<?php if(!is_null($loanamount))  echo $loanamount->commission_amount ?>">
                                </div>
                                <div class="col-md-4">
                                    <label>Service Fee Amount</label>
                                    <input type="text" class="form-control" name="service_fee_amount" value="<?php if(!is_null($loanamount))  echo $loanamount->service_fee_amount ?>">
                                </div>
                                <div class="col-md-4">
                                    <label>Total Handling Fee</label>
                                    <input type="text" class="form-control" name="total_handling_fee" value="<?php if(!is_null($loanamount))  echo $loanamount->total_handling_fee ?>" readonly>
                                </div>
                            </div>
                        </fieldset>
                        <div class="mb-3"></div>
                        <fieldset>
                            <legend>Notarial</legend>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Promi Note</label>
                                    <input type="text" class="form-control" name="promi_note" value="<?php if(!is_null($loanamount))  echo $loanamount->promi_note ?>">
                                </div>
                                <div class="col-md-3">
                                    <label>SPA</label>
                                    <input type="text" class="form-control" name="spa" value="<?php if(!is_null($loanamount))  echo $loanamount->spa ?>">
                                </div>
                                <div class="col-md-3">
                                    <label>REM</label>
                                    <input type="text" class="form-control" name="rem" value="<?php if(!is_null($loanamount))  echo $loanamount->rem ?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Total Notarial</label>
                                    <input type="text" class="form-control" name="total_notarial" value="<?php if(!is_null($loanamount))  echo $loanamount->total_notarial ?>" readonly>
                                </div>
                            </div>
                        </fieldset>
                        <div class="mb-3"></div>
                        <fieldset>
                            <legend>Appraisal</legend>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Appraisal</label>
                                    <input type="text" class="form-control" name="appraisal" value="<?php if(!is_null($loanamount))  echo $loanamount->appraisal ?>">
                                </div>
                            </div>
                        </fieldset>
                        <div class="mb-3"></div>
                        <fieldset>
                            <legend>Annotation</legend>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Chart Fee</label>
                                    <input type="text" class="form-control" name="chart_fee" value="<?php if(!is_null($loanamount))  echo $loanamount->chart_fee ?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Formulated fee</label>
                                    <input type="text" class="form-control" name="formulated_fee" value="<?php if(!is_null($loanamount))  echo $loanamount->formulated_fee ?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Fixed amount</label>
                                    <input type="text" class="form-control" name="fixed_amount" value="<?php if(!is_null($loanamount))  echo $loanamount->fixed_amount ?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Legal fees</label>
                                    <input type="text" class="form-control" name="legal_fee" value="<?php if(!is_null($loanamount))  echo $loanamount->legal_fee ?>">
                                </div>
                            </div>
                            <div class="mb-3"></div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Total Annotation</label>
                                    <input type="text" class="form-control" name="total_annotation" value="<?php if(!is_null($loanamount))  echo $loanamount->total_annotation ?>" readonly>
                                </div>
                            </div>
                        </fieldset>
                        <div class="mb-3"></div>
                        <div class="row">
                            <div class="col-md-3">
                                <fieldset>
                                    <legend>Document Stamp</legend>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md">
                                            <label>Doc Stamp & Tips</label>
                                            <input type="text" class="form-control" name="document_stamp" value="<?php if(!is_null($loanamount))  echo $loanamount->document_stamp ?>">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                                <fieldset>
                                    <legend>Relocation Fee</legend>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md">
                                            <label>Relocation Fee</label>
                                            <input type="text" class="form-control" name="relocation_fee" value="<?php if(!is_null($loanamount))  echo $loanamount->relocation_fee ?>">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                                <fieldset>
                                    <legend>Insurance</legend>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md">
                                            <label>Insurance</label>
                                            <input type="text" class="form-control" name="insurance" value="<?php if(!is_null($loanamount))  echo $loanamount->insurance ?>">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-3">
                                <fieldset>
                                    <legend>Taxes</legend>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md">
                                            <label>Taxes</label>
                                            <input type="text" class="form-control" name="taxes" value="<?php if(!is_null($loanamount))  echo $loanamount->taxes ?>">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="mb-3"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Total Deductions</legend>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label>Total Deductions</label>
                                            <input type="text" class="form-control" name="total_deductions" value="<?php if(!is_null($loanamount))  echo $loanamount->total_deductions ?>" readonly>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Net Proceeds</legend>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label>Net Proceeds</label>
                                            <input type="text" class="form-control" name="net_proceeds" value="<?php if(!is_null($loanamount)) echo $loanamount->net_proceeds ?>" readonly>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="mb-4"></div>
                        <div class="form-group">
                            <a href="/loan_amount" class="btn btn-danger">Back</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.jqueryui.min.css') }}">
@endsection
@section('custom_js')
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/pages/deductions/deductions.js') }}"></script>
@endsection