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
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- Start Page Content -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-info">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">2,064</h1>
                    <h6 class="text-white">Sessions</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-primary card-inverse">
                <div class="box text-center">
                    <h1 class="font-light text-white">1,738</h1>
                    <h6 class="text-white">Users</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-success">
                <div class="box text-center">
                    <h1 class="font-light text-white">5963</h1>
                    <h6 class="text-white">Page Views</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-inverse card-warning">
                <div class="box text-center">
                    <h1 class="font-light text-white">10%</h1>
                    <h6 class="text-white">Bounce Rate</h6>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row">
        
    </div>
    <!-- Row -->
    <!-- End PAge Content -->
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>



@endpush