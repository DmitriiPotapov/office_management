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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        @if($client_id == 0)
                                        <div id="the-basics">
                                            <input type="text" id="client_info" name="client_info" class="typeahead form-control" placeholder="Cleint info" >
                                        </div>
                                        <a style="margin-left: 30px;" href="{{ route('addClinet') }}"> New Client </a> </div>
                                        <input type="hidden" name="client_id" value="1">
                                        @endif
                                        @if($client_id != 0)
                                        <div>
                                            <input type="text" id="client_info" name="client_info" class="typeahead form-control" value="{{ $client['client_name'].', '.$client['street'].', '.$client['postal_code'].', '.$client['country'] }}" >
                                        </div>
                                        <a style="margin-left: 30px;" href="{{ route('addClinet') }}"> New Client </a> </div>
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
                                                <input type="checkbox" id="hitan8" name="hitan8">
                                            </span>
                                        </div>
                                        <label for="hitan8" id="hita" name="hita" class="form-control">Start 0-24hrs</label>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <input type="checkbox" id="hitan24" name="hitan24">
                                            </span>
                                        </div>
                                        <label for="hitan24" id="hita" name="hita" class="form-control">Start 24-48hrs</label>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title">Devices</h4>
                            <input type="hidden" name="device_count" id="device_count" value="1">
                            <div id="adult">
                            <div class="row p-t-20">
                                <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    Category
                                                </span>
                                            </div>
                                            <select class="form-control custom-select" id="devcategory" name="devcategory">
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
                                            <option value="Other">Other</option>
                                        </select>
                                        <small class="form-control-feedback"></small> 
                                    </div>
                                </div>
                                <div class="col-md-2.5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Manufacturer
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
                            </div>
                            <div class="row p-t-20">
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
                            </div>
                            <br>
                            </div>
                            <br>
                            <h4 class="card-title">Device malfunction information</h4>
                            <div class="row p-t-20">
                                <div class="col-md-12">
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
                            <h4 class="card-title">Important Data</h4>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="important_data" rows="8"></textarea>
                                        <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                                </div>
                            </div> 
                            <h4 class="card-title">Notes</h4>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="notes" rows="8"></textarea>
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
<script src="{{ asset('assets/plugins/typeahead.js-master/dist/typeahead.bundle.min.js')}}"></script>

<script>

    var room = 1;
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
</script>
@endpush