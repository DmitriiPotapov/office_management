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
                    <form method="POST" action="{{ route('add_new_inventory') }}">
                    @csrf
                        <div class="form-body">
                            <h4 class="card-title">Acquired from</h4>
                            <div class="row p-t-20">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Acquired from
                                            </span>
                                        </div>
                                        <input type="text" id="acquired_from" name="acquired_from" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title">Device type</h4>
                            <div class="row p-t-20">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Item role
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="item_role" name="item_role">
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
                                        <select class="form-control custom-select" id="storagetype" name="storagetype">
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
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Manufacturer
                                            </span>
                                        </div>
                                        <input type="text" id="manufacturer" name="manufacturer" class="form-control" placeholder=" " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Model
                                            </span>
                                        </div>
                                        <input type="text" id="model" name="model" class="form-control" placeholder=" " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Serial
                                            </span>
                                        </div>
                                        <input type="text" id="serial" name="serial" class="form-control" placeholder=" " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Part Number
                                            </span>
                                        </div>
                                        <input type="text" id="part_number" name="part_number" class="form-control" placeholder=" " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title">Capacity </h4>
                            <div class="row p-t-20">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                GB
                                            </span>
                                        </div>
                                        <input type="text" id="capacity" name="capacity" class="form-control" placeholder=" " required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                LBA Number
                                            </span>
                                        </div>
                                        <input type="text" id="LBA_number" name="LBA_number" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title">Extra info </h4>
                            <div class="row p-t-20">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Family
                                            </span>
                                        </div>
                                        <input type="text" id="family" name="family" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Firmware
                                            </span>
                                        </div>
                                        <input type="text" id="firmware" name="firmware" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Form factor
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="form_factor" name="form_factor">
                                            <option value="1.8*">1.8*</option>
                                            <option value="2.5*">2.5*</option>
                                            <option value="3.5*">3.5*</option>
                                            <option value="5.25*">5.25*</option>
                                            <option value="1.0*">1.0*</option>
                                            <option value="1.3*">1.3*</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                RPM
                                            </span>
                                        </div>
                                        <input type="text" id="RPM" name="RPM" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                            </div> 
                            <hr>
                            <h4 class="card-title">PCB info </h4>
                            <div class="row p-t-20">
                                <div class="col-md-1.5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                PCB state
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="pcb_state" name="pcb_state">
                                            <option value="1.8*">OK</option>
                                            <option value="2.5*">Bad</option>
                                            <option value="3.5*">Missing</option>
                                            <option value="5.25*">Untested</option>
                                            <option value="1.0*">Unstable</option>
                                        </select>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-1.5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                PCB id
                                            </span>
                                        </div>
                                        <input type="text" id="pcb_id" name="pcb_id" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Controller
                                            </span>
                                        </div>
                                        <input type="text" id="pcb_controller" name="pcb_controller" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Motor driver
                                            </span>
                                        </div>
                                        <input type="text" id="motor_driver" name="motor_driver" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Connection
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="connection" name="connection">
                                            <option value="SATA">SATA</option>
                                            <option value="PATA">PATA</option>
                                            <option value="USB2.0">USB2.0</option>
                                            <option value="SAS">SAS</option>
                                            <option value="M.2">M.2</option>
                                            <option value="mSATA">mSATA</option>
                                            <option value="USB3.0">USB3.0</option>
                                        </select>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                            </div> 
                            <hr>
                            <h4 class="card-title">Location</h4>
                            <div class="row p-t-20">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" id="location" name="location" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                                </div>
                            </div> 
                            <h4 class="card-title">Heads</h4>
                            <div class="row p-t-20">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Heads Number
                                            </span>
                                        </div>
                                        <input type="text" id="heads_number" name="heads_number" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Heads info
                                            </span>
                                        </div>
                                        <input type="text" id="heads_info" name="heads_info" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title">Note</h4>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="note" rows="8"></textarea>
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