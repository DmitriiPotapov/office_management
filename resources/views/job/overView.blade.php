@extends('layouts.layout')

@push('header-style')

@endpush

@section('content')
<div class="container-fluid">
<!-- Bread crumb and right sidebar toggle -->
    <div class="row">
        <div class="col-md-1" style="background-color:#eab6b6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Urgent</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#eab6b6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
            <div class="row" id = "urgent_div" style="    display: -webkit-inline-box;overflow-x: hidden;width: 100%;">
            @php
                $urgcount = 0;
            @endphp
            @foreach($jobs as $item)
            @if($item['priority'] == 'Emergency')
                @php
                    $urgcount ++;
                @endphp
                <div style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;"><a href="{{ route('show_edit_job',['id' => $item['job_id']] ) }}">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</a></div>
            @endif
            @endforeach
            </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#eab6b6;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $urgcount }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Received</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row" id = "received_div" style="    display: -webkit-inline-box;overflow-x: hidden;width: 100%;">
        @php
            $receivedcount = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Received')
            @php
                $receivedcount ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;"><a href="{{ route('show_edit_job',['id' => $item['job_id']] ) }}">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</a></div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $receivedcount }}</div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#b4ffed;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>In Process</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#b4ffed;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row" id = "inprocess_div" style="    display: -webkit-inline-box;overflow-x: hidden;width: 100%;">
        @php
            $inProcessCount = 0;
        @endphp
        @foreach($jobs as $item)
        @if(($item['status'] == 'Under Inspection') || ($item['status'] == 'Under Recovery'))
            @php
                $inProcessCount ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;"><a href="{{ route('show_edit_job',['id' => $item['job_id']] ) }}">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</a></div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#b4ffed;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $inProcessCount }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Waiting for parts</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row" id = "waitingforparts_div" style="    display: -webkit-inline-box;overflow-x: hidden;width: 100%;">
        @php
            $waitingForPartsCount = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Waiting for Parts')
            @php
                $waitingForPartsCount ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;"><a href="{{ route('show_edit_job',['id' => $item['job_id']] ) }}">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</a></div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $waitingForPartsCount }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#7df995;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Completed successfully</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#7df995;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row" id = "completed_div" style="    display: -webkit-inline-box;overflow-x: hidden;width: 100%;">
        @php
            $completedCount = 0;
        @endphp
        @foreach($jobs as $item)
        @if(($item['status'] == 'Completed Successfully') || ($item['status'] == 'Delivered/Paid') || ($item['status'] == 'Delivered/Unpaid'))
            @php
                $completedCount ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;"><a href="{{ route('show_edit_job',['id' => $item['job_id']] ) }}">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</a></div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#7df995;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $completedCount }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Payment pending</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row" id = "payment_div" style="    display: -webkit-inline-box;overflow-x: hidden;width: 100%;">
        @php
            $paymentCount = 0;
        @endphp
        @foreach($jobs as $item)
        @if(($item['status'] == 'Delivered/Unpaid') || ($item['status'] == 'Delivered/Partially Paid'))
            @php
                $paymentCount ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;"><a href="{{ route('show_edit_job',['id' => $item['job_id']] ) }}">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</a></div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $paymentCount }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffd6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Waiting for Verification</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffd6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row" id = "waitingforfile_div" style="    display: -webkit-inline-box;overflow-x: hidden;width: 100%;">
        @php
            $waitingForFileCount = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Waiting for Verification')
            @php
                $waitingForFileCount ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;"><a href="{{ route('show_edit_job',['id' => $item['job_id']] ) }}">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</a></div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffd6;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $waitingForFileCount }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Waiting for approval</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row" id = "arrival_div" style="    display: -webkit-inline-box;overflow-x: hidden;width: 100%;">
        @php
            $arrivalCount = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Waiting for approval')
            @php
                $arrivalCount ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;"><a href="{{ route('show_edit_job',['id' => $item['job_id']] ) }}">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</a></div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $arrivalCount }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffddd6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Waiting for Advance</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffddd6;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row" id = "assigned_div" style="    display: -webkit-inline-box;overflow-x: hidden;width: 100%;">
        @php
            $assignedCount = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Waiting for Advance')
            @php
                $assignedCount ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;"><a href="{{ route('show_edit_job',['id' => $item['job_id']] ) }}">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</a></div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffddd6;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $assignedCount }}</b></label></div>
    </div>
    <div class="row">
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>Ready for Delivery</b></label></div>&nbsp;
        <div class="col-md-9" style="background-color:#ffffff;padding-top: inherit;font-size: 20px;height: 95px; border: dotted;margin-bottom: 5px;">
        <div class="row" id = "waitingforupfront_div" style="    display: -webkit-inline-box;overflow-x: hidden;width: 100%;">
        @php
            $waitingForUpfrontCount = 0;
        @endphp
        @foreach($jobs as $item)
        @if($item['status'] == 'Ready for Delivery')
            @php
                $waitingForUpfrontCount ++;
            @endphp
            <div class="col-md-1" style="border-radius: 10px;border:dotted;width:100px;height:80px;margin-top:4px;margin-left:4px;text-align:center;border-color: #9c9cfd;"><a href="{{ route('show_edit_job',['id' => $item['job_id']] ) }}">{{ $item['job_id'].'   '.($item['assigned_engineer'] != 'Not assigned' ? $item['assigned_engineer'] : '') }}</a></div>
        @endif
        @endforeach
        </div>
        </div>&nbsp;
        <div class="col-md-1" style="background-color:#ffffff;padding-top: inherit;font-size: 30px;height: 95px; border: dotted;margin-bottom: 5px;"><label style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;"><b>{{ $waitingForUpfrontCount }}</b></label></div>
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

