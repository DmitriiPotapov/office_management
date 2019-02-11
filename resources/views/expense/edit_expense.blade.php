@extends('layouts.layout')

@push('header-style')
<!--datapicker-->
<link href="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datarangepicker/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
<h1>Update Expense</h1>
<div class="row">
        <div class="col-sm-12 col-xs-12">
          <form action="{{ route('updateExpense') }}" method="post">
          @csrf  
          <input type="hidden" name="expense_id" id="expense_id" value="{{ $expense->id }}" />            
                <span>DESCRIPTION</span>
                 <div class = "row">
                    <div class="input-group" style = "margin: 0px; padding: 0px;">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">DESCRIPTION</span>
                      </div>
                    <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name = "description" value="{{ $expense->description }}">  
                    </div>
                  </div>
                 </div> 
               </div>
               <br />     
                <span>Date</span>
                <div class = "row">
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">DATE</span>
                      </div>
                      
                    <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy" name="expense_date" value="{{ $expense->date }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="icon-calender"></i></span>
                        </div>
                       
                  </div>
                </div>
                <br />              
                <div class="row">
                    <div class="input-group" style="margin: 0px; padding: 0px;">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">AMOUNT</span>
                      </div>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "expense_amount" value="{{ $expense->amount }}">  
                    </div>
                </div>
                <br />

                <div class="row">
                    <div class="input-group" style="margin: 0px; padding: 0px;">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">PAYEE</span>
                        </div>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "expense_payee" value="{{ $expense->payee }}">  
                    </div>
                </div>
                
                <br />

                <div class="row">
                    <div class="input-group" style="margin: 0px; padding: 0px;">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">PAYMENT METHOD</span>
                        </div>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "payment_method" value="{{ $expense->paymentmethod }}">  
                    </div>
                </div>
                
                <br />
                <div class="row">
                    <div class="input-group" style="margin: 0px; padding: 0px;">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">REF</span>
                        </div>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "reference" value="{{ $expense->reference }}">  
                    </div>
                </div>
                <br />

                <span>Note</span>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <textarea class="form-control" rows="8" name = "expense_note">{{ $expense->note }}</textarea>
                          <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                    <a href = "{{URL::to('expense/resetAction')}}"><button type="button" class="btn btn-warning">Reset</button></a>
                </div>              
          </form>
        </div>
    </div>    
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')
<!-- date picker -->
<script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datarangepicker/daterangepicker.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<script>
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
</script>

@endpush