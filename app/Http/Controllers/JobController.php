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
use App\Models\Invoice;
use App\Models\Backup;
use App\User;
use App\Models\DataLogs;
use PDF;
use App\Models\Client;
use App\Models\Service;

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
        $job->job_id = rand(10000, 99999);
        $job->job_password = rand(100000000, 999999999);

        $client_info = $request->input('client_info');
        $client_name = strtok($client_info, ',');

        $client = Client::where('client_name',$client_name)->first();
        $job->client_id = $client->id;
        $job->client_name = $client->client_name;
        $job->priority = $request->input('priority');
        $job->device_malfunc_info = $request->input('device_malfunc_info');
        $job->important_data = $request->input('important_data');
        $job->notes = $request->input('notes');

        $job->save();

        $device_count = $request->input('device_count');

        for($i = 1 ; $i <= $device_count; $i ++)
        {
            $devices = new DataDevices();
            $devices->job_id = $job->job_id;
            $devices->type = $request->input('device_type'.$i);
            $devices->role = $request->input('role'.$i);
            $devices->manufacturer = $request->input('manufacturer'.$i);
            $devices->model = $request->input('model'.$i);
            $devices->serial = $request->input('serial'.$i);
            $devices->location = $request->input('location'.$i);

            $devices->save();
        }

        

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

    public function showAddJob($client_id)
    {
        $priorities = JobPriority::all();
        $types = DeviceType::all();
        $client = Client::find($client_id);
        $clients = Client::all();
        
        return view('job.addJob', compact('priorities', 'types', 'client_id', 'client','clients'));
    }

    public function showAllJob()
    {
        $jobs = DataJobs::all();
        return view('job.viewJobs', compact('jobs'));
    }

    public function showAllPriorityJob()
    {
        $jobs = DataJobs::where('priority','!=','Standard')->get()->toArray();
        return view('job.viewJobs', compact('jobs'));
    }

    public function showOverview()
    {
        $jobs = DataJobs::all();
        return view('job.overView',compact('jobs'));
    }

    public function viewUrgent()
    {
        $jobs = DataJobs::all()->toArray();
        return view('job.viewJobs', compact('jobs'));
    }

    public function viewCompleted()
    {
        $jobs = DataJobs::where('status', 'Completed successfully')->get()->toArray();
        return view('job.viewJobs', compact('jobs'));
    }

    public function viewPaymentPending()
    {
        $jobs = DataJobs::where('status', 'Payment pending')->get()->toArray();
        return view('job.viewJobs', compact('jobs'));
    }

    public function viewPaid()
    {
        $jobs = DataJobs::where('status', 'Paid')->get()->toArray();
        return view('job.viewJobs', compact('jobs'));
    }

    public function showEditJob($job_id)
    {
        $job = DataJobs::where('job_id', $job_id)->first();
        $client = Client::find($job->client_id);
        $statuses = BaseJobStatuse::all();
        $priorities = JobPriority::all();
        $types = DeviceType::all();

        $devices = DataDevices::where('job_id', $job_id)->get()->toArray();

        $comments = DataComments::where('job_id', $job_id)->get()->toArray();

        $histories = DataJobHistory::where('job_id', $job_id)->get()->toArray();

        $engineers = User::where('role', 'Engineer')->get()->toArray();

        $logs = DataLogs::where('job_id', $job_id)->get()->toArray();

        $services = Service::all();

        $invoice = Invoice::where('job_id', $job_id)->first();


        return view('job.editJob' , compact('job', 'client' ,'statuses','priorities', 'devices', 'comments', 'types', 'histories', 'engineers', 'logs', 'services', 'invoice'));
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

    public function updateDevice(Request $request)
    {
        $device_id = $request->input('device_id');
        $device = DataDevices::find($device_id);
        $device->diagnosis = $request->input('dev_diagnosis');
        $device->consultation = $request->input('dev_consultation');
        $device->recover = $request->input('dev_recover');
        $device->update();

        return redirect()->back();
    }

    public function addmissionForm($job_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_job_data_to_admission_form($job_id));
        $pdf->stream();
        $file_path = 'admission_form_'.$job_id.'.pdf';
        return $pdf->download($file_path);

    }

    public function checkoutForm($job_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_job_data_to_checkout_form($job_id));
        $pdf->stream();
        $file_path = 'chechout_form_'.$job_id.'.pdf';
        return $pdf->download($file_path);
    }
    
    public function generateInvoice($job_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_job_data_to_invoice($job_id));
        $pdf->stream();
        $file_path = 'invoice_'.$job_id.'.pdf';
        return $pdf->download($file_path);
    }

    public function generateQuote($job_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_job_data_to_quote($job_id));
        $pdf->stream();
        $file_path = 'quote_'.$job_id.'.pdf';
        return $pdf->download($file_path);
    }

    public function generateMediaReport($job_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_job_data_to_media($job_id));
        $pdf->stream();
        $file_path = 'media_evaluation_report_'.$job_id.'.pdf';
        return $pdf->download($file_path);
    }

    function convert_job_data_to_admission_form($job_id)
    {
        $job = DataJobs::where('job_id',$job_id)->first();
        $client = Client::find($job->client_id);
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
<div><img src="assets/images/logo_medium.png"></div>
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
<h5>Client name:'.$client->client_name.'</h5>
<h5>Address:'.$client->street.'</h5>
<h5>City:'.$client->city_name.'</h5>
<h5>Case Password:'.$job->job_password.'</h5>
<h5>Date:'.$job->created_at.'</h5>
<h5>Service:'.$job->services.'</h5>
<h5>E-mail:'.$client->email_value.'</h5>
<h5>Mobile phone:'.$client->phone_value.'</h5>
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
Thank you for using our service. Our service is Recovery Service. You are welcome!!!Thank you for using our service. Our service is Recovery Service. You are welcome!!!<br>
Thank you for using our service. Our service is Recovery Service. You are welcome!!!
</p>

</div>
</body>
</html>';
        return $output;
    }

    function convert_job_data_to_checkout_form($job_id)
    {
        $job = DataJobs::where('job_id',$job_id)->first();
        $client = Client::find($job->client_id);
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
<div>
<img src="assets/images/logo_medium.png"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:30px;color:#3FC3F3;" align="right"><b>SIGN OUT FORM</b> </label>
</div>
<br>
<div><label style="font-size:16px;">Customer Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">'.$client->client_name.'</label></div>
<div class="row">
<label style="font-size:16px;">Street Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">'.$client->street.', '.$client->apt.', '.$client->number.'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:16px;color:#2E74B5;"><b>JOB NUMBER # </b> </label>&nbsp;<label style="font-size:16px;">'.$job->job_id.'</label>
</div>
<div><label style="font-size:16px;">City, ST ZIP Code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">'.$client->city_name.'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:16px;color:#2E74B5;"><b> OUT DATE </b> </label>&nbsp;<label style="font-size:16px;">'.$job->created_at.'</label></div>
<div><label style="font-size:16px;">Phone </label>&nbsp;&nbsp;<label style="font-size:16px;">'.$client->phone_value.'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
<label style="font-size:16px;">Fax </label>&nbsp;&nbsp;<label style="font-size:16px;">'.'  '.'</label></div>
<div><label style="font-size:16px;">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">'.$client->email_value.'</label></div>
<br>
';

    $output .=
'
<h3 style="color:#2E74B5;">MEDIA DETAILS</h3>
<div class="title_block" style="border-style:solid;">';

    $devices = DataDevices::where('job_id', $job_id)->get()->toArray();
    foreach($devices as $item)
    {
        $output .= '
        <label style="font-size:16px;">'.$item['manufacturer'].' '.$item['capacity'].'</label><br>
        <label style="font-size:16px;"> Serial Number: '.$item["serial"].'</label><br><br>';
    }


    $output .=
'
</div>
<br>
<br>
<div><label style="font-size:16px;">Customer Name&nbsp;&nbsp;&nbsp;:  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">'.$client->client_name.'</label></div>
<div><label style="font-size:16px;">Mobile Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">'.$client->phone_value.'</label></div>
<div><label style="font-size:16px;">National ID No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">'.$client->nationalId.'</label></div>
<div><label style="font-size:16px;">Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">'.$client->signature.'</label></div>
<br>
<h6>Please read carefully before signing </h6>
<h4>Your Feedback is really important for us to grow </h4>
................................................................................................................................................................................................<br>
................................................................................................................................................................................................<br>
................................................................................................................................................................................................<br>
<h6>How likely do you recommend our service to a friend?  </h6>
<h5>Not Likely at all   0 1 2 3 4 5 6 7 8 9 10 Extremely Likely   </h5>
SPACE RECOVERY <br>
<label style="font-size:12px;">#108, First Floor, Azaiba Mall, Azaiba, Muscat, Sultanate Of Oman | +968 96312346 / 7 | <a>mail@spacedatarecovery.com</a> </label><br>
<div align="center">ww.spacedatarecovery.com </div>
<h2 align="center" style="color:rgb(147,183,217);">THANK YOU FOR YOUR BUSINESS!</h2>
</body>
</html>';
        return $output;
    }
    function convert_job_data_to_invoice($job_id)
    {
        $job = DataJobs::where('job_id',$job_id)->first();
        $invoice = Invoice::where('job_id', $job_id)->first();
        $backup = Backup::where('job_id', $job_id)->first();
        $client = Client::find($job->client_id);
        $total_price = $invoice->item_total_price + $backup->total_price;
        $output = '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>HTML4</title>
<style>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/plugins/summernote/summernote.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet"> 
<link href="css/colors/blue.css" id="theme" rel="stylesheet">
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
    border-bottom: 3px solid #000;
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

body {
    margin-left:50;
    margin-right:35px;
    margin-top:50px;
    margin-bottom:30px;
}

#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size:14px;
    border-collapse: collapse;
    width: 100%;
  }
  
  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers tr:hover {background-color: #ddd;}
  
  #customers th {
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    background-color: #2E74B5;
    color: black;
  }
  #customers1 {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size:14px;
    border-collapse: collapse;
    width: 100%;
  }
  
  #customers1 td, #customers1 th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers1 tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers1 tr:hover {background-color: #ddd;}
  
  #customers1 th {
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    background-color: #436784;
    color: white;
  }

