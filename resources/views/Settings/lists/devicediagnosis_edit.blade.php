@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <form class="form-material m-t-40" action="{{ route('updateDeviceDiagnosis') }}" method="post">
    @csrf
    <input type="hidden" name="device_diagnosis_id" id="device_diagnosis_id" value="{{ $deviceDiagnosis->id }}" />
        <div class="form-group">
            <label><span class="help">Update Device Name</span></label>
        <input type="text" name="update_devicename" class="form-control form-control-line" placeholder="Please insert new device name" value="{{ $deviceDiagnosis->device_name }}">
        </div>
        <div class="form-group">
            <label><span class="help">Update Device Type</span></label>
        <input type="text" name="update_devicetype" class="form-control form-control-line" placeholder="Please insert new device type" value="{{ $deviceDiagnosis->device_type }}">
        </div>
        <button type="submit" class="btn btn-rounded btn-info">Update</button>
    </form>
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>



@endpush