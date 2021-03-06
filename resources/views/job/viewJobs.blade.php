@extends('layouts.layout')

@push('header-style')

<style>
tr:hover{
  cursor: pointer;
}
</style>

@endpush

@section('content')
<style>
    #myTable tbody td{
        cursor: pointer;
    }
</style>
<div class="container-fluid">
        <div class="row page-titles">
                <div class="col-md-6 col-8 align-self-center">
                    <h4 class="text-themecolor m-b-0 m-t-0">{{ $heads }}</h4>
                </div>
            </div>
<!-- Bread crumb and right sidebar toggle -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Quick search</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="jobNumber" placeholder="Job Number">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <button onclick="onquickjump()"><a><i class="ti-hand-point-right"></i></a></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="row button-group">
                        <div class="col-lg-12 col-xlg-8 m-b-30">
                            <button class="btn btn-outline-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-envelope-o"></i></span>Generate Invoice</button>
                            <button class="btn btn-outline-secondary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-check"></i></span>Check-out form</button>
                            <button class="btn btn-outline-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-heart"></i></span>Change priority</button>
                            <button class="btn btn-outline-warning waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-envelope-o"></i></span>Change Status</button>
                            <button class="btn btn-outline-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-times"></i></span>Delete</button>
                        </div>
                    </div>-->
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Job ID</th>
                                    <th>Priority</th>
                                    <th>Client</th>
                                    <th>Status</th>
                                    <th>Info</th>
                                    <th>Last Note</th>
                                    <th>Assgined to</th>
                                    <th>Created by</th>
                                    <th>Created at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $item)
                            @if ($item->status == 'Delivered/Paid')
                            <tr style="background-color:rgb(195,229,202);" class='clickable-row' data-href="{{ route('show_edit_job', ['id' => $item['job_id']]) }}">
                            @elseif (($item->status == 'Delivered/Unpaid' || ($item->status == 'Delivered/Partially Paid')))
                            <tr style="background-color:rgb(255,238,186);" class='clickable-row' data-href="{{ route('show_edit_job', ['id' => $item['job_id']]) }}">
                            @elseif ($item->status == 'Completed Successfully')
                            <tr style="background-color:rgb(149,251,218);" class='clickable-row' data-href="{{ route('show_edit_job', ['id' => $item['job_id']]) }}">
                            @elseif (($item->status == 'Approved') || ($item->status == 'Under Recovery'))
                            <tr style="background-color:rgb(190,229,236);" class='clickable-row' data-href="{{ route('show_edit_job', ['id' => $item['job_id']]) }}">
                            @elseif (($item->status == 'Rejected') || ($item->status == 'Returned') || $item->status == 'Cancelled')
                            <tr style="background-color:rgb(245,198,204);" class='clickable-row' data-href="{{ route('show_edit_job', ['id' => $item['job_id']]) }}">
                            @elseif (($item->status == 'Received') || ($item->status == 'Under Inspection') )
                            <tr style="background-color:rgb(255,255,255);" class='clickable-row' data-href="{{ route('show_edit_job', ['id' => $item['job_id']]) }}">
                            @else
                            <tr class='clickable-row' data-href="{{ route('show_edit_job', ['id' => $item['job_id']]) }}">
                            @endif
                                <td>{{ $item['job_id'] }}</td>
                                <td>{{ $item['priority'] }}</td>
                                <td>{{ $item['client_name'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td>{{ $item['device_malfunc_info'] }}</td>
                                <td>{{ $item['notes'] }}</td>
                                <td>{{ $item['assigned_engineer'] }}</td>
                                <td>{{ $item['user_name'] }}</td>
                                <td>{{ $item['created_at'] }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('show_edit_job', ['id' => $item['job_id']]) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                    <a href="{{ route('delete_job', ['id' => $item['job_id']]) }}" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                                </td>
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
    
    $("body").on("click","#myTable tbody td",function(){
        if($(this).hasClass("text-nowrap")) return;
        obj = $(this).closest("tr").find('a[data-original-title="Edit"]');
        document.location.replace(obj.attr("href"));
    })
    $('#myTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    order: [8,'desc']
    });

    $(".clickable-row").click(function() {
        var href = $(this).data("href");
        if (href) {
            window.location = href;
        }
    });
    
});

function onquickjump()
{
    var id = $('#jobNumber').val();
    window.location = '/job/editJob/' + id;
}

</script>

@endpush