setInterval(scrollFunc,50);
var flgUgr = 1;
var flgReceived = 1;
var flgInProcess = 1;
var flgWaitingForParts = 1;
var flgCompleted = 1;
var flgPayment = 1;
var flgWaitingForFile = 1;
var flgArrival = 1;
var flgAssigned = 1;
var flgWaitingForUpfront = 1;
function scrollFunc()
{
    var ugrcount = "<?php echo $urgcount; ?>"
    if (ugrcount > 11)
    {
        var cur = $("#urgent_div").scrollLeft();
        if (cur > (100 * (ugrcount - 12) + 50))
            flgUgr = -flgUgr;
        if (cur == 0)
            flgUgr = -flgUgr;
        $("#urgent_div").scrollLeft(cur + (flgUgr * 2));
    }

    var receivedcount = "<?php echo $receivedcount; ?>"
    if (receivedcount > 11)
    {
        var cur = $("#received_div").scrollLeft();
        if (cur > (100 * (receivedcount - 12) + 50))
            flgReceived = -flgReceived;
        if (cur == 0)
            flgReceived = -flgReceived;
        $("#received_div").scrollLeft(cur + (flgReceived * 2));
    }
    var inProcessCount = "<?php echo $inProcessCount; ?>"
    if (inProcessCount > 11)
    {
        var cur = $("#inprocess_div").scrollLeft();
        if (cur > (100 * (inProcessCount - 12) + 50))
            flgInProcess = -flgInProcess;
        if (cur == 0)
            flgInProcess = -flgInProcess;
        $("#inprocess_div").scrollLeft(cur + (flgInProcess * 2));
    }
    var waitingForPartsCount = "<?php echo $waitingForPartsCount; ?>"
    if (waitingForPartsCount > 11)
    {
        var cur = $("#waitingforparts_div").scrollLeft();
        if (cur > (100 * (waitingForPartsCount - 12) + 50))
            flgWaitingForParts = -flgWaitingForParts;
        if (cur == 0)
            flgWaitingForParts = -flgWaitingForParts;
        $("#waitingforparts_div").scrollLeft(cur + (flgWaitingForParts * 2));
    }
    var completedCount = "<?php echo $completedCount; ?>"
    if (completedCount > 11)
    {
        var cur = $("#completed_div").scrollLeft();
        if (cur > (100 * (completedCount - 12) + 50))
            flgCompleted = -flgCompleted;
        if (cur == 0)
            flgCompleted = -flgCompleted;
        $("#completed_div").scrollLeft(cur + (flgCompleted * 2));
    }
    var paymentCount = "<?php echo $paymentCount; ?>"
    if (paymentCount > 11)
    {
        var cur = $("#payment_div").scrollLeft();
        if (cur > (100 * (paymentCount - 12) + 50))
            flgPayment = -flgPayment;
        if (cur == 0)
            flgPayment = -flgPayment;
        $("#payment_div").scrollLeft(cur + (flgPayment * 2));
    }
    var waitingForFileCount = "<?php echo $waitingForFileCount; ?>"
    if (waitingForFileCount > 11)
    {
        var cur = $("#waitingForFile_div").scrollLeft();
        if (cur > (100 * (waitingForFileCount - 12) + 50))
            flgWaitingForFile = -flgWaitingForFile;
        if (cur == 0)
            flgWaitingForFile = -flgWaitingForFile;
        $("#waitingForFile_div").scrollLeft(cur + (flgWaitingForFile * 2));
    }
    var arrivalCount = "<?php echo $arrivalCount; ?>"
    if (arrivalCount > 11)
    {
        var cur = $("#arrival_div").scrollLeft();
        if (cur > (100 * (arrivalCount - 12) + 50))
            flgArrival = -flgArrival;
        if (cur == 0)
            flgArrival = -flgArrival;
        $("#arrival_div").scrollLeft(cur + (flgArrival * 2));
    }
    var assignedCount = "<?php echo $assignedCount; ?>"
    if (assignedCount > 11)
    {
        var cur = $("#assigned_div").scrollLeft();
        if (cur > (100 * (assignedCount - 12) + 50))
            flgAssigned = -flgAssigned;
        if (cur == 0)
            flgAssigned = -flgAssigned;
        $("#assigned_div").scrollLeft(cur + (flgAssigned * 2));
    }
    var waitingForUpfrontCount = "<?php echo $waitingForUpfrontCount; ?>"
    if (waitingForUpfrontCount > 11)
    {
        var cur = $("#waitingforupfront_div").scrollLeft();
        if (cur > (100 * (waitingForUpfrontCount - 12) + 50))
            flgWaitingForUpfront = -flgWaitingForUpfront;
        if (cur == 0)
            flgWaitingForUpfront = -flgWaitingForUpfront;
        $("#waitingforupfront_div").scrollLeft(cur + (flgWaitingForUpfront * 2));
    }
}

</script>

@endpush