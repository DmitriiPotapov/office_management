@extends('layouts.layout')

@push('header-style')

<link href="{{ asset('assets/plugins/icheck/skins/all.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/typeahead.js-master/dist/typehead-min.css')}}" rel="stylesheet">

@endpush

@section('content')
<div style="margin-left:50px;margin-top:50px;">
<h1> New Job </h1>
<div>Job successfully added under number {{$jobNumber}}. Job password is {{$password}}</div><br>
<a href="{{route('admission_form',['job_id' => $jobNumber])}}"><button>Print admission form</button></a><br><br>
<a href="{{route('show_edit_job',['id' => $jobNumber])}}"><button>Go to job</button></a>
</div>
@endsection

@push('footer-script')

@endpush