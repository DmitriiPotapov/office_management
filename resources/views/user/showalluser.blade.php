@extends('layouts.layout')

@push('header-style')

@endpush

@section('content')
<div class="container-fluid">
<!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Users and Groups</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
                <li class="breadcrumb-item active">Show all users</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                    <th>User group</th>
                                    <th>Roles</th>
                                    <th>Creation Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                            <tr>
                                <td>{{ $item['fullname'] }}</td>
                                <td>{{ $item['username'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>{{ $item['user_group'] }}</td>
                                <td>{{ $item['role'] }}</td>
                                <td>{{ $item['created_at'] }}</td>
                                <td>
                                <a class="btn btn-circle btn-sm btn-info" href="{{ route('show_edit_user',['id' => $item['id']]) }}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-circle btn-sm btn-success"><i class="fa fa-lock"></i></a>
                                <a class="btn btn-circle btn-sm btn-danger" href="{{ route('delete_user',['id' => $item['id']]) }}"><i class="fa fa-times"></i></a></td>
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
    ],
    order: [5,'desc']
});
</script>

@endpush