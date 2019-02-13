@extends('layouts.layout')

@push('header-style')

<link href="{{ asset('assets/plugins/icheck/skins/all.css')}}" rel="stylesheet">

@endpush

@section('content')

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">New Item</h3>
        </div>
    </div>
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
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Item role
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="item_role" name="item_role">
                                            <option value="Clone">Clone</option>
                                            <option value="Patient">Patient</option>
                                            <option value="Backup">Backup</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Category
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="category" name="category">
                                            <option value="Laptop Drive">Laptop Drive</option>
                                            <option value="Desktop Drive">Desktop Drive</option>
                                            <option value="External Drive">External Drive</option>
                                            <option value="Server Drive">Server Drive</option>
                                            <option value="Mobile Phone">Mobile Phone</option>
                                            <option value="Flash Drive">Flash Drive</option>
                                            <option value="Smart Devices">Smart Devices</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Storage Type
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="storagetype" name="storagetype">
                                            <option value="2.5’ HDD">2.5’ HDD</option>
                                            <option value="3.5’ HDD">3.5’ HDD</option>
                                            <option value="Server HDD">Server HDD</option>
                                            <option value="SSD">SSD</option>
                                            <option value="Micro SD">Micro SD</option>
                                            <option value="SD">SD</option>
                                            <option value="SDXC">SDXC</option>
                                            <option value="SDHC">SDHC</option>
                                            <option value="PENDRIVE">PENDRIVE</option>
                                            <option value="Others">Others</option>
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
                                                Brand
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="manufacturer" name="manufacturer">
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
                                </div>
                                <div class="col-md-2">
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
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Interface
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="interface" name="interface">
                                            <option value="USB">USB </option>
                                            <option value="SATA">SATA</option>
                                            <option value="mSATA">mSATA</option>
                                            <option value="PCi">PCi</option>
                                            <option value="SAS">SAS</option>
                                            <option value="Others">Others</option>
                                        </select>
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
                                                Capacity
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="capacity" name="capacity">
                                            <option value="4 GB">4 GB</option>
                                            <option value="8 GB">8 GB</option>
                                            <option value="16 GB">16 GB</option>
                                            <option value="20 GB">20 GB</option>
                                            <option value="32 GB">32 GB</option>
                                            <option value="64 GB">64 GB</option>
                                            <option value="80 GB">80 GB</option>
                                            <option value="128 GB">128 GB</option>
                                            <option value="160 GB">160 GB</option>
                                            <option value="240 GB">240 GB</option>
                                            <option value="250 GB">250 GB</option>
                                            <option value="256 GB">256 GB</option>
                                            <option value="320 GB">320 GB</option>
                                            <option value="500 GB">500 GB</option>
                                            <option value="512 GB">512 GB</option>
                                            <option value="640 GB">640 GB</option>
                                            <option value="750 GB">750 GB</option>
                                            <option value="1 TB">1 TB</option>
                                            <option value="1.5 TB">1.5 TB</option>
                                            <option value="2 TB">2 TB</option>
                                            <option value="3 TB">3 TB</option>
                                            <option value="4 TB">4 TB</option>
                                            <option value="6 TB">6 TB</option>
                                            <option value="8 TB">8 TB</option>
                                            <option value="10 TB">10 TB</option>
                                        </select>
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
                            </div> 
                            <hr>
                            <h4 class="card-title">PCB info </h4>
                            <div class="row p-t-20">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                PCB state
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="pcb_state" name="pcb_state">
                                            <option value="OK">OK</option>
                                            <option value="Bad">Bad</option>
                                            <option value="Missing">Missing</option>
                                            <option value="Untested">Untested</option>
                                            <option value="Unstable">Unstable</option>
                                        </select>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"></a></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                PCB ID
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
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Location
                                            </span>
                                        </div>
                                        <input type="text" id="location" name="location" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                                </div>
                            </div> <br>
                            <h4 class="card-title">Heads/Platter info</h4>
                            <div class="row p-t-20">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                    Heads Number
                                            </span>
                                        </div>
                                        <input type="text" id="heads_number" name="heads_number" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                    Platter Number
                                            </span>
                                        </div>
                                        <input type="text" id="heads_number" name="heads_info" class="heads_info-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Made In
                                            </span>
                                        </div>
                                        
                                        <select class="form-control custom-select" id="madeIn" name="madeIn">
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Korea">Korea</option>
                                            <option value="WU">WU</option>
                                            <option value="SU">SU</option>
                                            <option value="TK">TK</option>
                                            <option value="Japan">Japan</option>
                                            <option value="China">China</option>
                                            <option value="Finland">Finland</option>
                                            <option value="Germany">Germany</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                PH
                                            </span>
                                        </div>
                                        <input type="text" id="PH" name="PH" class="form-control" placeholder="" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> 
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