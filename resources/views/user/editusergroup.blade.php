@extends('layouts.layout')

@push('header-style')

<link href="{{ asset('assets/plugins/icheck/skins/all.css')}}" rel="stylesheet">

@endpush

@section('content')

<div class="container-fluid">
<!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Update Users and Groups</h3>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/user/updateUsergroup') }}">
                    @csrf
                        <input type="hidden" name="selid" value="{{ $selgroup->id }}">
                        <div class="form-body">
                            <h3 class="card-title">Edit user group</h3>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Group Name</label>
                                        <input type="text" id="group_name" name="group_name" class="form-control" placeholder="Enter group name" value="{{ $selgroup->group_name }}" required>
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
                            <button type="button" class="btn btn-inverse">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('footer-script')
<script src="{{ asset('assets/plugins/icheck/icheck.min.js')}}"></script>
<script src="{{ asset('assets/plugins/icheck/icheck.init.js')}}"></script>
@endpush