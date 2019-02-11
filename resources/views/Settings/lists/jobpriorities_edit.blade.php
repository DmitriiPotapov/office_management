@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <form class="form-material m-t-40" action="{{ route('updateJobPriority') }}" method="post">
    @csrf

    <input type="hidden" name="jobpriority_id" id="jobpriority_id" value="{{ $jobPriority->id }}" />
        <div class="form-group">
            <label><span class="help">Update Device Type</span></label>
        <input type="text" name="update_jobpriorityname" class="form-control form-control-line" placeholder="Please insert new job status" value="{{ $jobPriority->job_priority_name }}">
        </div>
        <button type="submit" class="btn btn-rounded btn-info">Update</button>
    </form>
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>

@endpush