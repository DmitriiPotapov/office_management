@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <form class="form-material m-t-40" action="{{URL::to('settings/lists/services/createAction')}}" method="post">
    @csrf
        <div class="form-group">
            <label><span class="help">New Service</span></label>
            <input type="text" name="new_servicename" class="form-control form-control-line" placeholder="Please insert new service name">
        </div>
        <button type="submit" class="btn btn-rounded btn-info">Insert</button>
    </form>
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>



@endpush