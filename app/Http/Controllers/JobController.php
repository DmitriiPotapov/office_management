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
use App\Models\DataJobHistory;
use App\User;
use App\Models\DataLogs;
use PDF;

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

        $history = new DataJobHistory();
        $history->job_id = $job->job_id;
        $history->user_name = $job->user_name;
        $history->client_name = $job->client_name;
        $history->job_priority = $job->priority;
        $history->job_status = 'Received';
        $history->job_info = $job->device_malfunc_info;
        $history->important_data = $job->important_data;
        $history->comment = $job->notes;
        
        $history->save();

        $log = new DataLogs();
        $log->job_id = $job->job_id;
        $log->user_name = $job->user_name;
        $log->ip_address = \Request::ip();
        $log->module = 'Job';
        $log->action = 'create';
        $log->description = 'New job created, number '.$job->job_id.' , client '.$job->client_name;
        $log->save();
        
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
        $jobs = DataJobs::where('priority','!=','Normal')->get()->toArray();
        return view('job.viewJobs', compact('jobs'));
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

        $histories = DataJobHistory::where('job_id', $job_id)->get()->toArray();

        $engineers = User::where('role', 'Engineer')->get()->toArray();

        $logs = DataLogs::where('job_id', $job_id)->get()->toArray();

        return view('job.editJob' , compact('job','statuses','priorities', 'devices', 'comments', 'types', 'histories', 'engineers', 'logs'));
    }

    public function updateJob(Request $request)
    {
        $job_id = $request->input('seljob_id');
        $services = $request->input('services');
        $job_password = $request->input('job_password');
        $price = $request->input('price');

        $job = DataJobs::where('job_id', $job_id)->first();

        $oldStatus = $job->status;

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

        $history = new DataJobHistory();
        $history->job_id = $job->job_id;
        $history->user_name = $job->user_name;
        $history->client_name = $job->client_name;
        $history->job_priority = $job->priority;
        $history->job_status = $job->status;
        $history->job_info = $job->device_malfunc_info;
        $history->important_data = $job->important_data;
        $history->comment = $job->notes;
        
        $history->save();

        $log = new DataLogs();
        $log->job_id = $job->job_id;
        $log->user_name = Auth::user()->username;
        $log->ip_address = $request->ip();
        $log->module = 'Job';
        if ($oldStatus != $job->status)
        {
            $log->action = 'changeStatus';
            $log->description = 'Job number '.$job->job_id.' ('.$job->user_name.') changed status from '.$oldStatus.' to '.$job->status;
        }
        else
        {
            $log->action = 'edit';
            $log->description = 'Job '.$job->job_id.' edited ';
        }
        $log->save();

        return redirect(route('show_all_job'));
    }

    public function deleteJob($id)
    {
        $job = DataJobs::where('job_id' , $id)->first();
        $job->delete();

        return redirect()->back();
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

        $history = new DataJobHistory();
        $history->job_id = $job->job_id;
        $history->user_name = $job->user_name;
        $history->client_name = $job->client_name;
        $history->job_priority = $job->priority;
        $history->job_status = $job->status;
        $history->job_info = $job->device_malfunc_info;
        $history->important_data = $job->important_data;
        $history->comment = $job->notes;
        $history->client_info = $job->last_comment;
        
        $history->save();

        $log = new DataLogs();
        $log->job_id = $job->job_id;
        $log->user_name = $job->user_name;
        $log->ip_address = \Request::ip();
        $log->module = 'Job';
        $log->action = 'addComment';
        $log->description = 'Commented on job number '.$job->job_id.', '.$job->client_name.', "'.$job->last_comment.'"';
        $log->save();
        
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

        $log = new DataLogs();
        $log->job_id = $device->job_id;
        $log->user_name = Auth::user()->username;
        $log->ip_address = $request->ip();
        $log->module = 'Job';
        $log->action = 'addDevice';
        $log->description = 'Job number '.$device->job_id.' , device added: '.$device->manufacturer;
        $log->save();

        return redirect()->back();
    }

    public function updateServcie(Request $request)
    {
        $job_id = $request->input('update_service_job_id');

        $job = DataJobs::where('job_id',$job_id)->first();
        $job->services = $request->input('service_name');
        $job->update();

        return redirect()->back();
    }

    public function assignJob(Request $request)
    {
        $job_id = $request->input('assign_job_id');
        
        $job = DataJobs::where('job_id',$job_id)->first();
        $job->assigned_engineer = $request->input('assign_engineer');
        $job->update();
        
        $history = new DataJobHistory();
        $history->job_id = $job->job_id;
        $history->user_name = $job->user_name;
        $history->client_name = $job->client_name;
        $history->job_priority = $job->priority;
        $history->job_status = $job->status;
        $history->job_info = $job->device_malfunc_info;
        $history->important_data = $job->important_data;
        $history->comment = $job->notes;
        $history->client_info = $job->last_comment;
        $history->assigned_to = $job->assigned_engineer;
        
        $history->save();

        $log = new DataLogs();
        $log->job_id = $job->job_id;
        $log->user_name = Auth::user()->username;
        $log->ip_address = $request->ip();
        $log->module = 'Job';
        $log->action = 'assignedJob';
        $log->description = 'Job assigned to '.$job->assigned_engineer;
        $log->save();

        return redirect()->back();
    }

    public function deleteComment($id)
    {
        $comment = DataComments::find($id);
        $comment->delete();

        return redirect()->back();
    }

    public function deleteDevice($id)
    {
        $device = DataDevices::find($id);
        $device->delete();

        return redirect()->back();
    }

    public function addmissionForm($job_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_job_data_to_html($job_id));
        $pdf->stream();
        $invoice_path = 'admission_form_'.$job_id.'.pdf';
        return $pdf->download($invoice_path);

    }

    function convert_job_data_to_html($job_id)
    {
        $job = DataJobs::where('job_id',$job_id)->first();
        $output = '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>HTML4</title>
<style>
body {
  font-family: Verdana,sans-serif;
  font-size: 0.9em;
}

div#header, div#footer {
  padding: 10px;
  color: white;
  background-color: black;
}

