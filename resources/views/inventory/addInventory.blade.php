@extends('layouts.layout')

@push('header-style')

<link href="{{ asset('assets/plugins/icheck/skins/all.css')}}" rel="stylesheet">

@endpush

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-body">
                    <form method="POST" action="{{ route('add_new_Permission') }}">
                    @csrf
                        <div class="form-body">
                            <h4 class="card-title">Acquired from</h4>
                            <div class="row p-t-20">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="Acquired from" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> </div>
                                </div>
                            </div>
                            <h4 class="card-title">Device type</h4>
                            
                            <div class="row p-t-20">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Item role
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="role" name="status">
                                            <option value="Received">Clone</option>
                                            <option value="In process">Patient</option>
                                            <option value="Waiting for parts">Donor</option>
                                            <option value="Paid">Paid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Strage Type
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="storagetype" name="status">
                                            <option value="HDD">HDD</option>
                                            <option value="FLASH">FLASH</option>
                                            <option value="MEMORY">MEMORY</option>
                                            <option value="Laptop">Laptop</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title">Basic info</h4>
                            <div class="row p-t-20">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="Manufacturer " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="Model " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="Serial " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="Part Number " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="GB " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="LBA Number " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control custom-select" id="priority" name="priority">
                                            <option value="Normal">Laptop</option>
                                            <option value="Priority 1">HDD</option>
                                            <option value="Priority 1+">MEMORY</option>
                                            <option value="Priority 2">FLASH RAM</option>
                                        </select>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control custom-select" id="role" name="role">
                                            <option value="Normal">Patient</option>
                                            <option value="Priority 1">Clone</option>
                                            <option value="Priority 1+">Donor</option>
                                        </select>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="Manufacturer" required>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" id="model" name="client" class="form-control" placeholder="Model" required>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" id="serial" name="client" class="form-control" placeholder="Serial" required>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" id="location" name="client" class="form-control" placeholder="Location" required>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                            </div> 
                            <h4 class="card-title">Device malfunction information</h4>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="8"></textarea>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                                </div>
                            </div> 
                            <h4 class="card-title">Important Data</h4>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="8"></textarea>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                                </div>
                            </div> 
                            <h4 class="card-title">Notes</h4>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="8"></textarea>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                                </div>
                            </div>                           
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            <button type="button" class="btn btn-inverse">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('footer-script')
<script src="{{ asset('assets/plugins/icheck/icheck.min.js')}}"></script>
<script src="{{ asset('assets/plugins/icheck/icheck.init.js')}}"></script>
@endpush