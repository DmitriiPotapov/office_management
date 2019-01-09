@extends('layouts.layout')

@push('header-style')

<link href="{{ asset('assets/plugins/icheck/skins/all.css')}}" rel="stylesheet">

@endpush

@section('content')

<div class="container-fluid">
<!-- Bread crumb and right sidebar toggle -->
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Users and Groups</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
                <li class="breadcrumb-item active">Edit user</li>
            </ol>
        </div>
    </div>
    <!-- End Bread crumb and right sidebar toggle -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/user/updateUser') }}">
                    @csrf
                        <input type="hidden" name="selid" value="{{ $seluser->id }}">
                        <div class="form-body">
                            <h3 class="card-title">User details</h3>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Full Name</label>
                                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter full name" value="{{ $seluser->fullname }}" required>
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label">User Name</label>
                                        <input type="text" id="username" name="username" class="form-control" value="{{ $seluser->username }}" placeholder="Enter user name" required>
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="password" id="password" name="password" class="form-control"  placeholder="Enter pwd" required>
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label">Confirm Password </label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control " placeholder="Confirm pwd" required>
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">E-mail</label>
                                        <input type="email" id="email" name="email" class="form-control"value="{{ $seluser->email }}"  placeholder="Enter e-mail" required>
                                        <small class="form-control-feedback">  </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label">UI Language</label>
                                        <select class="form-control custom-select" id="ui_language" value="{{ $seluser->ui_language }}" name="ui_language">
                                            <option value=""></option>
                                            <option value="English" {{ ($seluser->ui_language == 'English') ? 'selected' : '' }}>English</option>
                                            <option value="Russian" {{ ($seluser->ui_language == 'Russian') ? 'selected' : '' }}>Russian</option>
                                            <option value="Chinese" {{ ($seluser->ui_language == 'Chinese') ? 'selected' : '' }}>Chinese</option>
                                            <option value="French" {{ ($seluser->ui_language == 'French') ? 'selected' : '' }}>French</option>
                                        </select><small class="form-control-feedback">  </small> </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="control-label">Role</label>
                                        <select class="form-control custom-select" id="role" name="role">
                                            @foreach($roles as $item)
                                            <option value="{{ $item['role_name'] }}" {{ ($seluser->role == $item['role_name']) ? 'selected' : '' }}>{{ $item['role_name'] }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-control-feedback"> </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">User group</label>
                                        <select class="form-control custom-select" id="user_group" value="{{ $seluser->user_group }}" name="user_group">
                                            @foreach($groups as $item)
                                            <option value="{{ $item['group_name'] }}" {{ ($seluser->user_group == $item['group_name']) ? 'selected' : '' }}>{{ $item['group_name'] }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-control-feedback"> </small> </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <h3 class="box-title m-t-40">Miscellaneous</h3>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="input-group">
                                        <ul class="icheck-list">
                                            <li>
                                                <input type="checkbox" name="isactive" class="check" id="isactive" {{ ($seluser->isactive == 'on') ? 'checked' : '' }}>
                                                <label for="isactive">Make user active</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <h3 class="box-title m-t-40">Permissions</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <ul class="icheck-list">
                                            @for ($i = 0; $i < count($permissions) ; $i += 3)
                                            <li>
                                                <input type="checkbox" class="check" id="{{ 'minimal-checkbox-'.$i }}"  name="{{ 'checkbox'.$i }}" >
                                                <input type="hidden" name="{{ 'label'.$i }}" value="{{ $permissions[$i]['permission_name'] }}">
                                                <label for="{{ 'minimal-checkbox-'.$i }}" >{{ $permissions[$i]['permission_name'] }}</label>
                                            </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <ul class="icheck-list">
                                            @for ($i = 1; $i < count($permissions) ; $i += 3)
                                            <li>
                                                <input type="checkbox" class="check" id="{{ 'minimal-checkbox-'.$i }}"  name="{{ 'checkbox'.$i }}">
                                                <input type="hidden" name="{{ 'label'.$i }}" value="{{ $permissions[$i]['permission_name'] }}">
                                                <label for="{{ 'minimal-checkbox-'.$i }}" >{{ $permissions[$i]['permission_name'] }}</label>
                                            </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <ul class="icheck-list">
                                            @for ($i = 2; $i < count($permissions) ; $i += 3)
                                            <li>
                                                <input type="checkbox" class="check" id="{{ 'minimal-checkbox-'.$i }}"  name="{{ 'checkbox'.$i }}">
                                                <input type="hidden" name="{{ 'label'.$i }}" value="{{ $permissions[$i]['permission_name'] }}">
                                                <label for="{{ 'minimal-checkbox-'.$i }}" >{{ $permissions[$i]['permission_name'] }}</label>
                                            </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
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