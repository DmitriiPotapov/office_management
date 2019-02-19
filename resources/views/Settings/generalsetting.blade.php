@extends('layouts.layout')

@push('header-style')

<link href="{{ asset('assets/plugins/icheck/skins/all.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/dropify/dist/css/dropify.min.css')}}" rel="stylesheet">

@endpush

@section('content')

@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif

<div class="container-fluid">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">General Settings</h3>
    </div>
    <br>
    <form action="{{ route('SaveCompanyInfo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-body">
            <h4 class="card-title" style="margin-bottom:15px;margin-top:15px;">Compnay Logo</h4>
            <div class="row">
                <div class="col-md-12">
                    <div >
                        <input type="file" id="input-file-now" name="companyLogo" class="dropify" />
                    </div>
                </div><br><br>
            </div>
            <h4 class="card-title" style="margin-bottom:15px;margin-top:15px;">Compnay Details</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group" >
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Name</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id = "name"  name = "name" value="{{ $company['company_name'] }}">  
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group" >
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Mobile</span>
                        </div>
                        <input type="text" class="form-control mydatepicker" id="mobile" name="mobile" value="{{ $company['mobile'] }}">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group" >
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Telephone</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id = "telephone" name = "telephone" value="{{ $company['phone'] }}"> 
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group" >
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id = "email"  name = "email" value="{{ $company['email'] }}">  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group" >
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Website</span>
                        </div>
                        <input type="text" class="form-control mydatepicker" id="website" name="website" value="{{ $company['website'] }}">
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group" >
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Adress</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id = "address"  name = "address" value="{{ $company['address'] }}">  
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group" >
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">City</span>
                        </div>
                        <input type="text" class="form-control mydatepicker" id="city" name="city" value="{{ $company['city'] }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group" >
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Country</span>
                        </div>
                        <input type="text" class="form-control mydatepicker" id="country" name="country" value="{{ $company['country'] }}">
                    </div>
                </div>
            </div>
        </div><br>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            <a href = "{{URL::to('expense/resetAction')}}"><button type="button" class="btn btn-warning">Cancel</button></a>
        </div>
    </form> 
</div>

@endsection

@push('footer-script')
<script src="{{ asset('assets/plugins/icheck/icheck.min.js')}}"></script>
<script src="{{ asset('assets/plugins/icheck/icheck.init.js')}}"></script>
<script src="{{ asset('assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>


<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->


<script src="{{ asset('js/typeahead.bundle.min.js')}}"></script>

<script>

</script>

@endpush