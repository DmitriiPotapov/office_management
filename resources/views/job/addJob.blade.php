@extends('layouts.layout')

@push('header-style')

<link href="{{ asset('assets/plugins/icheck/skins/all.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/typeahead.js-master/dist/typehead-min.css')}}" rel="stylesheet">

@endpush

@section('content')

<div class="container-fluid">
<!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h4 class="text-themecolor m-b-0 m-t-0">Add new job</h4>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-body">
                    <form method="POST" action="{{ route('add_new_job') }}">
                    @csrf
                        <div class="form-body">
                            <h4 class="card-title">Client info</h4>
                            <div class="row p-t-20">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        @if($client_id == 0)
                                        <div id="the-basics">
                                            <input type="text" id="client_info" name="client_info" class="typeahead form-control" placeholder="Cleint info" >
                                        </div><br>
                                        <a class="btn-sm btn-success waves-effect waves-light" href="{{ route('addClinet') }}"><span class="btn-label"><i class="fa fa-plus"></i></span>New Client</a> </div>
                                        <input type="hidden" name="client_id" value="1">
                                        @endif
                                        @if($client_id != 0)
                                        <div>
                                            <input type="text" id="client_info" name="client_info" class="typeahead form-control" value="{{ $client['client_name'].', '.$client['street'].', '.$client['postal_code'].', '.$client['country'] }}" >
                                        </div><br>
                                        <a class="btn-sm btn-success waves-effect waves-light" href="{{ route('addClinet') }}"><span class="btn-label"><i class="fa fa-plus"></i></span>New Client</a> </div>
                                        <input type="hidden" name="client_id" value="{{ $client_id }}">
                                        @endif
                                </div>
                            </div>
                            <h4 class="card-title">Priority</h4>
                            <div class="row p-t-20">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Priority
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="priority" name="priority">
                                            @foreach($priorities as $item)
                                            <option value="{{ $item['job_priority_name']}}"> {{ $item['job_priority_name']}}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-control-feedback"></small> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Services
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="service_name" name="service_name">
                                            @foreach($services as $item)
                                            <option value="{{ $item['service_name']}}"> {{ $item['service_name']}}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-control-feedback"></small> 
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h4 class="card-title">Device Info</h4>
                            <input type="hidden" name="device_count" id="device_count" value="1">
                            <div id="adult">
                                <div class="row p-t-20">
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    Category
                                                </span>
                                            </div>
                                            <select class="form-control custom-select" id="devcategory" name="devcategory">
                                                <option value="Laptop">Laptop</option>
                                                <option value="Desktop">Desktop</option>
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
                                    </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Type
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="devtype" name="device_type1">
                                            @foreach($types as $item)
                                            <option value="{{ $item->device_name}}"> {{ $item->device_name}}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-control-feedback"></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Role
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="role" name="role1">
                                            <option value="Patient">Patient</option>
                                            <option value="Clone">Clone</option>
                                            <option value="Donor">Donor</option>
                                            <option value="Donor">Data</option>
                                            <option value="Donor">Backup</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <small class="form-control-feedback"></small> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Brand
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="manufacturer1" name="manufacturer">
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
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    Model
                                                </span>
                                            </div>
                                            <input type="text" id="model" name="model1" class="form-control" placeholder="" >
                                            <small class="form-control-feedback"></small> </div>
                                    </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Serial
                                            </span>
                                        </div>
                                        <input type="text" id="serial" name="serial1" class="form-control" placeholder="" >
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Capacity
                                            </span>
                                        </div>
                                        <input type="text" id="capacity" name="capacity1" class="form-control" placeholder="" >
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Location
                                            </span>
                                        </div>
                                        <input type="text" id="location" name="location" class="form-control" placeholder="" >
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                            </div>
                            <br>
                            <div class="row p-t-20">
                                    <button class="btn btn-success waves-effect waves-light" style="margin-left:17px" type="button" data-toggle="modal" data-target="#addNewBackupModal"><span class="btn-label"><i class="fa fa-plus"></i></span>Add New Backup Device</button>
                                    <button class="btn btn-danger waves-effect waves-light" onclick="removeBackup()" style="margin-left:17px" type="button" ><span class="btn-label"><i class="fa fa-plus"></i></span>Delete Backup Device</button>
                            </div>
                            <br>
                            <div style="display:none;" id="backupDevice">
                                <h4 class="card-title" style="margin-left:2px;">Backup Devices</h4>
                                <input type="hidden" id="isBackup" name="isBackup" value="0">
                                <div class="row p-t-20 " >
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    Category
                                                </span>
                                            </div>
                                            <input type="text" id="backupCategory" name="backupCategory" class="form-control" placeholder="" >
                                            <small class="form-control-feedback"></small> </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    Type
                                                </span>
                                            </div>
                                            <input type="text" id="backupType" name="backupType" class="form-control" placeholder="" >
                                            <small class="form-control-feedback"></small> </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    Role
                                                </span>
                                            </div>
                                            <input type="text" id="backupRole" name="backupRole" class="form-control" placeholder="" >
                                            <small class="form-control-feedback"></small> </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    Brand
                                                </span>
                                            </div>
                                            <input type="text" id="backupManufacturer" name="backupManufacturer" class="form-control" placeholder="" >
                                            <small class="form-control-feedback"></small> </div>
                                    </div>
                                    
                                </div>
                                <div class="row p-t-20">
                                    <div class="col-md-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        Model
                                                    </span>
                                                </div>
                                                <input type="text" id="backupModel" name="backupModel" class="form-control" placeholder="" >
                                                <small class="form-control-feedback"></small> </div>
                                        </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    Serial
                                                </span>
                                            </div>
                                            <input type="text" id="backupSerial" name="backupSerial" class="form-control" placeholder="" >
                                            <small class="form-control-feedback"></small> </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    Capacity
                                                </span>
                                            </div>
                                            <input type="text" id="backupCapacity" name="backupCapacity" class="form-control" placeholder="" >
                                            <small class="form-control-feedback"></small> </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    Location
                                                </span>
                                            </div>
                                            <input type="text" id="backupLocation" name="backupLocation" class="form-control" placeholder="" >
                                            <small class="form-control-feedback"></small> </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h4 class="card-title" style="margin-left:5px;">Device malfunction information</h4>
                            <div class="row p-t-20">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select class="form-control custom-select" id="device_malfunc_info" name="device_malfunc_info">
                                            <option value="">Choose...</option>
                                            <option value="Western Digital">Fell down</option>
                                            <option value="Not working">Not working</option>
                                            <option value="Clicking Sound">Clicking Sound</option>
                                            <option value="Abnormal Noise">Abnormal Noise</option>
                                            <option value="Water Damage">Water Damage</option>
                                            <option value="Fire Damage">Fire Damage</option>
                                            <option value="Deleted">Deleted</option>
                                            <option value="Formatted">Formatted</option>
                                            <option value="Rebuild">Rebuild</option>
                                            <option value="PCB Burn">PCB Burn</option>
                                            <option value="Overwritten">Overwritten</option>
                                            <option value="Virus issue">Virus issue</option>
                                            <option value="Ransomware attack">Ransomware attack</option>
                                            <option value="Password Forget">Password Forget</option>
                                            <option value="Encryption">Encryption</option>
                                            <option value="File corruption / damage">File corruption / damage</option>
                                            <option value="File missing">File missing</option>
                                            <option value="Complete dead">Complete dead</option>
                                            <option value="Display Broken">Display Broken</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                                </div>
                            </div> 
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <h4 class="card-title" style="margin-left:5px;">Important Data</h4>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="card-title" style="margin-left:5px;">Notes</h4>
                                </div>
                            </div>
                            <div class="row p-t-20" >
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea class="form-control" name="important_data" rows="5"></textarea>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea class="form-control" name="notes" rows="5"></textarea>
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
    <div class="modal fade" id="addNewBackupModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Backup device</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
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
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                Category
                            </span>
                        </div>
                        <select class="form-control custom-select" id="cr_category" name="cr_category">
                            <option value="Laptop">Laptop</option>
                            <option value="Desktop">Desktop</option>
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
                    <br>
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
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                Brand
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
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                Model
                            </span>
                        </div>
                        <input type="text" class="form-control" id="cr_model" name="cr_model">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                Capacity
                            </span>
                        </div>
                        <input type="text" class="form-control" id="cr_capacity" name="cr_capacity">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                Serial
                            </span>
                        </div>
                        <input type="text" class="form-control" id="cr_serial" name="cr_serial">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                Location
                            </span>
                        </div>
                        <input type="text" class="form-control" id="cr_location" name="cr_location">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                Note
                            </span>
                        </div>
                        <input type="text" class="form-control" id="cr_note" name="cr_note">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button onclick="onAddBakcup()" class="btn btn-primary" data-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('footer-script')