div#content {
  margin: 5px;
  padding: 10px;
  background-color: lightgrey;
}

div.article {
  margin: 5px;
  padding: 10px;
  background-color: white;
}

div#menu ul {
  padding: 0;
}

div#menu ul li {
  display: inline;
  margin: 5px;
}
.title_block {
    border-bottom: 1px solid #000;
    padding-bottom: 1px;
    margin-bottom: 1px;
}
table {
font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;
}

td, th {
border: 1px solid #dddddd;
text-align: left;
padding: 8px;
}

</style>
</head>
<body>
<h1> YOUR LOGO HERE </h1>
<div class="title_block">
<h3>Company slogan</h3>
</div>
<p>
</p>
<div class="title_block">
<h5>Address:</h5>
<h5>Tel:</h5>
<h5>Fax:</h5>
<h5>Skype:</h5>
<h5>Web:</h5>
<h5>Email:</h5>
</div>
<p>
</p>
<div class="title_block">
<h3 align="center">CASE NUMBER:</h3>
<h3 align="center">'.$job->job_id.'</h3>
<h5>Client name:</h5>
<h5>Address:</h5>
<h5>City:</h5>
<h5>Case Password:</h5>
<h5>Date:</h5>
<h5>Service:</h5>
<h5>E-mail:</h5>
<h5>Mobile phone:</h5>
</div>
<p>
</p>
<div class="title_block">
<table>
    <thead>
        <tr>
            <td><b>Type</b></td>
            <td><b>Manufacturer</b></td>
            <td><b>Model</b></td>
            <td><b>Serial Number</b></td>
        </tr>
    </thead>
    <tbody>';

    $devices = DataDevices::where('job_id', $job_id)->get()->toArray();
    foreach($devices as $item)
    {
        $output .= '
        <tr>
        <td>'.$item["type"].'</td>
        <td>'.$item["manufacturer"].'</td>
        <td>'.$item["model"].'</td>
        <td>'.$item["serial"].'</td>
        </tr>';
    }
    $output .=
'</tbody>
</table>
</div>
<p>
</p>
</div>
<div class="title_block">
<h3>TERMS OF SERVICE</h3>
</div>
<p>
Lorem ipsum dolaldiwerjkjlk, dkjfowjerijklaslkdjfalkds, dskflkdsjfcxlvjlksjdoiewr,scjvkxcjvoiwekrjds,.cxvjdsfiewr.dsfjdsfioewrijwsejdslkf,cvzxkcljvkldsjfiwerjlklkjsdjf,LDJFOIERJldflkj DFDerdfdsDFDCV JijIJIJ
</p>

</div>
</body>
</html>';
        return $output;
    }

}
