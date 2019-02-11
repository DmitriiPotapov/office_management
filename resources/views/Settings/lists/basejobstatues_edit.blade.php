@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <form class="form-material m-t-40" action="{{URL::to('settings/lists/basejobstatues/updateAction')}}" method="post">
    @csrf
        <div class="form-group">
            <label><span class="help">New Job Status</span></label>
        <input type="text" name="new_jobstatus" class="form-control form-control-line" placeholder="Please insert new job status" value="{{ $basejobstatus->status_name }}">
        <input type="hidden" name="job_status_id" id="job_status_id" value="{{ $basejobstatus->id }}" />
        </div>
        <button type="submit" class="btn btn-rounded btn-info" id="insertjobstatus">Insert</button>
    </form>
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>

@endpush