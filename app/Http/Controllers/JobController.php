<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\DataJobs;
use App\Models\DataDevices;
use App\Models\JobPriority;
use App\Models\DeviceType;
use App\Models\BaseJobStatuse;
use App\Models\DataComments;

class JobController extends Controller
{
    //
    public function __constuct() 
    {
        parent::__constuct();
        $this->middleware('auth');
    }

    public function addNewJob(Request $request)
    {
        $job = new DataJobs();
        
        $job->user_id = Auth::user()->id;
        $job->user_name = Auth::user()->username;
        $job->job_id = rand(100, 99999);
        $job->job_password = rand(100000000, 999999999);

        $job->client_id = $request->input('client_id');
        $job->client_name = 'abc';
        $job->priority = $request->input('priority');
        $job->device_malfunc_info = $request->input('device_malfunc_info');
        $job->important_data = $request->input('important_data');
        $job->notes = $request->input('notes');

        $job->save();

        $devices = new DataDevices();
        $devices->job_id = $job->job_id;
        $devices->type = $request->input('device_type');
        $devices->role = $request->input('role');
        $devices->manufacturer = $request->input('manufacturer');
        $devices->model = $request->input('model');
        $devices->serial = $request->input('serial');
        $devices->location = $request->input('location');

        $devices->save();
        
        return redirect('/job/showAllJob');
    }

    public function showAddJob()
    {
        $priorities = JobPriority::all();
        $types = DeviceType::all();
        return view('job.addJob', compact('priorities', 'types'));
    }

    public function showAllJob()
    {
        $jobs = DataJobs::all();
        return view('job.viewJobs', compact('jobs'));
    }

    public function showAllPriorityJob()
    {
        return view('job.viewJobs');
    }

    public function showOverview()
    {

    }

    public function showEditJob($job_id)
    {
        $job = DataJobs::where('job_id', $job_id)->first();
        $statuses = BaseJobStatuse::all();
        $priorities = JobPriority::all();
        $types = DeviceType::all();

        $devices = DataDevices::where('job_id', $job_id)->get()->toArray();

        $comments = DataComments::where('job_id', $job_id)->get()->toArray();

        return view('job.editJob' , compact('job','statuses','priorities', 'devices', 'comments', 'types'));
    }

    public function updateJob(Request $request)
    {
        $job_id = $request->input('seljob_id');
        $services = $request->input('services');
        $job_password = $request->input('job_password');
        $services = $request->input('assigned_engineer');
        $price = $request->input('price');

        $job = DataJobs::where('job_id', $job_id)->first();

        $job->services = $services;
        $job->job_password = $request->input('job_password');
        $job->assigned_engineer = $request->input('assigned_engineer');
        $job->price = $request->input('price');
        $job->status = $request->input('status');
        $job->priority = $request->input('priority');
        $job->device_malfunc_info = $request->input('device_malfunc_info');
        $job->important_data = $request->input('important_data');
        $job->notes = $request->input('notes');

        $job->update();

        return redirect(route('show_all_job'));
    }

    public function deleteJob($id)
    {

    }

    public function sendComment(Request $request)
    {
        $job_id = $request->input('comjob_id');
        $strval = $request->input('comment');

        $comment = new DataComments();
        $comment->job_id = $job_id;
        $comment->user = Auth::user()->username;
        $comment->note = $strval;
        $comment->save();

        $job = DataJobs::where('job_id',$job_id)->first();
        $job->last_comment = $strval;
        $job->update(); 
        
        return redirect()->back();
    }

    public function addDevice(Request $request)
    {
        $device = new DataDevices();
        $device->job_id = $request->input('sel_job_id_cr');
        $device->type = $request->input('cr_device_name');
        $device->role = 'Other';
        $device->manufacturer = $request->input('cr_manufacturer');
        $device->model = $request->input('cr_model');
        $device->serial = $request->input('cr_serial');
        $device->location = $request->input('cr_location');
        $device->note = $request->input('cr_note');
        $device->save();

        return redirect()->back();
    }
}
