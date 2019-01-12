@extends('layouts.layout')

@push('header-style')

<link href="{{ asset('assets/plugins/icheck/skins/all.css')}}" rel="stylesheet">

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
                                        <input type="text" id="client_info" name="client_info" class="form-control" placeholder="Cleint info" >
                                        <a style="margin-left: 30px;" href="{{ route('addClinet') }}"> New Client </a> </div>
                                        <input type="hidden" name="client_id" value="1">
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
                                        <label for="hitan8" id="hita" name="hita" class="form-control">Hitan start 8-18h</label>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <input type="checkbox" id="hitan24" name="hitan24">
                                            </span>
                                        </div>
                                        <label for="hitan24" id="hita" name="hita" class="form-control">Hitan start 00-24h</label>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <input type="checkbox" id="raid" name="raid">
                                            </span>
                                        </div>
                                        <label for="raid" id="raids" name="raids" class="form-control">RAID</label>
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                            </div>
                            <hr>
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
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Type
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="devtype" name="device_type">
                                            @foreach($types as $item)
                                            <option value="{{ $item['device_name']}}"> {{ $item['device_name']}}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-control-feedback"></small> 
                                    </div>
                                </div>
                                <div class="col-md-1.5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Role
                                            </span>
                                        </div>
                                        <select class="form-control custom-select" id="role" name="role">
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
                                        <input type="text" id="manufacturer" name="manufacturer" class="form-control" placeholder="" >
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Model
                                            </span>
                                        </div>
                                        <input type="text" id="model" name="model" class="form-control" placeholder="" >
                                        <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                Serial
                                            </span>
                                        </div>
                                        <input type="text" id="serial" name="serial" class="form-control" placeholder="" >
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
                            <h4 class="card-title">Device malfunction information</h4>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="device_malfunc_info" rows="8"></textarea>
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

<script>
var room = 1;

function education_fields() {

    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = '<div class="row"><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="School name"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Major" name="Major[]" value="" placeholder="Major"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Degree" name="Degree[]" value="" placeholder="Degree"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"> <select class="form-control" id="educationDate" name="educationDate[]"><option value="">Date</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option> </select><div class="input-group-append"> <button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');"> <i class="fa fa-minus"></i> </button></div></div></div></div><div class="clear"></div></row>';

    objTo.appendChild(divtest)
}

function remove_education_fields(rid) {
    $('.removeclass' + rid).remove();
}
</script>
@endpush