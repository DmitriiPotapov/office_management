@extends('layouts.layout')

@push('header-style')

@endpush

@section('content')
<div class="container-fluid">
<!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Jobs</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">View jobs</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Quick jump</h4>
                    <div class="row p-t-20">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" id="jobNumber" placeholder="Job Number">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <a href="javascript:void(0)"><i class="ti-hand-point-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row button-group">
                        <div class="col-lg-12 col-xlg-8 m-b-30">
                            <button class="btn btn-outline-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-envelope-o"></i></span>Generate Invoice</button>
                            <button class="btn btn-outline-secondary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-check"></i></span>Check-out form</button>
                            <button class="btn btn-outline-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-heart"></i></span>Change priority</button>
                            <button class="btn btn-outline-warning waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-envelope-o"></i></span>Change Status</button>
                            <button class="btn btn-outline-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-times"></i></span>Delete</button>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Priority</th>
                                    <th>Client</th>
                                    <th>Status</th>
                                    <th>Info</th>
                                    <th>Assgined to</th>
                                    <th>Created by</th>
                                    <th>Created at</th>
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
                                <td>
                                <a class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-script')

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
    $('#myTable').DataTable();
});
$('#myTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});
</script>

@endpush