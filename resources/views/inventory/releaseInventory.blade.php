@extends('layouts.layout')

@push('header-style')

@endpush

@section('content')
<div class="container-fluid">
<!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Release From Jobs</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row button-group">
                        <div class="col-lg-12 col-xlg-8 m-b-30">
                            <button class="btn btn-outline-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-arrows"></i></span>Move selected</button>
                            <button class="btn btn-outline-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-upload"></i></span>Remove from selected jobs</button>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Serial Number</th>
                                    <th>Firmware</th>
                                    <th>Capacity</th>
                                    <th>PCB</th>
                                    <th>Location</th>
                                    <th>Form factor</th>
                                    <th>Note</th>
                                    <th>Heads</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($inventories as $item)
                            <tr>
                                <td>{{ sprintf("%04d",$item['id']) }}</td>
                                <td>{{ $item['manufacturer'] }}</td>
                                <td>{{ $item['model'] }}</td>
                                <td>{{ $item['serial_number'] }}</td>
                                <td>{{ $item['firmware'] }}</td>
                                <td>{{ $item['capacity'] }}</td>
                                <td>{{ $item['PCB_id'] }}</td>
                                <td>{{ $item['location'] }}</td>
                                <td>{{ $item['Form_factor'] }}</td>
                                <td>{{ $item['note'] }}</td>
                                <td>{{ $item['heads_info'] }}</td>
                                <td>
                                <a class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
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