</style>
</head>
<body>
<div class="title_block">
<img src="assets/images/logo_medium.png"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:50px;color:#2E74B5;" align="right"><b>Invoice</b> </label></div>
<p></p>
<br>
<div class="title_block">
<div class="row">
<label style="font-size:18px;color:#2E74B5;"><b>SPACE RECOVERY</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:16px;color:#2E74B5;"><b>Date:  </b> </label>&nbsp;<label style="font-size:16px;"> January 25, 2019</label>
</div>
<div class="row">
<label style="font-size:16px;color:#2E74B5;">SMATCO IT DIVISION  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:16px;color:#2E74B5;"><b>Invoice #: </b> </label>&nbsp;<label style="font-size:16px;">No.</label>
</div>
<div class="row">
<label style="font-size:16px;color:#2E74B5;"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:16px;color:#2E74B5;"><b>Customer Ref: </b> </label>&nbsp;<label style="font-size:16px;"></label>
</div>
<br>
</div>

<p></p>

';

    $output .=
'
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;color:#2E74B5;"><b>To:</b>  </label>&nbsp;<label style="font-size:16px;">'.$client->client_name.'</label></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">Company Name</label></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">Street Address</label></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">City, ST ZIP Code</label></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">Phone</label></div>
<br>
<div >
    <table id="customers">
        <thead>
            <tr>
                <th>Salesperson</th>
                <th>Job</th>
                <th>Payment terms</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>
