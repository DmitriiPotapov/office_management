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
                    <form method="POST" action="{{ route('updateInventory') }}">
                    @csrf
                        <input type="hidden" name="inventory_id" id="inventory_id" value="{{ $dataInventory->id }}" />
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
                                    <input type="text" id="acquired_from" name="acquired_from" class="form-control" placeholder="" required value="{{ $dataInventory->acquire_from }}">
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
                                            <option <?php echo $dataInventory->role == 'Clone' ? 'selected' : '';?> value="Clone">Clone</option>
                                            <option <?php echo $dataInventory->role == 'Patient' ? 'selected' : '';?> value="Patient">Patient</option>
                                            <option <?php echo $dataInventory->role == 'Backup' ? 'selected' : '';?> value="Backup">Backup</option>
                                            <option <?php echo $dataInventory->role == 'Paid' ? 'selected' : '';?> value="Paid">Paid</option>
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
                                            <option <?php echo $dataInventory->category == 'Laptop Drive' ? 'selected' : '';?> value="Laptop Drive">Laptop Drive</option>
                                            <option <?php echo $dataInventory->category == 'Desktop Drive' ? 'selected' : '';?> value="Desktop Drive">Desktop Drive</option>
                                            <option <?php echo $dataInventory->category == 'External Drive' ? 'selected' : '';?> value="External Drive">External Drive</option>
                                            <option <?php echo $dataInventory->category == 'Server Drive' ? 'selected' : '';?> value="Server Drive">Server Drive</option>
                                            <option <?php echo $dataInventory->category == 'Mobile Phone' ? 'selected' : '';?> value="Mobile Phone">Mobile Phone</option>
                                            <option <?php echo $dataInventory->category == 'Flash Drive' ? 'selected' : '';?> value="Flash Drive">Flash Drive</option>
                                            <option <?php echo $dataInventory->category == 'Smart Devices' ? 'selected' : '';?> value="Smart Devices">Smart Devices</option>
                                            <option <?php echo $dataInventory->category == 'Others' ? 'selected' : '';?> value="Others">Others</option>
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
                                            <option <?php echo $dataInventory->device_type == '2.5’ HDD' ? 'selected' : '';?> value="2.5’ HDD">2.5’ HDD</option>
                                            <option <?php echo $dataInventory->device_type == '3.5’ HDD' ? 'selected' : '';?> value="3.5’ HDD">3.5’ HDD</option>
                                            <option <?php echo $dataInventory->device_type == 'Server HDD' ? 'selected' : '';?> value="Server HDD">Server HDD</option>
                                            <option <?php echo $dataInventory->device_type == 'SSD' ? 'selected' : '';?> value="SSD">SSD</option>
                                            <option <?php echo $dataInventory->device_type == 'Micro SD' ? 'selected' : '';?> value="Micro SD">Micro SD</option>
                                            <option <?php echo $dataInventory->device_type == 'SD' ? 'selected' : '';?> value="SD">SD</option>
                                            <option <?php echo $dataInventory->device_type == 'SDXC' ? 'selected' : '';?> value="SDXC">SDXC</option>
                                            <option <?php echo $dataInventory->device_type == 'SDHC' ? 'selected' : '';?> value="SDHC">SDHC</option>
                                            <option <?php echo $dataInventory->device_type == 'PENDRIVE' ? 'selected' : '';?> value="PENDRIVE">PENDRIVE</option>
                                            <option <?php echo $dataInventory->device_type == 'Others' ? 'selected' : '';?> value="Others">Others</option>
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
                                            <option <?php echo $dataInventory->manufacturer == 'Western Digital' ? 'selected' : '';?> value="Western Digital">Western Digital </option>
                                            <option <?php echo $dataInventory->manufacturer == 'Seagate' ? 'selected' : '';?> value="Seagate">Seagate</option>
                                            <option <?php echo $dataInventory->manufacturer == 'Samsung' ? 'selected' : '';?> value="Samsung">Samsung</option>
                                            <option <?php echo $dataInventory->manufacturer == 'Toshiba' ? 'selected' : '';?> value="Toshiba">Toshiba</option>
                                            <option <?php echo $dataInventory->manufacturer == 'Apple' ? 'selected' : '';?> value="Apple">Apple</option>
                                            <option <?php echo $dataInventory->manufacturer == 'HGST' ? 'selected' : '';?> value="HGST">HGST</option>
                                            <option <?php echo $dataInventory->manufacturer == 'Fujistu' ? 'selected' : '';?> value="Fujistu">Fujistu</option>
                                            <option <?php echo $dataInventory->manufacturer == 'Dell' ? 'selected' : '';?> value="Dell">Dell</option>
                                            <option <?php echo $dataInventory->manufacturer == 'HP' ? 'selected' : '';?> value="HP">HP</option>
                                            <option <?php echo $dataInventory->manufacturer == 'IBM' ? 'selected' : '';?> value="IBM">IBM</option>
                                            <option <?php echo $dataInventory->manufacturer == 'Maxtor' ? 'selected' : '';?> value="Maxtor">Maxtor</option>
                                            <option <?php echo $dataInventory->manufacturer == 'Others' ? 'selected' : '';?> value="Others">Others</option>
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
                                        <input type="text" id="model" name="model" class="form-control" placeholder=" " value="{{ $dataInventory->model }}" required >
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
                                    <input type="text" id="serial" name="serial" class="form-control" placeholder=" " value="{{ $dataInventory->serial_number }}" required>
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
                                            <option <?php echo $dataInventory->interface == 'USB' ? 'selected' : '';?> value="USB">USB</option>
                                            <option <?php echo $dataInventory->interface == 'SATA' ? 'selected' : '';?> value="SATA">SATA</option>
                                            <option <?php echo $dataInventory->interface == 'mSATA' ? 'selected' : '';?> value="mSATA">mSATA</option>
                                            <option <?php echo $dataInventory->interface == 'PCi' ? 'selected' : '';?> value="PCi">PCi</option>
                                            <option <?php echo $dataInventory->interface == 'SAS' ? 'selected' : '';?> value="SAS">SAS</option>
                                            <option <?php echo $dataInventory->interface == 'Others' ? 'selected' : '';?> value="Others">Others</option>
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
                                    <input type="text" id="part_number" name="part_number" class="form-control" placeholder=" " value="{{ $dataInventory->part_number }}" required>
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
                                        <select class="form-control custom-select" id="capacity" name="capacity">
                                            <option <?php echo $dataInventory->capacity == '4 GB' ? 'selected' : '';?> value="4 GB">4 GB</option>
                                            <option <?php echo $dataInventory->capacity == '8 GB' ? 'selected' : '';?> value="8 GB">8 GB</option>
                                            <option <?php echo $dataInventory->capacity == '16 GB' ? 'selected' : '';?> value="16 GB">16 GB</option>
                                            <option <?php echo $dataInventory->capacity == '20 GB' ? 'selected' : '';?> value="20 GB">20 GB</option>
                                            <option <?php echo $dataInventory->capacity == '32 GB' ? 'selected' : '';?> value="32 GB">32 GB</option>
                                            <option <?php echo $dataInventory->capacity == '64 GB' ? 'selected' : '';?> value="64 GB">64 GB</option>
                                            <option <?php echo $dataInventory->capacity == '80 GB' ? 'selected' : '';?> value="80 GB">80 GB</option>
                                            <option <?php echo $dataInventory->capacity == '128 GB' ? 'selected' : '';?> value="128 GB">128 GB</option>
                                            <option <?php echo $dataInventory->capacity == '160 GB' ? 'selected' : '';?> value="160 GB">160 GB</option>
                                            <option <?php echo $dataInventory->capacity == '240 GB' ? 'selected' : '';?> value="240 GB">240 GB</option>
                                            <option <?php echo $dataInventory->capacity == '250 GB' ? 'selected' : '';?> value="250 GB">250 GB</option>
                                            <option <?php echo $dataInventory->capacity == '256 GB' ? 'selected' : '';?> value="256 GB">256 GB</option>
                                            <option <?php echo $dataInventory->capacity == '320 GB' ? 'selected' : '';?> value="320 GB">320 GB</option>
                                            <option <?php echo $dataInventory->capacity == '500 GB' ? 'selected' : '';?> value="500 GB">500 GB</option>
                                            <option <?php echo $dataInventory->capacity == '512 GB' ? 'selected' : '';?> value="512 GB">512 GB</option>
                                            <option <?php echo $dataInventory->capacity == '640 GB' ? 'selected' : '';?> value="640 GB">640 GB</option>
                                            <option <?php echo $dataInventory->capacity == '750 GB' ? 'selected' : '';?> value="750 GB">750 GB</option>
                                            <option <?php echo $dataInventory->capacity == '1 TB' ? 'selected' : '';?> value="1 TB">1 TB</option>
                                            <option <?php echo $dataInventory->capacity == '1.5 TB' ? 'selected' : '';?> value="1.5 TB">1.5 TB</option>
                                            <option <?php echo $dataInventory->capacity == '2 TB' ? 'selected' : '';?> value="2 TB">2 TB</option>
                                            <option <?php echo $dataInventory->capacity == '3 TB' ? 'selected' : '';?> value="3 TB">3 TB</option>
                                            <option <?php echo $dataInventory->capacity == '4 TB' ? 'selected' : '';?> value="4 TB">4 TB</option>
                                            <option <?php echo $dataInventory->capacity == '6 TB' ? 'selected' : '';?> value="6 TB">6 TB</option>
                                            <option <?php echo $dataInventory->capacity == '8 TB' ? 'selected' : '';?> value="8 TB">8 TB</option>
                                            <option <?php echo $dataInventory->capacity == '10 TB' ? 'selected' : '';?> value="10 TB">10 TB</option>
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
                                    <input type="text" id="family" name="family" class="form-control" placeholder="" value="{{ $dataInventory->family }}" required>
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
                                    <input type="text" id="firmware" name="firmware" class="form-control" placeholder="" value="{{ $dataInventory->firmware }}" required>
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
                                            <option <?php echo $dataInventory->Form_factor == '1.8*' ? 'selected' : '';?> value="1.8*">1.8*</option>
                                            <option <?php echo $dataInventory->Form_factor == '2.5*' ? 'selected' : '';?> value="2.5*">2.5*</option>
                                            <option <?php echo $dataInventory->Form_factor == '3.5*' ? 'selected' : '';?> value="3.5*">3.5*</option>
                                            <option <?php echo $dataInventory->Form_factor == '5.25*' ? 'selected' : '';?> value="5.25*">5.25*</option>
                                            <option <?php echo $dataInventory->Form_factor == '1.0*' ? 'selected' : '';?> value="1.0*">1.0*</option>
                                            <option <?php echo $dataInventory->Form_factor == '1.3*' ? 'selected' : '';?> value="1.3*">1.3*</option>
                                            <option <?php echo $dataInventory->Form_factor == 'Other' ? 'selected' : '';?> value="Other">Other</option>
                                        </select>
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
                                            <option <?php echo $dataInventory->PCB_state == 'OK' ? 'selected' : '';?> value="OK">OK</option>
                                            <option <?php echo $dataInventory->PCB_state == 'Bad' ? 'selected' : '';?> value="Bad">Bad</option>
                                            <option <?php echo $dataInventory->PCB_state == 'Missing' ? 'selected' : '';?> value="Missing">Missing</option>
                                            <option <?php echo $dataInventory->PCB_state == 'Untested' ? 'selected' : '';?> value="Untested">Untested</option>
                                            <option <?php echo $dataInventory->PCB_state == 'Unstable' ? 'selected' : '';?> value="Unstable">Unstable</option>
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
                                    <input type="text" id="pcb_id" name="pcb_id" class="form-control" placeholder="" value="{{ $dataInventory->PCB_id }}" required>
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
                                            <option <?php echo $dataInventory->PCB_connection == 'SATA' ? 'selected' : '';?> value="SATA">SATA</option>
                                            <option <?php echo $dataInventory->PCB_connection == 'PATA' ? 'selected' : '';?> value="PATA">PATA</option>
                                            <option <?php echo $dataInventory->PCB_connection == 'USB2.0' ? 'selected' : '';?> value="USB2.0">USB2.0</option>
                                            <option <?php echo $dataInventory->PCB_connection == 'SAS' ? 'selected' : '';?> value="SAS">SAS</option>
                                            <option <?php echo $dataInventory->PCB_connection == 'M.2' ? 'selected' : '';?> value="M.2">M.2</option>
                                            <option <?php echo $dataInventory->PCB_connection == 'mSATA' ? 'selected' : '';?> value="mSATA">mSATA</option>
                                            <option <?php echo $dataInventory->PCB_connection == 'USB3.0' ? 'selected' : '';?> value="USB3.0">USB3.0</option>
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
                                    <input type="text" id="location" name="location" class="form-control" placeholder="" value="{{ $dataInventory->location }}" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                                </div>
                            </div> 
                            <h4 class="card-title">Heads/Platter info</h4>
                            <div class="row p-t-20">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Heads Number
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="heads_number" name="heads_number">
                                            @for ($i = 1; $i <= 6; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Platter Number
                                            </span>
                                        </div>
                                        
                                        <select class="form-control custom-select" id="heads_info" name="heads_info">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
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
                                            <option <?php echo $dataInventory->madeIn == 'Malaysia' ? 'selected' : '';?> value="Malaysia">Malaysia</option>
                                            <option <?php echo $dataInventory->madeIn == 'Thailand' ? 'selected' : '';?> value="Thailand">Thailand</option>
                                            <option <?php echo $dataInventory->madeIn == 'Philippines' ? 'selected' : '';?> value="Philippines">Philippines</option>
                                            <option <?php echo $dataInventory->madeIn == 'Korea' ? 'selected' : '';?> value="Korea">Korea</option>
                                            <option <?php echo $dataInventory->madeIn == 'WU' ? 'selected' : '';?> value="WU">WU</option>
                                            <option <?php echo $dataInventory->madeIn == 'SU' ? 'selected' : '';?> value="SU">SU</option>
                                            <option <?php echo $dataInventory->madeIn == 'TK' ? 'selected' : '';?> value="TK">TK</option>
                                            <option <?php echo $dataInventory->madeIn == 'Japan' ? 'selected' : '';?> value="Japan">Japan</option>
                                            <option <?php echo $dataInventory->madeIn == 'China' ? 'selected' : '';?> value="China">China</option>
                                            <option <?php echo $dataInventory->madeIn == 'Finland' ? 'selected' : '';?> value="Finland">Finland</option>
                                            <option <?php echo $dataInventory->madeIn == 'Germany' ? 'selected' : '';?> value="Germany">Germany</option>
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
                                    <input type="text" id="PH" name="PH" class="form-control" placeholder="" value="{{ $dataInventory->PH }}" required>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title">Note</h4>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <textarea class="form-control" name="note" rows="8">{{ $dataInventory->note }}</textarea>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                                </div>
                            </div> 
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Update</button>
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