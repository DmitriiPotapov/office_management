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
                    <div class="row button-group">
                        <div class="col-lg-12 m-b-30">
                            <button class="btn btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-user"></i></span>Assign job to engineer</button>
                            <button class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-check"></i></span>Admission form</button>
                            <button class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-folder"></i></span>Go to file list</button>
                            <button class="btn btn-warning waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-key"></i></span>Unlock client access</button>
                            <button class="btn btn-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-refresh"></i></span>Refresh file list info</button>
                            <button class="btn btn-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-users"></i></span>Change client</button>
                            <button class="btn btn-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-check"></i></span>Check-out form</button>
                            <button class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-envelope-o"></i></span>Generate invoice</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#general" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">General</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#jobdevices" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Job Devices</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#services" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Services</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cloningmonitor" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Cloning monitor</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#attachments" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Attachments</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#billing" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Billing</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#jobhistory" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">JobHistory</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#log" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Log</span></a> </li>
                        </ul>
                        <hr>
                        <div class="tab-content">
                            <div class="tab-pane active" id="general" role="tabpanel">
                            <form method="POST" action="{{ route('update_Job') }}">
                            @csrf
                                <input type="hidden" name="seljob_id" value="{{ $job['job_id'] }}">
                                <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 control-label"><b>Services:</b></label>
                                                    <input type="hidden" name="services" value="{{ $job['services'] }}">
                                                    <label class="col-lg-4 control-label" >{{ $job['services'] }}</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 control-label"><b>File list password:</b></label>
                                                    <input type="hidden" name="job_password" value="{{ $job['job_password'] }}">
                                                    <label class="col-lg-4 control-label">{{ $job['job_password'] }}<a href="javascript:void(0)"><i class="fa fa-refresh"></i></a></label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-5 control-label"><b>Assigned to engineer:</b></label>
                                                    <input type="hidden" name="assigned_engineer" value="{{ $job['assigned_engineer'] }}">
                                                    <label class="col-lg-4 control-label" >{{ $job['assigned_engineer'] }}</label>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Price
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="price" name="price" value="{{ $job['price'] }}">
                                                </div>
                                                <hr>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Status
                                                        </span>
                                                    </div>
                                                    <select class="form-control custom-select" id="status" name="status">
                                                        <@foreach($statuses as $item)
                                                        <option value="{{ $item['status_name'] }}" {{ ($item['status_name'] == $job['status']) ? 'selected' : '' }}> {{ $item['status_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <hr>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Priority
                                                        </span>
                                                    </div>
                                                    <select class="form-control custom-select" id="priority" name="priority">
                                                        @foreach($priorities as $item)
                                                        <option value="{{ $item['job_priority_name'] }}" {{ ($item['job_priority_name'] == $job['priority']) ? 'selected' : '' }}> {{ $item['job_priority_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <hr>
                                                <div class="form-group row has-success">
                                                    <h4 class="card-title">Job info</h4>
                                                    <textarea class="form-control" rows="3" name="device_malfunc_info">{{ $job['device_malfunc_info'] }}</textarea>
                                                </div>
                                                <hr>
                                                <div class="form-group row has-info">
                                                    <h4 class="card-title">Important data</h4>
                                                    <textarea class="form-control" rows="3" name="important_data">{{ $job['important_data'] }}</textarea>
                                                </div>
                                                <hr>
                                                <div class="form-group row has-danger">
                                                    <h4 class="card-title">Cleint note</h4>
                                                    <textarea class="form-control" rows="3" name="notes">{{ $job['notes'] }}</textarea>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="card">
                                            <h4 class="card-title">Client info</h4>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 control-label"><b>Ime kijentha:</b></label>
                                                    <label class="col-lg-6 control-label">Nthin sivadas</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 control-label"><b>Adresa:</b></label>
                                                    <label class="col-lg-6 control-label">Ambalaparam sivadas</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 control-label"><b>Grad:</b></label>
                                                    <label class="col-lg-6 control-label">926261 sivadas</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 control-label"><b>Drazava:</b></label>
                                                    <label class="col-lg-6 control-label">India</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 control-label"><b>Note:</b></label>
                                                    <label class="col-lg-6 control-label"></label>
                                                </div>
                                                <h4 class="card-title">Patent Devices</h4>
                                                <div class="table-responsive">
                                                    <table class="table color-bordered-table info-bordered-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Type</th>
                                                                <th>Manufacturer</th>
                                                                <th>Model</th>
                                                                <th>Serial</th>
                                                                <th>Location</th>
                                                                <th>Diagnosis</th>
                                                                <th>Note</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($devices as $item)
                                                            @if($item['role'] == 'Patient')
                                                            <tr>
                                                                <td>{{ $item['type'] }}</td>
                                                                <td>{{ $item['manufacturer'] }}</td>
                                                                <td>{{ $item['model'] }}</td>
                                                                <td>{{ $item['serial'] }}</td>
                                                                <td>{{ $item['location'] }}</td>
                                                                <td>{{ $item['diagnosis'] }}</td>
                                                                <td>{{ $item['note'] }}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr>
                                                <h4 class="card-title">Job Clones</h4>
                                                <div class="table-responsive">
                                                    <table class="table color-bordered-table info-bordered-table">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Type</th>
                                                                <th>Manufacturer</th>
                                                                <th>Model</th>
                                                                <th>Serial</th>
                                                                <th>Location</th>
                                                                <th>Note</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($devices as $item)
                                                            @if($item['role'] == 'Clone')
                                                            <tr>
                                                                <td>{{ $item['id'] }}</td>
                                                                <td>{{ $item['type'] }}</td>
                                                                <td>{{ $item['manufacturer'] }}</td>
                                                                <td>{{ $item['model'] }}</td>
                                                                <td>{{ $item['serial'] }}</td>
                                                                <td>{{ $item['location'] }}</td>
                                                                <td>{{ $item['note'] }}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr>
                                                <h4 class="card-title">Job Donors</h4>
                                                <div class="table-responsive">
                                                    <table class="table color-bordered-table info-bordered-table">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Type</th>
                                                                <th>Manufacturer</th>
                                                                <th>Model</th>
                                                                <th>Serial</th>
                                                                <th>Location</th>
                                                                <th>Note</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($devices as $item)
                                                            @if($item['role'] == 'Donor')
                                                            <tr>
                                                                <td>{{ $item['id'] }}</td>
                                                                <td>{{ $item['type'] }}</td>
                                                                <td>{{ $item['manufacturer'] }}</td>
                                                                <td>{{ $item['model'] }}</td>
                                                                <td>{{ $item['serial'] }}</td>
                                                                <td>{{ $item['location'] }}</td>
                                                                <td>{{ $item['note'] }}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr>
                                                <h4 class="card-title">Other client devices</h4>
                                                <div class="table-responsive">
                                                    <table class="table color-bordered-table info-bordered-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Type</th>
                                                                <th>Manufacturer</th>
                                                                <th>Model</th>
                                                                <th>Serial</th>
                                                                <th>Location</th>
                                                                <th>Note</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($devices as $item)
                                                            @if($item['role'] == 'Other')
                                                            <tr>
                                                                <td>{{ $item['type'] }}</td>
                                                                <td>{{ $item['manufacturer'] }}</td>
                                                                <td>{{ $item['model'] }}</td>
                                                                <td>{{ $item['serial'] }}</td>
                                                                <td>{{ $item['location'] }}</td>
                                                                <td>{{ $item['note'] }}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">
                                            Comment
                                        </span>
                                    </div>
                                    <form action="{{ route('send_comment') }}" method="POST">
                                    @csrf
                                    <textarea type="text" class="form-control" rows="3" id="comment" name="comment" placeholder="">{{ $job['last_comment'] }}</textarea>
                                    <input type="hidden" name="comjob_id" value="{{ $job['job_id'] }}">
                                    <button type="submit" class="btn btn-success" > <i class="fa fa-comment"></i> Send comment</button>
                                    </form>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive m-t-40">
                                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>User</th>
                                                            <th>Time</th>
                                                            <th>Note</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($comments as $item)
                                                    <tr>
                                                        <td>{{ $item['user'] }}</td>
                                                        <td>{{ $item['created_at']}}</td>
                                                        <td>{{ $item['note'] }}</td>
                                                        <td>
                                                        <a class="btn btn-circle btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                
                            </div>
                            <div class="tab-pane p-20" id="jobdevices" role="tabpanel">
                                <div class="row button-group">
                                    <div class="col-lg-12 m-b-30">
                                        <button class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-arrows"></i></span>Move selected devices</button>
                                        <button class="btn btn-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-trash"></i></span>Remove selected devices</button>
                                        <button class="btn btn-success waves-effect waves-light" type="button" data-toggle="modal" data-target="#addNewClModal"><span class="btn-label"><i class="fa fa-plus"></i></span>Add new client</button>
                                        <button class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Add device</button>
                                        <button class="btn btn-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-upload"></i></span>Release selected</button>
                                    </div>
                                </div>
                                <form action=" {{ route('add_device') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="addNewClModal" tabindex="-1" role="dialog" >
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Add new device</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body>">
                                                    <input type="hidden" name="sel_job_id_cr" value="{{ $job['job_id'] }}" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                Type
                                                            </span>
                                                        </div>
                                                        <select class="form-control custom-select" id="cr_device_name" name="cr_device_name">
                                                            @foreach($types as $item)
                                                            <option value="{{ $item['device_name'] }}" > {{ $item['device_name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                Role
                                                            </span>
                                                        </div>
                                                        <select class="form-control custom-select" id="cr_role" name="cr_role">
                                                            <option value="Patient" >Patient</option>
                                                            <option value="Data" >Data</option>
                                                            <option value="Donor" >Donor</option>
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                Manufacturer
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" id="cr_manufacturer" name="cr_manufacturer">
                                                    </div>
                                                    <hr>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                Model
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" id="cr_model" name="cr_model">
                                                    </div>
                                                    <hr>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                Serial
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" id="cr_serial" name="cr_serial">
                                                    </div>
                                                    <hr>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                Location
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" id="cr_location" name="cr_location">
                                                    </div>
                                                    <hr>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                Note
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" id="cr_note" name="cr_note">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                <div class="row">
                                    <div class="col-lg-12">
                                    <h4 class="card-title">Patent Devices</h4>
                                        <div class="table-responsive">
                                            <table class="table color-bordered-table info-bordered-table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Type</th>
                                                        <th>Manufacturer</th>
                                                        <th>Model</th>
                                                        <th>Serial</th>
                                                        <th>Location</th>
                                                        <th>Diagnosis</th>
                                                        <th>Note</th>
                                                        <th><th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($devices as $item)
                                                    @if($item['role'] == 'Patient')
                                                    <tr>
                                                        <td><input type="checkbox"></td>
                                                        <td>{{ $item['type'] }}</td>
                                                        <td>{{ $item['manufacturer'] }}</td>
                                                        <td>{{ $item['model'] }}</td>
                                                        <td>{{ $item['serial'] }}</td>
                                                        <td>{{ $item['location'] }}</td>
                                                        <td>{{ $item['diagnosis'] }}</td>
                                                        <td>{{ $item['note'] }}</td>
                                                        <td class="text-nowrap">
                                                            <a href="{{ route('show_edit_job', ['id' => $item['id']]) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                            <a href="#" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <h4 class="card-title">Job Clones</h4>
                                        <div class="table-responsive">
                                            <table class="table color-bordered-table info-bordered-table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>ID</th>
                                                        <th>Type</th>
                                                        <th>Manufacturer</th>
                                                        <th>Model</th>
                                                        <th>Serial</th>
                                                        <th>Location</th>
                                                        <th>Note</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($devices as $item)
                                                    @if($item['role'] == 'Clone')
                                                    <tr>
                                                        <td><input type="checkbox"></td>
                                                        <td>{{ $item['id'] }}</td>
                                                        <td>{{ $item['type'] }}</td>
                                                        <td>{{ $item['manufacturer'] }}</td>
                                                        <td>{{ $item['model'] }}</td>
                                                        <td>{{ $item['serial'] }}</td>
                                                        <td>{{ $item['location'] }}</td>
                                                        <td>{{ $item['note'] }}</td>
                                                        <td class="text-nowrap">
                                                            <a href="{{ route('show_edit_job', ['id' => $item['id']]) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                            <a href="#" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <h4 class="card-title">Job Donors</h4>
                                        <div class="table-responsive">
                                            <table class="table color-bordered-table info-bordered-table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>ID</th>
                                                        <th>Type</th>
                                                        <th>Manufacturer</th>
                                                        <th>Model</th>
                                                        <th>Serial</th>
                                                        <th>Location</th>
                                                        <th>Note</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($devices as $item)
                                                    @if($item['role'] == 'Donor')
                                                    <tr>
                                                        <td><input type="checkbox"></td>
                                                        <td>{{ $item['id'] }}</td>
                                                        <td>{{ $item['type'] }}</td>
                                                        <td>{{ $item['manufacturer'] }}</td>
                                                        <td>{{ $item['model'] }}</td>
                                                        <td>{{ $item['serial'] }}</td>
                                                        <td>{{ $item['location'] }}</td>
                                                        <td>{{ $item['note'] }}</td>
                                                        <td class="text-nowrap">
                                                            <a href="{{ route('show_edit_job', ['id' => $item['id']]) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                            <a href="#" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <h4 class="card-title">Other client devices</h4>
                                        <div class="table-responsive">
                                            <table class="table color-bordered-table info-bordered-table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Type</th>
                                                        <th>Manufacturer</th>
                                                        <th>Model</th>
                                                        <th>Serial</th>
                                                        <th>Location</th>
                                                        <th>Note</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($devices as $item)
                                                    @if($item['role'] == 'Other')
                                                    <tr>
                                                        <td><input type="checkbox"></td>
                                                        <td>{{ $item['type'] }}</td>
                                                        <td>{{ $item['manufacturer'] }}</td>
                                                        <td>{{ $item['model'] }}</td>
                                                        <td>{{ $item['serial'] }}</td>
                                                        <td>{{ $item['location'] }}</td>
                                                        <td>{{ $item['note'] }}</td>
                                                        <td class="text-nowrap">
                                                            <a href="{{ route('show_edit_job', ['id' => $item['id']]) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                            <a href="#" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="services" role="tabpanel">services</div>
                            <div class="tab-pane p-20" id="cloningmonitor" role="tabpanel">cloningmonitor</div>
                            <div class="tab-pane p-20" id="attachments" role="tabpanel">attachments</div>
                            <div class="tab-pane p-20" id="billing" role="tabpanel">billing</div>
                            <div class="tab-pane p-20" id="jobhistory" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <h4 class="card-title">Job History</h4>
                                        <div class="table-responsive">
                                            <table class="table color-bordered-table info-bordered-table">
                                                <thead>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>Client</th>
                                                        <th>Job Priority</th>
                                                        <th>Job Status</th>
                                                        <th>Important Data</th>
                                                        <th>Assigned to</th>
                                                        <th>Comment</th>
                                                        <th>Client info</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Joe</td>
                                                        <td>Nithin</td>
                                                        <td>priority1 +</td>
                                                        <td>Received</td>
                                                        <td>Water Damage</td>
                                                        <td></td>
                                                        <td>Not set</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="log" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="card-title">Log</h4>
                                        <div class="table-responsive">
                                            <table class="table color-bordered-table info-bordered-table">
                                                <thead>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>IP address</th>
                                                        <th>Module</th>
                                                        <th>Action</th>
                                                        <th>Description</th>
                                                        <th>Time and Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Joe</td>
                                                        <td>1.1.1.1</td>
                                                        <td>Job</td>
                                                        <td>Create</td>
                                                        <td>New job created</td>
                                                        <td>2018-12-22</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('footer-script')
<script src="{{ asset('assets/plugins/icheck/icheck.min.js')}}"></script>
<script src="{{ asset('assets/plugins/icheck/icheck.init.js')}}"></script>


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

<script>
$(document).ready(function() {
    $('#example23').DataTable();
});
$('#myTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});
</script>

@endpush