<br>
<div >
    <table id="customers1">
        <thead>
            <tr>
                <th style="width:50px;">Qty</th>
                <th style="width:250px;">Description</th>
                <th style="width:100px;">Unit Price</th>
                <th style="width:100px;">Line total</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>1.00</td>
            <td>'.$job->services.'</td>
            <td>OMR   '.number_format($invoice->item_total_price,3,".","").'</td>
            <td>OMR   '.number_format($invoice->item_total_price,3,".","").'</td>
        </tr>
        <tr>
            <td>1.00</td>
            <td>Backup '.$invoice->item_type.'</td>
            <td>OMR   '.number_format($backup->total_price,3,".","").'</td>
            <td>OMR   '.number_format($backup->total_price,3,".","").'</td>
        </tr>
        </tbody>
    </table>
</div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:16px;color:#2E74B5;"><b>Subtotal</b></label>&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">OMR '.number_format($total_price,3,".","").'</label></div>
<br>
<br>
<br>
<div><label style="font-size:14px;"><b>Receiver Name:</b>  </label>&nbsp;<label style="font-size:16px;"></label></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:14px;"><b>Signature :</b>  </label>&nbsp;<label style="font-size:16px;"></label></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:14px;"><b>Date :</b>  </label>&nbsp;<label style="font-size:16px;"></label></div>
<br>
<div align="center" style="font-size:14px;">Make all checks payable to "SALMAN MOHAMMED ASHRAF TRDG. & COTG."</div>
<div align="center" ><b>THANK YOU FOR YOUR BUSINESS!</b></div>
<div align="center" style="font-size:11px;">SPACE RECOVERY, #108, First Floor, Azaiba Mall, Azaiba, Muscat, Sultanate Of Oman, www.spacedatarecovery.com </div>
<div align="center" style="font-size:11px;">Email: mail@spacedatarecovery.com ,  Ph: +968 963 12346 / 7</div>
</body>
</html>';
        return $output;
    }
    function convert_job_data_to_quote($job_id)
    {
        $job = DataJobs::where('job_id',$job_id)->first();
        $invoice = Invoice::where('job_id', $job_id)->first();
        $client = Client::find($job->client_id);
        $output = '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>HTML4</title>
<style>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/plugins/summernote/summernote.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet"> 
<link href="css/colors/blue.css" id="theme" rel="stylesheet">
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
    border-bottom: 3px solid #000;
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

body {
    margin-left:50;
    margin-right:35px;
    margin-top:50px;
    margin-bottom:30px;
}

#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size:14px;
    border-collapse: collapse;
    width: 100%;
  }
  
  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers tr:hover {background-color: #ddd;}
  
  #customers th {
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    background-color: #2E74B5;
    color: black;
  }
  #customers1 {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size:14px;
    border-collapse: collapse;
    width: 100%;
  }
  
  #customers1 td, #customers1 th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers1 tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers1 tr:hover {background-color: #ddd;}
  
  #customers1 th {
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    background-color: #436784;
    color: white;
  }