<script src="{{ asset('assets/plugins/icheck/icheck.min.js')}}"></script>
<script src="{{ asset('assets/plugins/icheck/icheck.init.js')}}"></script>
<script src="{{ asset('assets/plugins/typeahead.js-master/dist/typeahead.bundle.min.js')}}"></script>

<script>

    var room = 1;
    function onAddBakcup()
    {
        var obj = document.getElementById("backupDevice");
        obj.setAttribute("style", "display:show;");
        $("#isBackup").val("add");
        $("#backupCategory").val($("#cr_category").val());
        $("#backupType").val($("#cr_device_name").val());
        $("#backupRole").val($("#cr_role").val());
        $("#backupManufacturer").val($("#cr_manufacturer").val());
        $("#backupModel").val($("#cr_model").val());
        $("#backupSerial").val($("#cr_serial").val());
        $("#backupCapacity").val($("#cr_capacity").val());
        $("#backupLocation").val($("#cr_location").val());
    }
    function onDeviceAdd()
    {
        room++;
        $("#device_count").val(room);
        var objTo = document.getElementById('adult')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass" + room);
        var rdiv = 'removeclass' + room;
        divtest.innerHTML = '<div class="row "><div class="col-md-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Type</span></div><select class="form-control custom-select" id="devtype" name="device_type'+room+'">@foreach($types as $item)<option value="{{ $item->device_name}}"> {{ $item->device_name}}</option>@endforeach</select><small class="form-control-feedback"></small> </div></div><div class="col-md-1.5">       <div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Role</span></div><select class="form-control custom-select" id="role" name="role'+room+'"><option value="Patient">Patient</option><option value="Clone">Clone</option><option value="Donor">Donor</option><option value="Other">Other</option></select><small class="form-control-feedback"></small> </div></div><div class="col-md-2.5"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Manufacturer</span></div><select class="form-control custom-select" id="manufacturer" name="manufacturer'+room+'"><option value="Western Digital">Western Digital </option><option value="Seagate">Seagate</option><option value="Samsung">Samsung</option><option value="Toshiba">Toshiba</option><option value="Apple">Apple</option><option value="HGST">HGST</option><option value="Fujistu">Fujistu</option><option value="Dell">Dell</option><option value="HP">HP</option><option value="IBM">IBM</option><option value="Maxtor">Maxtor</option><option value="Others">Others</option></select><small class="form-control-feedback"></small> </div></div><div class="col-md-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Model</span></div><input type="text" id="model" name="model'+room+'" class="form-control" placeholder="" ><small class="form-control-feedback"></small> </div></div><div class="col-md-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Serial</span></div><input type="text" id="serial" name="serial'+room+'" class="form-control" placeholder="" ><small class="form-control-feedback"></small> </div></div><div class="col-md-2"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Location</span></div><input type="text" id="location" name="location'+room+'" class="form-control" placeholder="" ><small class="form-control-feedback"></small> </div></div></div>';

        objTo.appendChild(divtest)
    }

    function remove_device() {
        $('.removeclass' + room).remove();
        room --;
        $('#device_count').val(room);
    }
    
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
  @foreach ($clients as $item)
    states.push("{{ $item['client_name'].', '.$item['street'].', '.$item['postal_code'].', '.$item['country'] }}");
  @endforeach
  
  $('#the-basics .typeahead').typeahead({
    hint: true,
    highlight: true,
    minLength: 1
  },
  {
    name: 'states',
    source: substringMatcher(states)
  });

  function removeBackup()
  {
    var obj = document.getElementById("backupDevice");
    obj.setAttribute("style", "display:none;");
    $("#isBackup").val("0");
  }
</script>
@endpush