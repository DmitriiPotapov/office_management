@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">All Stock Items</h3>
            <a href = "{{URL::to('stock/create')}}"><button type="button" class="btn btn-info"><i class="ti-plus text" aria-hidden="true"></i>Add New Stock</button></a>
        </div>
        
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-40">
                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>                                
                                <th>Manufacturer</th>
                                <th>Model</th>
                                <th>Serial number</th>
                                <th>Location</th>
                                <th>Price with VAT</th>
                                <th>Input date</th>
                                <th> Action</th>                                   
                            </tr>
                        </thead>
                        
                        <tbody> 
                            @foreach ($stockItems as $item)                      
                            <tr>
                            <td>{{ $item->manufacturer }}</td>
                            <td>{{ $item->stock_model }}</td>
                            <td>{{ $item->serial_number }}</td>
                            <td>{{ $item->location }}</td>
                            <td>{{ $item->input_price }}</td>
                            <td>{{ $item->created_at }}</td>    
                                <td class="td_stock">
                                <a href="{{ route('editStock', ['id' => $item['id']]) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>  
                                <a href="{{ URL::to('stock/deleteAction?id=') }}{{ $item->id }}"><button class="btn-sm btn-danger btn-circle" type="button"> <i class="fa fa-trash" aria-hidden="true"></i> </button></a>
                                </td>
                              </tr>
                            @endforeach                                
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/jobstatues.js')}}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
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
        $("body").on('click', "#example23 tbody td", function() {
            if($(this).hasClass("td_stock")) return;
            obj = $(this).closest("tr").find('a[data-original-title="Edit"]');
            document.location.replace(obj.attr("href"));
        })

        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>   
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('js/jQuery.style.switcher.js')}}"></script>

@endpush