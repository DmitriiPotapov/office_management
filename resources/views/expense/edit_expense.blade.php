@extends('layouts.layout')

@push('header-style')
<!--datapicker-->
<link href="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datarangepicker/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid"  style="margin-left:15px;margin-right:15px;">
    <div class="row page-titles">
        <h3 class="text-themecolor m-b-0 m-t-0">Update Expense</h3>

        <div class="col-md-6 col-8 align-self-center">
        </div>
    </div>
    <div class="row">
        <form action="{{ route('updateExpense') }}" method="post">
        @csrf   
        <input type="hidden" id="expense_id" name="expense_id" value="{{ $expense->id }}">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group" >
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">DESCRIPTION</span>
                </div>
                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id = "description"  name = "description" value="{{ $expense->description }}">  
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="input-group" >
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">DATE</span>
                </div>
                <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy" id="expense_date" name="expense_date" onchange="FormatSelDate()"  value="{{ $expense->date }} ">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="icon-calender"></i></span>
                </div> 
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="input-group" >
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">AMOUNT</span>
                </div>
                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id = "expense_amount" name = "expense_amount"  value="{{ $expense->amount }}"> 
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-4">
            <div class="input-group" >
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">PAYEE</span>
                </div>
                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id = "expense_payee" name = "expense_payee"  value="{{ $expense->payee }}">  
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="input-group" >
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">PAYMENT METHOD</span>
                </div>
                <select class="custom-select" id="payment_method" name="payment_method">                    
                    <option <?php echo $expense->paymentmethod == 'CASH' ? 'selected' : '';?> value="CASH">CASH </option>
                    <option <?php echo $expense->paymentmethod == 'CARD PAYMENT' ? 'selected' : '';?> value="CARD PAYMENT">CARD PAYMENT </option>
                    <option <?php echo $expense->paymentmethod == 'BANK TRANSFER' ? 'selected' : '';?> value="BANK TRANSFER">BANK TRANSFER </option>
                    <option <?php echo $expense->paymentmethod == 'CHEQUE' ? 'selected' : '';?> value="CHEQUE">CHEQUE </option>
                    <option <?php echo $expense->paymentmethod == 'CREDIT' ? 'selected' : '';?> value="CREDIT">CREDIT   </option>          
                    <option <?php echo $expense->paymentmethod == 'CRYPTO PAYMENT' ? 'selected' : '';?> value="CRYPTO PAYMENT">CRYPTO PAYMENT   </option>          
                    <option <?php echo $expense->paymentmethod == 'OTHERS' ? 'selected' : '';?> value="OTHERS">OTHERS   </option>          
                </select>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="input-group" >
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">REF</span>
                </div>
                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id = "reference" name = "reference"  value="{{ $expense->reference }}">  
            </div>
        </div>
    </div><br>
    <span>Note</span>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <textarea class="form-control" rows="8" id = "expense_note" name = "expense_note"  value="{{ $expense->note }}"></textarea>
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

    function FormatSelDate()
    {
        var seldate = $("#expense_date").val();
        var FormateDate = seldate.slice(3,5) + '/';
        FormateDate += seldate.slice(0,2) + '/';
        FormateDate += seldate.slice(6,10);
        $("#expense_date").val(FormateDate);
    }

</script>

@endpush