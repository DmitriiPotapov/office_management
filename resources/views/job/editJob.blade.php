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
        <h3 class="text-themecolor m-b-0 m-t-0">{{ $job->job_id }} - {{$client->client_name}}</h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-body">
                    <div class="row button-group">
                        <div class="col-lg-12 m-b-30">
                            <button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="modal" data-target="#assignto"><span class="btn-label" ><i class="fa fa-user"></i></span>Assign job to engineer</button>
                            <a class="btn btn-success waves-effect waves-light" href="{{ route('admission_form',['job_id' => $job['job_id']]) }}"><span class="btn-label"><i class="fa fa-book"></i></span>Check-in form</a>
                            <button class="btn btn-warning waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-key"></i></span>Unlock client access</button>
                            <a class="btn btn-danger waves-effect waves-light" href="{{ route('checkout_form',['job_id' => $job['job_id']]) }}" ><span class="btn-label"><i class="fa fa-check" ></i></span>Check-out form</a>
                            <a class="btn btn-success waves-effect waves-light" href="{{ route('generate_media_report',['job_id' => $job['job_id']]) }}"><span class="btn-label"><i class="fa fa-envelope-o"></i></span>Media Evaluation Report</a>
                            <a class="btn btn-info waves-effect waves-light" href="{{ route('generate_quote',['job_id' => $job['job_id']]) }}"><span class="btn-label"><i class="fa fa-envelope-o"></i></span>Generate Quote</a>
                            <a class="btn btn-success waves-effect waves-light" href="{{ route('generate_invoice',['job_id' => $job['job_id']]) }}"><span class="btn-label"><i class="fa fa-envelope-o"></i></span>Generate Invoice</a>
                        </div>
                        <div class="modal fade" id="assignto" tabindex="-1" role="dialog" >
                            <form action="{{ route('assign_job') }}" method="POST">
                            @csrf
                                <input type="hidden" name="assign_job_id" value="{{ $job['job_id'] }}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel1">Assign job to engineer</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-body>">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Engineer
                                                        </span>
                                                    </div>
                                                    <select class="form-control custom-select" id="assign_engineer" name="assign_engineer">
                                                        @foreach($engineers as $item)
                                                        <option value="{{ $item['username'] }}" > {{ $item['username']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <hr>                                        
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#general" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">General</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#jobdevices" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Job Devices</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#services" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Services</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#mediainfo" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Media info</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#diagnosis" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Diagnosis</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#attachments" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Attachments</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#quotes" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Quotes</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#billing" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Billing</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#jobhistory" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">JobHistory</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#log" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Log</span></a> </li>
                        </ul>
                        <br>
                        <div class="tab-content">
                            <div class="tab-pane active" id="general" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <form method="POST" action="{{ route('update_Job') }}">
                                            @csrf
                                            <input type="hidden" name="seljob_id" value="{{ $job['job_id'] }}">
                                            <div class="form-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-group row" style="margin-top:5px;margin-bottom:10px;">
                                                            <label class="col-lg-5 control-label"><b>Services:</b></label>
                                                            <input type="hidden" name="services" value="{{ $job['services'] }}">
                                                            <label class="col-lg-4 control-label" >{{ $job['services'] }}</label>
                                                        </div>
                                                        <div class="form-group row" style="margin-top:5px;margin-bottom:10px;">
                                                            <label class="col-lg-5 control-label"><b>Case password:</b></label>
                                                            <input type="hidden" id="job_password" name="job_password" value="{{ $job['job_password'] }}">
                                                            <label class="col-lg-4 control-label" id="job_passwordl">{{ $job['job_password'] }}</label><a href="javascript:void(0)" onclick = "gen_password()""><i class="fa fa-refresh"></i></a>
                                                        </div>
                                                        <div class="form-group row" style="margin-top:5px;margin-bottom:10px;">
                                                            <label class="col-lg-5 control-label"><b>Assigned engineer:</b></label>
                                                            <input type="hidden" name="assigned_engineer" value="{{ $job['assigned_engineer'] }}">
                                                            <label class="col-lg-4 control-label" >{{ $job['assigned_engineer'] }}</label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="basic-addon1">
                                                                            Price
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="price" name="price" value="{{ $job['price'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
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
                                                            </div>
                                                        </div>
                                                        <br>
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
                                                        <br>
                                                        
                                                        <div class="form-group row has-success" style="padding-left:13px;">
                                                            <h4 class="card-title">Job info</h4>
                                                            <select class="form-control custom-select" id="device_malfunc_info" name="device_malfunc_info">
                                                                <option value="Fell down" {{ ($job['device_malfunc_info'] == 'Fell down') ? 'selected' : ''}}>Fell down</option>
                                                                <option value="Not working" {{ ($job['device_malfunc_info'] == 'Not working') ? 'selected' : ''}}>Not working</option>
                                                                <option value="Clicking Sound" {{ ($job['device_malfunc_info'] == 'Clicking Sound') ? 'selected' : ''}}>Clicking Sound</option>
                                                                <option value="Abnormal Noise" {{ ($job['device_malfunc_info'] == 'Abnormal Noise') ? 'selected' : ''}}>Abnormal Noise</option>
                                                                <option value="Water Damage" {{ ($job['device_malfunc_info'] == 'Water Damage') ? 'selected' : ''}}>Water Damage</option>
                                                                <option value="Fire Damage" {{ ($job['device_malfunc_info'] == 'Fire Damage') ? 'selected' : ''}}>Fire Damage</option>
                                                                <option value="Deleted" {{ ($job['device_malfunc_info'] == 'Deleted') ? 'selected' : ''}}>Deleted</option>
                                                                <option value="Formatted" {{ ($job['device_malfunc_info'] == 'Formatted') ? 'selected' : ''}}>Formatted</option>
                                                                <option value="Rebuild" {{ ($job['device_malfunc_info'] == 'Rebuild') ? 'selected' : ''}}>Rebuild</option>
                                                                <option value="PCB Burn" {{ ($job['device_malfunc_info'] == 'PCB Burn') ? 'selected' : ''}}>PCB Burn</option>
                                                                <option value="Overwritten" {{ ($job['device_malfunc_info'] == 'Overwritten') ? 'selected' : ''}}>Overwritten</option>
                                                                <option value="Virus issue" {{ ($job['device_malfunc_info'] == 'Virus issue') ? 'selected' : ''}}>Virus issue</option>
                                                                <option value="Ransomware attack" {{ ($job['device_malfunc_info'] == 'Ransomware attack') ? 'selected' : ''}}>Ransomware attack</option>
                                                                <option value="Password Forget" {{ ($job['device_malfunc_info'] == 'Password Forget') ? 'selected' : ''}}>Password Forget</option>
                                                                <option value="Encryption" {{ ($job['device_malfunc_info'] == 'Encryption') ? 'selected' : ''}}>Encryption</option>
                                                                <option value="File corruption / damage" {{ ($job['device_malfunc_info'] == 'File corruption / damage') ? 'selected' : ''}}>File corruption / damage</option>
                                                                <option value="File missing" {{ ($job['device_malfunc_info'] == 'File missing') ? 'selected' : ''}}>File missing</option>
                                                                <option value="Complete dead" {{ ($job['device_malfunc_info'] == 'Complete dead') ? 'selected' : ''}}>Complete dead</option>
                                                                <option value="Display Broken" {{ ($job['device_malfunc_info'] == 'Display Broken') ? 'selected' : ''}}>Display Broken</option>
                                                                <option value="Others" {{ ($job['device_malfunc_info'] == 'Others') ? 'selected' : ''}}>Others</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group row has-info" style="padding-left:13px;">
                                                            <h4 class="card-title">Important data</h4>
                                                            <textarea class="form-control" rows="3" name="important_data">{{ $job['important_data'] }}</textarea>
                                                        </div>
                                                        <div class="form-group row has-danger" style="padding-left:13px;">
                                                            <h4 class="card-title">Client note</h4>
                                                            <textarea class="form-control" rows="3" name="notes">{{ $job['notes'] }}</textarea>
                                                        </div>
                                                        <div class="form-actions">
                                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="card">
                                            <h4 class="card-title" style="padding-left:20px;padding-top:5px;"><b>Client info</b></h4>
                                            <div class="card-body" style="padding-top:10px;">
                                                <div class="form-group row" style="margin-top:5px;margin-bottom:10px;">
                                                    <label class="col-lg-2 control-label"><b>Name:</b></label>
                                                    <label class="col-lg-3 control-label">{{ $client['client_name'] }}</label>
                                                    <label class="col-lg-2 control-label"><b>Address:</b></label>
                                                    <label class="col-lg-3 control-label">{{ $client['street'] }}</label>
                                                </div>
                                                <div class="form-group row" style="margin-top:5px;margin-bottom:10px;">
                                                    <label class="col-lg-2 control-label"><b>Postal Code:</b></label>
                                                    <label class="col-lg-3 control-label">{{ $client['postal_code'].' '.$client['city_name'] }}</label>
                                                    <label class="col-lg-2 control-label"><b>Country:</b></label>
                                                    <label class="col-lg-3 control-label">{{ $client['country'] }}</label>
                                                </div>
                                                <div class="form-group row" style="margin-top:5px;margin-bottom:10px;">
                                                    <label class="col-lg-2 control-label"><b>Note:</b></label>
                                                    <label class="col-lg-3 control-label">{{ $client['note'] }}</label>
                                                    <label class="col-lg-2 control-label"><b>Email:</b></label>
                                                    <label class="col-lg-3 control-label">{{ $client['email_value'] }}</label>
                                                </div>
                                                <div class="form-group row" style="margin-top:5px;margin-bottom:10px;">
                                                    <label class="col-lg-2 control-label"><b>Phone:</b></label>
                                                    <label class="col-lg-3 control-label">{{ $client['phone_value'] }}</label>
                                                </div>
                                                <br>
                                                <h4 class="card-title">Devices</h4>
                                                <div class="table-responsive">
                                                    <table class="table color-bordered-table info-bordered-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Type</th>
                                                                <th>Brand</th>
                                                                <th>Model</th>
                                                                <th>Serial</th>
                                                                <th>Role</th>
                                                                <th>Diagnosis</th>
                                                                <th>Note</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($devices as $item)
                                                            <tr>
                                                                <td>{{ $item['type'] }}</td>
                                                                <td>{{ $item['manufacturer'] }}</td>
                                                                <td>{{ $item['model'] }}</td>
                                                                <td>{{ $item['serial'] }}</td>
                                                                <td>{{ $item['role'] }}</td>
                                                                <td>{{ $item['diagnosis'] }}</td>
                                                                <td>{{ $item['note'] }}</td>
                                                            </tr>
                                                            @endforeach
                                                            @if ($cloneDevices)
                                                            @foreach($cloneDevices as $item)
                                                            <tr>
                                                                <td>{{ $item['device_type'] }}</td>
                                                                <td>{{ $item['manufacturer'] }}</td>
                                                                <td>{{ $item['model'] }}</td>
                                                                <td>{{ $item['serial_number'] }}</td>
                                                                <td>{{ $item['role'] }}</td>
                                                                <td></td>
                                                                <td>{{ $item['note'] }}</td>
                                                            </tr>
                                                            @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br>
                                                <!--<h4 class="card-title">Job Clones</h4>
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
                                                </div>-->
                                                <div >
                                                    <h4>Comment</h4>
                                                    <form action="{{ route('send_comment') }}" method="POST">
                                                    @csrf
                                                    <textarea type="text" class="form-control" rows="5" id="comment" name="comment" placeholder="">{{ $job['last_comment'] }}</textarea>
                                                    <input type="hidden" name="comjob_id" value="{{ $job['job_id'] }}">
                                                    <button type="submit" class="btn btn-success" style="margin-top:15px;"> <i class="fa fa-comment"></i> Send comment</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                                            <a class="btn btn-circle btn-sm btn-danger" href="{{ route('delete_comment',['id' => $item['id']]) }}"><i class="fa fa-trash"></i></a></td>
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
                                        <button class="btn btn-success waves-effect waves-light" type="button" data-toggle="modal" data-target="#addNewClModal"><span class="btn-label"><i class="fa fa-plus"></i></span>Add new device</button>
                                        <button class="btn btn-info waves-effect waves-light" type="button" data-toggle="modal" data-target="#addCloneModal"><span class="btn-label"><i class="fa fa-plus"></i></span>Add Clone device</button>
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
                                                                Category
                                                            </span>
                                                        </div>
                                                        <select class="form-control custom-select" id="cr_category" name="cr_category">
                                                            <option value="Laptop Drive">Laptop Drive</option>
                                                            <option value="Desktop Drive">Desktop Drive</option>
                                                            <option value="External Drive">External Drive</option>
                                                            <option value="Server Drive">Server Drive</option>
                                                            <option value="Mobile Phone">Mobile Phone</option>
                                                            <option value="Flash Drive">Flash Drive</option>
                                                            <option value="Smart Devices">Smart Devices</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <small class="form-control-feedback"></small> 
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
                                                            <option value="Clone" >Clone</option>
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                Manufacturer
                                                            </span>
                                                        </div>
                                                        <select class="form-control custom-select" id="cr_manufacturer" name="cr_manufacturer">
                                                            <option value="Western Digital">Western Digital </option>
                                                            <option value="Seagate">Seagate</option>
                                                            <option value="Samsung">Samsung</option>
                                                            <option value="Toshiba">Toshiba</option>
                                                            <option value="Apple">Apple</option>
                                                            <option value="HGST">HGST</option>
                                                            <option value="Fujistu">Fujistu</option>
                                                            <option value="Dell">Dell</option>
                                                            <option value="HP">HP</option>
                                                            <option value="IBM">IBM</option>
                                                            <option value="Maxtor">Maxtor</option>
                                                            <option value="Others">Others</option>
                                                        </select>
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
                                                                Capacity
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" id="cr_capacity" name="cr_capacity">
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
                                <form action="{{ route('add_clone_device') }}" method="POST">
                                @csrf
                                    <div class="modal fade" id="addCloneModal" tabindex="-1" role="dialog" >
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="exampleModalLabel1">Add Clone device</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                    <input type="hidden" id = "inventory_job_id" name="inventory_job_id" value="{{ $job->job_id }}">
                                                    <div class="form-body>">
                                                        <div id="scrollable-dropdown-menu">
                                                            <input class="typeahead form-control" type="text" placeholder="InventoryID" id="sel_inventory_id" name="sel_inventory_id" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" id="selInventory">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-lg-12">
                                    <h4 class="card-title">Devices</h4>
                                        <div class="table-responsive">
                                            <table class="table color-bordered-table info-bordered-table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Type</th>
                                                        <th>Brand</th>
                                                        <th>Model</th>
                                                        <th>Serial</th>
                                                        <th>Role</th>
                                                        <th style="width:300px;">Diagnosis</th>
                                                        <th>Note</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($devices as $item)
                                                    <tr>
                                                        <td><input type="checkbox"></td>
                                                        <td>{{ $item['type'] }}</td>
                                                        <td>{{ $item['manufacturer'] }}</td>
                                                        <td>{{ $item['model'] }}</td>
                                                        <td>{{ $item['serial'] }}</td>
                                                        <td>{{ $item['role'] }}</td>
                                                        <td>{{ $item['diagnosis'] }}</td>
                                                        <td>{{ $item['note'] }}</td>
                                                        <td class="text-nowrap">
                                                            <!--<a href="#" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>-->
                                                            <a href="{{ route('delete_device', ['id' => $item['id']]) }}" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @if ($cloneDevices)
                                                    @foreach($cloneDevices as $item)
                                                    <tr>
                                                        <td><input type="checkbox"></td>
                                                        <td>{{ $item['device_type'] }}</td>
                                                        <td>{{ $item['manufacturer'] }}</td>
                                                        <td>{{ $item['model'] }}</td>
                                                        <td>{{ $item['serial_number'] }}</td>
                                                        <td>{{ $item['role'] }}</td>
                                                        <td></td>
                                                        <td>{{ $item['note'] }}</td>
                                                        <td class="text-nowrap">
                                                            <!--<a href="#" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>-->
                                                            <a href="{{ route('delete_clone_device', ['id' => $job['job_id']]) }}" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <!--<h4 class="card-title">Job Clones</h4>
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
                                                            <a href="#" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                            <a href="{{ route('delete_device', ['id' => $item['id']]) }}" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
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
                                                            <a href="#" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                            <a href="{{ route('delete_device', ['id' => $item['id']]) }}" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
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
                                                            <a href="#" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                            <a href="{{ route('delete_device', ['id' => $item['id']]) }}" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>-->
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="services" role="tabpanel">
                                <form action="{{ route('update_service') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="update_service_job_id" value="{{ $job['job_id'] }}">
                                    @foreach ($services as $item)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <input type="radio" id="urg9" name="service_name" value="{{ $item['service_name'] }}" {{ ($job['services'] == $item['service_name'] ? 'checked' : '') }}>
                                                        </span>
                                                    </div>
                                                    <label for="urg9" id="lurg9" name="lurg9" class="form-control">{{$item['service_name']}}</label>
                                                    <small class="form-control-feedback"></small> 
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-md-6">
                                            <br>
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-info waves-effect waves-light" ><span class="btn-label"><i class="fa fa-save"></i></span>Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane p-20" id="services" role="tabpanel">
                                <form action="{{ route('update_service') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="update_service_job_id" value="{{ $job['job_id'] }}">
                                    @foreach ($services as $item)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <input type="radio" id="urg9" name="service_name" value="{{ $item['service_name'] }}" {{ ($job['services'] == $item['service_name'] ? 'checked' : '') }}>
                                                        </span>
                                                    </div>
                                                    <label for="urg9" id="lurg9" name="lurg9" class="form-control">{{$item['service_name']}}</label>
                                                    <small class="form-control-feedback"></small> 
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-md-6">
                                            <hr>
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-info waves-effect waves-light" ><span class="btn-label"><i class="fa fa-save"></i></span>Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane p-20" id="mediainfo" role="tabpanel">
                                <form action="{{ route('update_media_info') }}" method="POST">
                                @csrf
                                    <input type="hidden" name="media_id" value="{{ $devices[0]['id'] }}">
                                    <h3>Drive Details</h3>
                                    <div class="row p-t-20">
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        PN
                                                    </span>
                                                </div>
                                                <input type="text" id="PN" name="PN" class="form-control" placeholder="" value="{{ $devices[0]['PN'] }}">
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        DOM
                                                    </span>
                                                </div>
                                                <input type="text" id="dom" name="dom" class="form-control" placeholder="" value="{{ $devices[0]['dom'] }}">
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        Interface
                                                    </span>
                                                </div>
                                                <select class="form-control custom-select" id="interface" name="interface">
                                                    <option value="Western Digital">USB </option>
                                                    <option value="Seagate">SATA</option>
                                                    <option value="mSATA">mSATA</option>
                                                    <option value="PCi">PCi</option>
                                                    <option value="SAS">SAS</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        Encryption
                                                    </span>
                                                </div>
                                                <input type="text" id="encryption" name="encryption" class="form-control" placeholder="" value="{{ $devices[0]['encryption'] }}">
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-t-20">
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        DCM/MLC
                                                    </span>
                                                </div>
                                                <input type="text" id="dcm_mlc" name="dcm_mlc" class="form-control" placeholder="" value="{{ $devices[0]['dcm_mlc'] }}">
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        PH
                                                    </span>
                                                </div>
                                                <input type="text" id="PH" name="PH" class="form-control" placeholder="" value="{{ $devices[0]['PH'] }}">
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        Heads
                                                    </span>
                                                </div>
                                                <input type="text" id="heads" name="heads" class="form-control" placeholder="" value="{{ $devices[0]['heads'] }}">
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        Platters
                                                    </span>
                                                </div>
                                                <input type="text" id="Platters" name="Platters" class="form-control" placeholder="" value="{{ $devices[0]['platter_head'] }}">
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-t-20">
                                        
                                        
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        PCB No
                                                    </span>
                                                </div>
                                                <input type="text" id="pcb_no" name="pcb_no" class="form-control" placeholder="" value="{{ $devices[0]['pcb_no'] }}">
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        MADE IN
                                                    </span>
                                                </div>
                                                <select class="form-control custom-select" id="madeIn" name="madeIn">
                                                    <option value="Malaysia" {{ ($devices[0]['made_in'] == 'Malaysia') ? 'selected' : ''}}>Malaysia</option>
                                                    <option value="Thailand" {{ ($devices[0]['made_in'] == 'Thailand') ? 'selected' : ''}}>Thailand</option>
                                                    <option value="Philippines" {{ ($devices[0]['made_in'] == 'Philippines') ? 'selected' : ''}}>Philippines</option>
                                                    <option value="Korea" {{ ($devices[0]['made_in'] == 'Korea') ? 'selected' : ''}}>Korea</option>
                                                    <option value="WU" {{ ($devices[0]['made_in'] == 'WU') ? 'selected' : ''}}>WU</option>
                                                    <option value="SU" {{ ($devices[0]['made_in'] == 'SU') ? 'selected' : ''}}>SU</option>
                                                    <option value="TK" {{ ($devices[0]['made_in'] == 'TK') ? "selected" : ''}}>TK</option>
                                                    <option value="Japan" {{ ($devices[0]['made_in'] == 'Japan') ? 'selected' : ''}}>Japan</option>
                                                    <option value="China" {{ ($devices[0]['made_in'] == 'China') ? 'selected' : ''}}>China</option>
                                                    <option value="Finland" {{ ($devices[0]['made_in'] == 'Finland') ? 'selected' : ''}}>Finland</option>
                                                    <option value="Germany" {{ ($devices[0]['made_in'] == 'Germany') ? 'selected' : ''}}>Germany</option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-t-20">
                                        
                                        
                                        
                                        
                                    </div><br>
                                    <h3>Drive Status</h3>
                                    <div class="row p-t-20">
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        PCB
                                                    </span>
                                                </div>
                                                <select class="form-control custom-select" id="pcb" name="pcb">
                                                    <option value="OK" {{ ($devices[0]['PCB'] == 'OK') ? 'selected' : ''}}>OK</option>
                                                    <option value="NOT OK" {{ ($devices[0]['PCB'] == 'NOT OK') ? 'selected' : ''}}>NOT OK</option>
                                                    <option value="DAMAGED" {{ ($devices[0]['PCB'] == 'DAMAGED') ? 'selected' : ''}}>DAMAGED</option>
                                                    <option value="NA" {{ ($devices[0]['PCB'] == 'NA') ? 'selected' : ''}}>NA</option>
                                                </select>
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        Motor
                                                    </span>
                                                </div>
                                                <select class="form-control custom-select" id="motor" name="motor">
                                                    <option value="OK" {{ ($devices[0]['motor'] == 'OK') ? 'selected' : ''}}>OK</option>
                                                    <option value="NOT OK" {{ ($devices[0]['motor'] == 'NOT OK') ? 'selected' : ''}}>NOT OK</option>
                                                    <option value="DAMAGED" {{ ($devices[0]['motor'] == 'DAMAGED') ? 'selected' : ''}}>DAMAGED</option>
                                                    <option value="NA" {{ ($devices[0]['motor'] == 'NA') ? 'selected' : ''}}>NA</option>
                                                </select>
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        Firmware
                                                    </span>
                                                </div>
                                                <select class="form-control custom-select" id="firmware" name="firmware">
                                                    <option value="OK" {{ ($devices[0]['firmware'] == 'OK') ? 'selected' : ''}}>OK</option>
                                                    <option value="NOT OK" {{ ($devices[0]['firmware'] == 'NOT OK') ? 'selected' : ''}}>NOT OK</option>
                                                    <option value="DAMAGED" {{ ($devices[0]['firmware'] == 'DAMAGED') ? 'selected' : ''}}>DAMAGED</option>
                                                    <option value="NA" {{ ($devices[0]['firmware'] == 'NA') ? 'selected' : ''}}>NA</option>
                                                </select>
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        R/W Heads
                                                    </span>
                                                </div>
                                                <select class="form-control custom-select" id="r_w_heads" name="r_w_heads">
                                                    <option value="OK" {{ ($devices[0]['r_w_heads'] == 'OK') ? 'selected' : ''}}>OK</option>
                                                    <option value="NOT OK" {{ ($devices[0]['r_w_heads'] == 'NOT OK') ? 'selected' : ''}}>NOT OK</option>
                                                    <option value="DAMAGED" {{ ($devices[0]['r_w_heads'] == 'DAMAGED') ? 'selected' : ''}}>DAMAGED</option>
                                                    <option value="NA" {{ ($devices[0]['r_w_heads'] == 'NA') ? 'selected' : ''}}>NA</option>
                                                </select>
                                                <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-t-20">
                                        
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success" > <i class="fa fa-update"></i> Update Device </button>
                                </form>
                            </div>
                            <div class="tab-pane p-20" id="diagnosis" role="tabpanel">
                                <div class="col-lg-8">
                                    <form action="{{ route('update_device') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="device_id" value="{{ $devices[0]['id'] }}">
                                    <div >
                                        <h4>Analysis</h4>                                                                                
                                        <textarea type="text" class="form-control" rows="5" id="dev_diagnosis" name="dev_diagnosis" placeholder="">{{ $devices[0]['diagnosis'] }}</textarea>
                                    </div>
                                    <div >
                                        <h4>Consultation</h4>
                                        <textarea type="text" class="form-control" rows="5" id="dev_consultation" name="dev_consultation" placeholder="">{{ $devices[0]['consultation'] }}</textarea>
                                    </div>
                                    <div >
                                        <h4>Recovery Time</h4>
                                        <textarea type="text" class="form-control" rows="5" id="dev_recover" name="dev_recover" placeholder="">{{ $devices[0]['recover'] }}</textarea>
                                    </div><br>
                                    <button type="submit" class="btn btn-success" > <i class="fa fa-update"></i> Update Device </button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="attachments" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="card-title">File Attachments</h4>
                                        <div class="table-responsive">
                                            <table class="table color-bordered-table info-bordered-table">
                                                <thead>
                                                    <tr>
                                                        <th>File Name</th>
                                                        <th>Size</th>
                                                        <th>Date Uploaded</th>
                                                        <th>Uploaded by</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($fileLists as $file)
                                                    <tr>
                                                        <td><a href="{{ route('download_upload_file', ['id' => $file['id']]) }}">{{$file['file_name']}}</a></td>
                                                        <td>{{$file['size']}} KB</td>
                                                        <td>{{$file['created_at']}}</td>
                                                        <td>{{$file['uploaded_by']}}</td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <form action="{{ route('upload_attach') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="attachJobId" value="{{ $job['job_id'] }}">
                                            <h4 class="card-title" style="margin-bottom:15px;">Upload new</h4>
                                            <div class="card" style="margin-left:0px;">
                                                <div >
                                                    <input type="file" id="input-file-now" name="attach" class="dropify" />
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="col-md-2 offset-md-5">
                                                    <div class="card-body" >
                                                        <button class="btn btn-success waves-effect waves-light" type="submit"><span class="btn-label"><i class="fa fa-upload"></i></span>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="quotes" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <br>
                                        <h5 class="card-title">Quotes</h5>
                                        <div class="row p-t-20">
                                            <div class="table-responsive">
                                                <table class="table color-bordered-table info-bordered-table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Type</th>
                                                            <th>Capacity</th>
                                                            <th>Price</th>
                                                            <th>Created by</th>
                                                            <th>Created at</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @if ($quote)
                                                            <td>{{ $quote->id }}</td>
                                                            <td>{{ $quote->item_type }}</td>
                                                            <td>{{ $quote->item_capacity }}</td>
                                                            <td>{{ $quote->item_total_price }}</td>
                                                            <td>{{ $quote->created_by }}</td>
                                                            <td>{{ $quote->created_at }}</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="billing" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- <h3 class="card-title">Billing</h3>
                                        <div class="row p-t-20">
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Service
                                                        </span>
                                                    </div>
                                                    <input type="text" id="bill_service" name="bill_service" class="form-control" placeholder="Spassavanje pddataka" >
                                                    <small class="form-control-feedback"></small> 
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Price
                                                        </span>
                                                    </div>
                                                    <input type="text" id="bill_price" name="bill_price" class="form-control" placeholder="0" >
                                                    <small class="form-control-feedback"></small> 
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Parts
                                                        </span>
                                                    </div>
                                                    <input type="text" id="bill_parts" name="bill_parts" class="form-control" placeholder="0" >
                                                    <small class="form-control-feedback"></small> </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            VAT(%)
                                                        </span>
                                                    </div>
                                                    <input type="text" id="vill_VAT" name="bill_VAT" class="form-control" placeholder="20" >
                                                    <small class="form-control-feedback"></small> </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Discount(%)
                                                        </span>
                                                    </div>
                                                    <input type="text" id="bill_discount" name="bill_discount" class="form-control" placeholder="0" >
                                                    <small class="form-control-feedback"></small> </div>
                                            </div>
                                        </div>
                                        <div class="row p-t-20">
                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Total
                                                        </span>
                                                    </div>
                                                    <input type="text" id="bill_total" name="bill_total" class="form-control" placeholder="0" >
                                                    <small class="form-control-feedback"></small> </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Subtotal
                                                        </span>
                                                    </div>
                                                    <input type="text" id="bill_subtotal" name="bill_subtotal" class="form-control" placeholder="0" >
                                                    <small class="form-control-feedback"></small> </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Total with VAT
                                                        </span>
                                                    </div>
                                                    <input type="text" id="bill_total_with_VAT" name="bill_total_with_VAT" class="form-control" placeholder="0" >
                                                    <small class="form-control-feedback"></small> </div>
                                            </div>
                                        </div> 
                                        <div class="row p-t-20">
                                            <button class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-save"></i></span>Save</button>
                                        </div> -->
                                        <br>
                                        <h5 class="card-title">Invoices</h5>
                                        <div class="row p-t-20">
                                            <div class="table-responsive">
                                                <table class="table color-bordered-table info-bordered-table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Created by</th>
                                                            <th>Created at</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @if ($invoice)
                                                            <td>{{ $invoice->id }}</td>
                                                            <td>{{ $invoice->status }}</td>
                                                            <td>{{ $invoice->item_total_price }}</td>
                                                            <td>{{ $invoice->created_by }}</td>
                                                            <td>{{ $invoice->created_at }}</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                        <!-- <h5 class="card-title">Bills</h5>
                                        <div class="row p-t-20">
                                            <div class="table-responsive">
                                                <table class="table color-bordered-table info-bordered-table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Created by</th>
                                                            <th>Created at</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
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
                                                        <th>Job Info</th>
                                                        <th>Important Data</th>
                                                        <th>Assigned to</th>
                                                        <th>Comment</th>
                                                        <th>Client info</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($histories as $item)
                                                    <tr>
                                                        <td>{{ $item['user_name'] }}</td>
                                                        <td>{{ $item['client_name'] }}</td>
                                                        <td>{{ $item['job_priority'] }}</td>
                                                        <td>{{ $item['job_status'] }}</td>
                                                        <td>{{ $item['job_info'] }}</td>
                                                        <td>{{ $item['important_data'] }}</td>
                                                        <td>{{ $item['assigned_to'] }}</td>
                                                        <td>{{ $item['comment'] }}</td>
                                                        <td>{{ $item['client_info'] }}</td>
                                                        <td>{{ $item['created_at'] }}</td>
                                                    </tr>
                                                    @endforeach
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($logs as $item)
                                                    <tr>
                                                        <td>{{ $item['user_name'] }}</td>
                                                        <td>{{ $item['ip_address'] }}</td>
                                                        <td>{{ $item['module'] }}</td>
                                                        <td>{{ $item['action'] }}</td>
                                                        <td>{{ $item['description'] }}</td>
                                                        <td>{{ $item['created_at'] }}</td>
                                                    </tr>
                                                    @endforeach
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
$(document).ready(function() {

    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
            });

            cb(matches);
        };
    };

    var states = [];
    @foreach ($inventoryIds as $item)
        states.push("{{ sprintf("%04d", $item) }}");
    @endforeach

        // constructs the suggestion engine
        var states = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // `states` is an array of state names defined in "The Basics"
        local: states
        });

        $('#bloodhound .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
        },
        {
        name: 'states',
        source: states
        });


        // -------- Prefatch --------

        var countries = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // url points to a json file that contains an array of country names, see
        // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
        prefetch: '../plugins/bower_components/typeahead.js-master/countries.json'
        });

        // passing in `null` for the `options` arguments will result in the default
        // options being used
        $('#prefetch .typeahead').typeahead(null, {
        name: 'StockIds',
        limit: 10,
        source: states
        });

        // -------- Custom --------

        var nflTeams = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function(obj) { return obj.team; },
        prefetch: '../plugins/bower_components/typeahead.js-master/nfl.json'
        });

        function nflTeamsWithDefaults(q, sync) {
        if (q === '') {
            sync(nflTeams.get('Detroit Lions', 'Green Bay Packers', 'Chicago Bears'));
        }

        else {
            nflTeams.search(q, sync);
        }
        }

        $('#default-suggestions .typeahead').typeahead({
        minLength: 0,
        highlight: true
        },
        {
        name: 'nfl-teams',
        display: 'team',
        source: nflTeamsWithDefaults
        });

        // -------- Multiple --------

        var nbaTeams = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '../plugins/bower_components/typeahead.js-master/nba.json'
        });

        var nhlTeams = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '../plugins/bower_components/typeahead.js-master/nhl.json'
        });

        $('#multiple-datasets .typeahead').typeahead({
        highlight: true
        },
        {
        name: 'nba-teams',
        display: 'team',
        source: nbaTeams,
        templates: {
            header: '<h3 class="league-name">NBA Teams</h3>'
        }
        },
        {
        name: 'nhl-teams',
        display: 'team',
        source: nhlTeams,
        templates: {
            header: '<h3 class="league-name">NHL Teams</h3>'
        }
        });
            
        // -------- Scrollable --------



        $('#scrollable-dropdown-menu .typeahead').typeahead(null, {
        name: 'states',
        limit: 10,
        source: states
    });

    $('#example23').DataTable();
    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, le fichier trop volumineux'
        }
    });

    // Used events
    var drEvent = $('#input-file-events').dropify();

    drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
    });

    drEvent.on('dropify.errors', function(event, element) {
        console.log('Has Errors');
    });

    var drDestroy = $('#input-file-to-destroy').dropify();
    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function(e) {
        e.preventDefault();
        if (drDestroy.isDropified()) {
            drDestroy.destroy();
        } else {
            drDestroy.init();
        }
    });

    // $("#selInventory").on('click', function(e) {
    //     e.preventDefault();
    //     var sel_inventory_id = $("#sel_inventory_id").val();
    //     console.log(sel_inventory_id);

    // });

});
$('#myTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});

function gen_password()
{
    max = 999999999;
    min = 100000000;
    var num = Math.floor(Math.random()*(max-min+1)+min);
    $("#job_password").val(num);
    $("#job_passwordl").html(num);
}
</script>

@endpush