</style>
</head>
<body>
<div class="title_block">
<img src="assets/images/logo_medium.png"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:50px;color:#2E74B5;" align="right"><b>Quotation</b> </label></div>
<p></p>
<br>
<div class="title_block">
<div class="row">
<label style="font-size:18px;color:#2E74B5;"><b>SPACE RECOVERY</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:16px;color:#2E74B5;"><b>Date:  </b> </label>&nbsp;<label style="font-size:16px;"> January 25, 2019</label>
</div>
<div class="row">
<label style="font-size:16px;color:#2E74B5;">SMATCO IT DIVISION  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:16px;color:#2E74B5;"><b>Invoice #: </b> </label>&nbsp;<label style="font-size:16px;">No.</label>
</div>
<div class="row">
<label style="font-size:16px;color:#2E74B5;"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:16px;color:#2E74B5;"><b>Customer Ref: </b> </label>&nbsp;<label style="font-size:16px;"></label>
</div>
<br>
</div>

<p></p>

';

    $output .=
'
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;color:#2E74B5;"><b>To:</b>  </label>&nbsp;<label style="font-size:16px;">'.$client->client_name.'</label></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">Company Name</label></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">Street Address</label></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">City, ST ZIP Code</label></div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">Phone</label></div>
<br>
<br>
<br>
<div >
    <table id="customers1">
        <thead>
            <tr>
                <th style="width:50px;">Qty</th>
                <th style="width:250px;">Description</th>
                <th style="width:100px;">Unit Price</th>
                <th style="width:100px;">Line total</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>1.00</td>
            <td>Data Recover Service</td>
            <td>OMR   '.number_format($invoice->item_total_price,3,".","").'</td>
            <td>OMR   '.number_format($invoice->item_total_price,3,".","").'</td>
        </tr>
        </tbody>
    </table>
</div>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:16px;color:#2E74B5;"><b>Subtotal</b></label>&nbsp;&nbsp;&nbsp;<label style="font-size:16px;">OMR&nbsp;'.number_format($invoice->item_total_price,3,".","").'</label></div>
<br>
<br>
<br>
<br>
<div align="center" style="font-size:14px;">Quote Valid for 30 Days from the date issed Except Ransomware Data Recovery</div>
<div align="center" style="font-size:14px;">*Standard Terms and conditions apply. </div>
<div align="center" ><b>Look Forward to Hear from You Soon :-)</b></div>
<div align="center" style="font-size:11px;">SPACE RECOVERY, #108, First Floor, Azaiba Mall, Azaiba, Muscat, Sultanate Of Oman, www.spacedatarecovery.com </div>
<div align="center" style="font-size:11px;">Email: mail@spacedatarecovery.com ,  Call: +968 963 12346 / 7</div>
</body>
</html>';
        return $output;
    }
    function convert_job_data_to_media($job_id)
    {
        $job = DataJobs::where('job_id',$job_id)->first();
        $client = Client::find($job->client_id);
        $device = DataDevices::where('job_id', $job_id)->first();
        $output = '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>HTML4</title>
<style>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/plugins/summernote/summernote.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet"> 
<link href="css/colors/blue.css" id="theme" rel="stylesheet">

div#header, div#footer {
  padding: 5px;
  color: white;
  background-color: black;
}

