@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- Start Page Content -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-danger">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="fa fa-exclamation-triangle"></i>&nbsp;2,064</h1>
                    <h6 class="text-white">Urgent attention</h6>
                </div>
                <div class="box bg-white text-center border-red" >
                    <h6 class="text-red">View Details</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-primary card-success">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="fa fa-check"></i>&nbsp;2,064</h1>
                    <h6 class="text-white">Completed successfully</h6>
                </div>
                <div class="box bg-white text-center border-red" >
                    <h6 class="text-red">View Details</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-warning">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="fa fa-clock-o"></i>&nbsp;2,064</h1>
                    <h6 class="text-white">Payment pending</h6>
                </div>
                <div class="box bg-white text-center border-red" >
                    <h6 class="text-red">View Details</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-danger">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="fa fa-money"></i>&nbsp;2,064</h1>
                    <h6 class="text-white">Paid</h6>
                </div>
                <div class="box bg-white text-center border-red" >
                    <h6 class="text-red">View Details</h6>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-md-7">
            <div class="table-responsive">
                <table class="table color-bordered-table info-bordered-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Date</th>
                            <th>Job</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $item)
                            <tr>
                                <td>{{ $item['user_name'] }}</td>
                                <td>{{ $item['created_at'] }}</td>
                                <td>{{ $item['job_id'] }}</td>
                                <td>{{ $item['last_comment'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-5">
            <h4 class="card-title"><i class="fa fa-bell"></i>&nbsp;Notifications Panel</h4>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-4 control-label"><b><i class="fa fa-comment"></i>&nbsp;Reminders</b></label>
                    <label class="col-lg-6 control-label" style="text-align: right;">never</label>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 control-label"><b><i class="fa fa-envelope"></i>&nbsp;Message sent</b></label>
                    <label class="col-lg-6 control-label" style="text-align: right;">never</label>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 control-label"><b><i class="fa fa-tasks"></i>&nbsp;Latest Job</b></label>
                    <label class="col-lg-6 control-label" style="text-align: right;">2019.1.9.14:22:01</label>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 control-label"><b><i class="fa fa-upload"></i>&nbsp;Server Uptime</b></label>
                    <label class="col-lg-6 control-label" style="text-align: right;">up 1 week, 1 day, 8 hours, 27 minutes </label>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 control-label"><b><i class="fa fa-flash"></i>&nbsp;Last error</b></label>
                    <label class="col-lg-6 control-label" style="text-align: right;">never</label>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 control-label"><b><i class="fa fa-warning"></i>&nbsp;Server not responding</b></label>
                    <label class="col-lg-6 control-label" style="text-align: right;">never</label>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 control-label"><b><i class="fa fa-money"></i>&nbsp;Payment Received</b></label>
                    <label class="col-lg-6 control-label" style="text-align: right;">never</label>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 offset-lg-4 ">
                        <button type="button" >View All Alerts</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <!-- End PAge Content -->
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>



@endpush