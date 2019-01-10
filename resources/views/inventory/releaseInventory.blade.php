@extends('layouts.layout')

@push('header-style')

<link href="{{ asset('assets/plugins/icheck/skins/all.css')}}" rel="stylesheet">

@endpush

@section('content')

<div class="container-fluid">
<!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h4 class="text-themecolor m-b-0 m-t-0">Jobs</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">New job</a></li>
            </ol>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-body">
                    <form method="POST" action="{{ route('add_new_Permission') }}">
                    @csrf
                        <div class="form-body">
                            <h4 class="card-title">Client info</h4>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="Cleint" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> New Client </a></small> </div>
                                </div>
                            </div>
                            <h4 class="card-title">Priority</h4>
                            <div class="row p-t-20">
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <select class="form-control custom-select" id="priority" name="priority">
                                            <option value="Normal">Normal</option>
                                            <option value="Priority 1">Priority 1</option>
                                            <option value="Priority 1+">Priority 1+</option>
                                            <option value="Priority 2">Priority 2</option>
                                        </select>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="Hitan start 8-18h" required>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="Hitan start 00-24h" required>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="client" name="client" class="form-control" placeholder="RAID" required>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                            </div>
                            <h4 class="card-title">Devices</h4>
                            <div class="row p-t-20">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <a class="btn btn-circle btn-sm btn-success" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
                                        <a class="btn btn-circle btn-sm btn-danger" href="javascript:void(0)"><i class="fa fa-times"></i></a>
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