div#content {
  margin: 4px;
  padding: 10px;
  background-color: lightgrey;
}

div.article {
  margin: 4px;
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
    border-bottom: 3px solid #000;
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

body {
    margin-left:30px;
    margin-right:25px;
    margin-top:0px;
    margin-bottom:0px;
}

#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size:14px;
    border-collapse: collapse;
    width: 100%;
  }
  
  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers tr:hover {background-color: #ddd;}
  
  #customers th {
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    background-color: #2E74B5;
    color: black;
  }
  #customers1 {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    font-size:14px;
    border-collapse: collapse;
    width: 100%;
  }
  
  #customers1 td, #customers1 th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers1 tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers1 tr:hover {background-color: #ddd;}
  
  #customers1 th {
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    background-color: #436784;
    color: white;
  }

</style>
</head>
<body>
<div>
<img src="assets/images/logo_medium.png"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:35px;color:#3FC3F3;" align="right"><b>SPACE RECOVERY</b> </label>
<label style="font-size:14px;" align="center"> #108, First Floor, Azaiba Mall, Azaiba, Muscat, Oman, www.spacedatarecovery.com, Ph:+968 963 12346 / 7 </label>
</div>
<br>
<div>
<label style="font-size:23px;color:#3B6489;" align="left"><b>MEDIA EVALUATION REPORT #'.$job_id.'</b> </label><br>
<label style="font-size:18px;color:#3B6489;" align="left"><b>'."25/01/2019 ".'</b> </label>
</div>
<br>
<div>
<label style="font-size:18px;color:#122F6B;" align="right"><b>Media Details</b> </label><br>
<label style="font-size:14px;color:#122F6B;">Case ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$job_id.'</label><br>
<label style="font-size:14px;color:#122F6B;">Media Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->type.'</label><br>
<label style="font-size:14px;color:#122F6B;">Brand&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->brand.'</label><br>
<label style="font-size:14px;color:#122F6B;">Capacity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->capacity.'</label><br>
<label style="font-size:14px;color:#122F6B;">Model&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->model.'</label><br>
<label style="font-size:14px;color:#122F6B;">Serial Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->serial.'</label><br>
<label style="font-size:14px;color:#122F6B;">DOM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->dom.'</label><br>
<label style="font-size:14px;color:#122F6B;">Platter/Head&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->platter_head.'</label><br>
<label style="font-size:14px;color:#122F6B;">Made In&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->made_in.'</label><br>
</div>
<br>
<div>
<label style="font-size:18px;color:#122F6B;" align="right"><b>Drive Status</b> </label><br>
<label style="font-size:14px;color:#122F6B;">PCB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->PCB.'</label><br>
<label style="font-size:14px;color:#122F6B;">Motor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->motor.'</label><br>
<label style="font-size:14px;color:#122F6B;">Firmware&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->firmware.'</label><br>
<label style="font-size:14px;color:#122F6B;">Encryption&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->encryption.'</label><br>
<label style="font-size:14px;color:#122F6B;">Head&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </label><label style="font-size:14px;">'.$device->heads.'</label><br>
</div>
<br>
<div>
<label style="font-size:18px;color:#122F6B;" align="right"><b>Analysis</b> </label>
&nbsp;&nbsp;&nbsp;&nbsp;<textarea style="font-size:14px;border:none;" type="text" rows="5">' .$device->diagnosis. '</textarea>
</div><br>
<div>
<label style="font-size:18px;color:#122F6B;" align="right"><b>Consultation </b> </label>
&nbsp;&nbsp;&nbsp;&nbsp;<textarea style="font-size:14px;border:none;" type="text" rows="5">' .$device->consultation. '</textarea>
</div><br>
<div>
<label style="font-size:18px;color:#122F6B;" align="right"><b>Recovery Time/Cost </b> </label>
&nbsp;&nbsp;&nbsp;&nbsp;<textarea style="font-size:14px;border:none;" type="text" rows="5">' .$device->recover. '</textarea>
</div>
<div>
<label style="font-size:18px;color:#122F6B;" align="right"><b>Approval and Authority to Proceed  </b> </label><br>
<label style="font-size:14px;">We Approve the Job as described above, and authorize SPACE team to proceed </label><br>
</div>
<br>
<div>
<label style="font-size:13px;" align="right">Approved by  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:13px;">Date </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-size:13px;">Seal </label>
</div>
<br>
<div align="center" style="font-size:12px;">Email: mail@spacedatarecovery.com ,  Call: +968 963 12346 / 7</div>
</body>
</html>';
        return $output;
    }
}


