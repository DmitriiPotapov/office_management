@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <form class="form-material m-t-40" action="{{URL::to('settings/lists/services/updateAction')}}" method="post">
    @csrf
    <input type="hidden" name="service_id" id="service_id" value="{{ $service->id }}" />
        <div class="form-group">
            <label><span class="help">Update Service</span></label>
            <input type="text" name="update_servicename" class="form-control form-control-line" placeholder="Please insert new service name" value="{{ $service->service_name }}">
        </div>
        <button type="submit" class="btn btn-rounded btn-info">Update</button>
    </form>
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>



@endpush