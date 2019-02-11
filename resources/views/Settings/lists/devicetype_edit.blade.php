@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <form class="form-material m-t-40" action="{{URL::to('settings/lists/devicetypes/updateAction')}}" method="post">
    @csrf
    <input type="hidden" name="devicetype_id" id="devicetype_id" value="{{ $devicetype->id }}" />
        <div class="form-group">
            <label><span class="help">New Device Name</span></label>
        <input type="text" name="update_devicename" class="form-control form-control-line" placeholder="Please insert new device name" value="{{ $devicetype->device_name }}" />
        </div>
       
        <button type="submit" class="btn btn-rounded btn-info">Update</button>
    </form>
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>

@endpush