@extends('layouts.layout')

@push('header-style')

@endpush

@section('content')
<div class="container-fluid">
<!-- Bread crumb and right sidebar toggle -->
    <div class="row">
        <div class="col-md-1" style="background-color:#eab6b6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Urgent</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#eab6b6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row">
        @php
            $count = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'])
            @php
                $count ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#eab6b6;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $count }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Received</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row">
        @php
            $count = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Received')
            @php
                $count ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $count }}</div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#b4ffed;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>In Process</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#b4ffed;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row">
        @php
            $count = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'In Process')
            @php
                $count ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#b4ffed;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $count }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Waiting for parts</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row">
        @php
            $count = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Waiting for parts')
            @php
                $count ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $count }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#7df995;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Completed successfully</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#7df995;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row">
        @php
            $count = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Completed successfully')
            @php
                $count ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#7df995;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $count }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Payment pending</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row">
        @php
            $count = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Payment pending')
            @php
                $count ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $count }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffd6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Waiting for file list acceptance</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffd6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row">
        @php
            $count = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Waiting for file list acceptance')
            @php
                $count ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffd6;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $count }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Arrival pending</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row">
        @php
            $count = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Arrival pending')
            @php
                $count ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $count }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffddd6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Assigned to engineer</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffddd6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row">
        @php
            $count = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Assigned to engineer')
            @php
                $count ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffddd6;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $count }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 15px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Waiting for upfront payment</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row">
        @php
            $count = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Waiting for upfront payment')
            @php
                $count ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $count }}</b></label></div>
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

function onquickjump()
{
    var id = $('#jobNumber').val();
    window.location = '/job/editJob/' + id;
}

</script>

@endpush