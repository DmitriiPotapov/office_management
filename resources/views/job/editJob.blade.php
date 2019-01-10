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
                            <form method="POST" action="{{ route('add_new_Permission') }}">
                            @csrf
                                <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 control-label"><b>Services:</b></label>
                                                    <label class="col-lg-4 control-label">Data Recovery</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 control-label"><b>File list password:</b></label>
                                                    <label class="col-lg-4 control-label">8456451654 &nbsp;<a href="javascript:void(0)"><i class="fa fa-refresh"></i></a></label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 control-label"><b>Assigned to engineer:</b></label>
                                                    <label class="col-lg-4 control-label">Joe</label>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Price
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="exampleInputuname" placeholder="0">
                                                </div>
                                                <hr>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            Status
                                                        </span>
                                                    </div>
                                                    <select class="form-control custom-select" id="status" name="status">
                                                        <option value="Received">Received</option>
                                                        <option value="In process">In process</option>
                                                        <option value="Waiting for parts">Waiting for parts</option>
                                                        <option value="Paid">Paid</option>
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
                                                        <option value="Priority 1+">Priority 1+</option>
                                                        <option value="Priority 1">Priority 1</option>
                                                        <option value="Priority 2">Priority 2</option>
                                                        <option value="RAID">RAID</option>
                                                    </select>
                                                </div>
                                                <hr>
                                                <div class="form-group row has-success">
                                                    <h4 class="card-title">Job info</h4>
                                                    <textarea class="form-control" rows="3"></textarea>
                                                </div>
                                                <hr>
                                                <div class="form-group row has-info">
                                                    <h4 class="card-title">Important data</h4>
                                                    <textarea class="form-control" rows="3"></textarea>
                                                </div>
                                                <hr>
                                                <div class="form-group row has-danger">
                                                    <h4 class="card-title">Cleint note</h4>
                                                    <textarea class="form-control" rows="3"></textarea>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                </div>
                                                <hr>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon3">
                                                            Comment
                                                        </span>
                                                    </div>
                                                    <textarea type="text" class="form-control" rows="3" id="comment" placeholder=""></textarea>
                                                    <button class="btn btn-success"> <i class="fa fa-comment"></i> Send comment</button>
                                                </div>
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
                                                            <tr>
                                                                <td>Laptop</td>
                                                                <td>HP</td>
                                                                <td>HP LNDF</td>
                                                                <td>SDFE1248</td>
                                                                <td></td>
                                                                <td>Not set</td>
                                                                <td></td>
                                                            </tr>
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
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
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
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr>
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
                                                        <tr>
                                                            <td>Joe</td>
                                                            <td>2019:01:10</td>
                                                            <td>SSSS</td>
                                                            <td>
                                                            <a class="btn btn-circle btn-sm btn-info" href=""><i class="fa fa-pencil"></i></a>
                                                            <a class="btn btn-circle btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row -->
                                </div>
                                
                            </form>
                            </div>
                            <div class="tab-pane p-20" id="jobdevices" role="tabpanel">
                                <div class="row button-group">
                                    <div class="col-lg-12 m-b-30">
                                        <button class="btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-arrows"></i></span>Move selected devices</button>
                                        <button class="btn btn-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-trash"></i></span>Remove selected devices</button>
                                        <button class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Add new client</button>
                                        <button class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Add device</button>
                                        <button class="btn btn-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-upload"></i></span>Release selected</button>
                                    </div>
                                </div>
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td>Laptop</td>
                                                        <td>HP</td>
                                                        <td>HP LNDF</td>
                                                        <td>SDFE1248</td>
                                                        <td></td>
                                                        <td>Not set</td>
                                                        <td></td>
                                                    </tr>
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
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
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
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
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
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
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