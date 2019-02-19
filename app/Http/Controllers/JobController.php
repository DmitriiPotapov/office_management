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
use App\Models\Quote;
use App\Models\Backup;
use App\User;
use App\Models\DataLogs;
use PDF;
use App\Models\Client;
use App\Models\Service;
use App\Models\DataInventory;
use App\Models\CompanyInfo;
use App\Models\FileLists;

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
        // while (1)
        // {
        //   $job->job_id = rand(4000, 9999);
        //   if (DataJobs::where('job_id', $job->job_id)->count() == 0)
        //     break;
        // }
        $job->job_id = 4000 + DataJobs::count();
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
        $job->services = $request->input('service_name');

        $job->save();

        $devices = new DataDevices();
        $devices->job_id = $job->job_id;
        $devices->category = $request->input('devcategory');
        $devices->type = $request->input('device_type1');
        $devices->role = $request->input('role1');
        $devices->manufacturer = $request->input('manufacturer');
        $devices->brand = $request->input('manufacturer');
        $devices->model = $request->input('model1');
        $devices->serial = $request->input('serial1');
        $devices->capacity = $request->input('capacity1');
        $devices->location = $request->input('location');
        $devices->status = "Received";

        $devices->save();

        $isBackup = $request->input('isBackup');
        if ($isBackup != "0")
        {
          $backupdevice = new DataDevices();
          $backupdevice->job_id = $job->job_id;
          $backupdevice->category = $request->input('backupCategory');
          $backupdevice->type = $request->input('backupType');
          $backupdevice->role = $request->input('backupRole');
          $backupdevice->manufacturer = $request->input('backupManufacturer');
          $backupdevice->brand = $request->input('backupManufacturer');
          $backupdevice->model = $request->input('backupModel');
          $backupdevice->serial = $request->input('backupSerial');
          $backupdevice->capacity = $request->input('backupCapacity');
          $backupdevice->location = $request->input('backupLocation');
          $backupdevice->status = "Received";

          $backupdevice->save();
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

        $jobNumber = $job->job_id;
        $password = $job->job_password;
        
        return view('job.successJob', compact('jobNumber', 'password'));
    }

    public function showAddJob($client_id)
    {
        if( !Auth::check() )
            return redirect()->route('login');
        $priorities = JobPriority::all();
        $types = DeviceType::all();
        $client = Client::find($client_id);
        $clients = Client::all();
        $services = Service::all();
        
        return view('job.addJob', compact('priorities', 'types', 'client_id', 'client','clients', 'services'));
    }

    public function showAllJob()
    {
        if( !Auth::check() )
            return redirect()->route('login');
        $jobs = DataJobs::all();
        $heads = 'All Jobs';
        return view('job.viewJobs', compact('jobs', 'heads'));
    }

    public function showAllPriorityJob()
    {
        if( !Auth::check() )
            return redirect()->route('login');
        $jobs = DataJobs::where('priority','!=','Standard')->get();
        $heads = 'Priority Jobs';
        return view('job.viewJobs', compact('jobs', 'heads'));
    }

    public function showOverview()
    {
        if( !Auth::check() )
            return redirect()->route('login');
        $jobs = DataJobs::all();
        return view('job.overView',compact('jobs'));
    }

    public function viewUrgent()
    {
        if( !Auth::check() )
            return redirect()->route('login');
        $jobs = DataJobs::where('priority', 'Emergency')
                          ->get();
        $heads = 'Urgent Jobs';
        return view('job.viewJobs', compact('jobs', 'heads'));
    }

    public function viewCompleted()
    {
        if( !Auth::check() )
            return redirect()->route('login');
        $jobs = DataJobs::where('status', 'Completed Successfully')
                        ->orwhere('status', 'Delivered/Unaid')
                        ->orwhere('status', 'Delivered/Paid')
                        ->get();
        $heads = 'Completed Jobs';
        return view('job.viewJobs', compact('jobs', 'heads'));return view('job.viewJobs', compact('jobs'));
    }

    public function viewPaymentPending()
    {
        if( !Auth::check() )
            return redirect()->route('login');
        $jobs = DataJobs::where('status', 'Delivered/Unpaid')
                        ->orwhere('status', 'Delivered/Partially Paid')
                        ->get();
        $heads = 'PaymentPending Jobs';
        return view('job.viewJobs', compact('jobs', 'heads'));
    }

    public function viewPaid()
    {
        if( !Auth::check() )
            return redirect()->route('login');
        $jobs = DataJobs::where('status', 'Delivered/Paid')->get();
        $heads = 'Paid Jobs';
        return view('job.viewJobs', compact('jobs', 'heads'));
    }

    public function showEditJob($job_id)
    {
        if( !Auth::check() )
            return redirect()->route('login');
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

        $quote = Quote::where('job_id', $job_id)->first();

        $inventoryIds = DataInventory::pluck('id');

        $cloneDevices = DataInventory::where('id', $job->clone_device)->get()->toArray();

        $fileLists = FileLists::where('job_id', $job_id)->get()->toArray();

        return view('job.editJob' , compact('job', 'client' ,'statuses','priorities', 'devices', 'comments', 'types', 'histories', 'engineers', 'logs', 'services', 'invoice', 'quote', 'inventoryIds', 'cloneDevices', 'fileLists'));
    }

    public function updateJob(Request $request)
    {
        $job_id = $request->input('seljob_id');
        $services = $request->input('services');
        $job_password = $request->input('job_password');
        $price = $request->input('price');

        $job = DataJobs::where('job_id', $job_id)->first();
        $invoice = Invoice::where('job_id', $job_id)->first();

        $oldStatus = $job->status;

        $job->services = $services;
        $job->job_password = $request->input('job_password');
        $job->assigned_engineer = $request->input('assigned_engineer');
        $job->price = $request->input('price');
        $job->status = $request->input('status');
        if ($invoice)
        {
          $invoice->status = $request->input('status');   
          $invoice->update();
        }
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
            

            $invoice = Invoice::where('job_id', $job_id)->get();
            
            foreach ($invoice as $item) {
              $item->status = $job->status;
              $item->update();
            }

            $devices = DataDevices::where('job_id', $job_id)->get();
            foreach ($devices as $device) {
              $device->status = $job->status;
              $device->update();

              $inventories = DataInventory::where('job_id', $job_id)->where('in_use', 1)->get();
              foreach ($inventories as $inventory) {
                $inventory->status = $job->status;
                $inventory->update();
              }
            }
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
        $job = DataJobs::where('job_id' , $device->job_id)->first();
        $device->type = $request->input('cr_device_name');
        $device->role = $request->input('cr_role');
        $device->manufacturer = $request->input('cr_manufacturer');
        $device->brand = $request->input('cr_manufacturer');
        $device->category = $request->input('cr_category');
        $device->model = $request->input('cr_model');
        $device->capacity = $request->input('cr_capacity');
        $device->serial = $request->input('cr_serial');
        $device->location = $request->input('cr_location');
        $device->note = $request->input('cr_note');
        $device->status = $job->status;
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

    public function addCloneDevice(Request $request)
    {

        $inventory_id = $request->input('sel_inventory_id');
        $job_id = $request->input('inventory_job_id');
        $job = DataJobs::where('job_id', $job_id)->first();
        $job->clone_device = $inventory_id;

        // $inventory = DataInventory::where('id', $inventory_id)->first();
        // if ($inventory->in_use == 1)
        // {
        //   return redirect()->back()->with('alert', ' That device is used in other job now!');
        // }
        // else
        // {
        //   $inventory->job_id = $request->input('inventory_job_id');
        //   $inventory->in_use = 1;
        //   $inventory->update();
        // }  
        $job->update();
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

    public function deleteCloneDevice($id)
    {
        $job = DataJobs::find($id);
        $job->clone_device = 0;
        // $inventory = DataInventory::find($id);
        // $inventory->in_use = 0;
        // $inventory->job_id = 0;
        $job->update();

        return redirect()->back();
    }

    public function updateDevice(Request $request)
    {
        $device_id = $request->input('device_id');
        $device = DataDevices::find($device_id);
        
        $diagnosis = $request->input('dev_diagnosis');
        $device->mediaDiagnosis = nl2br($diagnosis);

        $consultation = $request->input('dev_consultation');
        $device->mediaconsultation = nl2br($consultation);

        $recover = $request->input('dev_recover');
        $device->mediarecover = nl2br($recover);

        $device->diagnosis = $request->input('dev_diagnosis');
        $device->consultation = $request->input('dev_consultation');
        $device->recover = $request->input('dev_recover');
        $device->update();

        return redirect()->back();
    }

    public function updateMedia(Request $request)
    {
        $device_id = $request->input('media_id');
        $device = DataDevices::find($device_id);

        $device->PN = $request->input('PN');
        $device->dom = $request->input('dom');
        $device->interface = $request->input('interface');
        $device->dcm_mlc = $request->input('dcm_mlc');
        $device->PH = $request->input('PH');
        $device->heads = $request->input('heads');
        $device->platter_head = $request->input('Platters');
        $device->pcb_no = $request->input('pcb_no');
        $device->made_in = $request->input('madeIn');
        $device->encryption = $request->input('encryption');

        $device->PCB = $request->input('pcb');
        $device->motor = $request->input('motor');
        $device->firmware = $request->input('firmware');
        $device->r_w_heads = $request->input('r_w_heads');
        
        $device->update();

        return redirect()->back();
    }

    public function uploadAttach(Request $request)
    {
      $job_id = $request->input('attachJobId');
      $file = $request->file('attach');
      if ($file) {
        $fileList = new FileLists();
        $fileList->job_id = $job_id;
        $fileList->file_name = $file->getClientOriginalName();

        $date = date('Y-m-d');
        $date = md5($date);

        $originalFile = $date.'_'.$file->getClientOriginalName();
        
        $fileList->size = $file->getClientSize();
        $fileList->uploaded_by = Auth::user()->username;

        $destionationPath = 'public/uploads/';
        $file->move($destionationPath, $originalFile);

        $fileList->full_path = $originalFile;

        $fileList->save();
  
        return redirect()->back();
      }

    }

    public function downloadUploadFile($id)
    {
      $file = FileLists::find($id);
      $file_path = 'public/uploads/'.$file->full_path;
      return response()->download($file_path, $file->file_name);
    }

    public function addmissionForm($job_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_job_data_to_admission_form($job_id));
        $pdf->stream();
        $file_path = 'CheckIn #'.$job_id.'.pdf';
        return $pdf->download($file_path);

    }

    public function checkoutForm($job_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_job_data_to_checkout_form($job_id));
        $pdf->stream();
        $file_path = 'CheckOut #'.$job_id.'.pdf';
        return $pdf->download($file_path);
    }
    
    public function generateInvoice($job_id)
    {
        $invoice = Invoice::where('job_id', $job_id)->first();
        if($invoice)
        {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->convert_job_data_to_invoice($job_id));
            $pdf->stream();
            $file_path = 'Invoice #'.$job_id.'.pdf';
            return $pdf->download($file_path);
        }
        else
        {
            return redirect()->back()->with('alert', ' No invoce data!');
        }
    }

    public function generateInvoiceTemplate($job_id, $item_price, $item_vat, $discount, $item_total_price, $backup_brand, $backup_serial, $backup_capacity, $backup_price, $backup_vat, $backup_discount, $backup_total_price)
    {
      $job = DataJobs::where('job_id',$job_id)->first();
      $client = Client::find($job->client_id);
      $devices = DataDevices::where('job_id', $job_id)->where('role', 'Patient')->first();
      $vat_price = $item_price * $item_vat / 100.0;

      $pdf = PDF::loadView('job.invoicepdf', compact('job_id','job', 'client', 'devices', 'vat_price', 'item_total_price' , 'item_price', 'item_vat', 'discount', 'backup_brand', 'backup_serial', 'backup_capacity', 'backup_price', 'backup_vat', 'backup_discount', 'backup_total_price'));
      $file_path = 'Invoice #'.$job_id.'.pdf';
      return $pdf->download($file_path);
        
    }

    public function generateInvoiceViewTemplate($job_id, $item_price, $item_vat, $discount, $item_total_price, $backup_brand, $backup_serial, $backup_capacity, $backup_price, $backup_vat, $backup_discount, $backup_total_price)
    {
      $job = DataJobs::where('job_id',$job_id)->first();
      $client = Client::find($job->client_id);
      $devices = DataDevices::where('job_id', $job_id)->where('role', 'Patient')->first();
      $vat_price = $item_price * $item_vat / 100.0;

      $pdf = PDF::loadView('job.invoicepdf', compact('job_id','job', 'client', 'devices', 'vat_price', 'item_total_price' , 'item_price', 'item_vat', 'discount', 'backup_brand', 'backup_serial', 'backup_capacity', 'backup_price', 'backup_vat', 'backup_discount', 'backup_total_price'));
      $file_path = 'Invoice #'.$job_id.'.pdf';
      return $pdf->stream();
    }

    public function generateQuoteTemplate($job_id, $price, $discount, $total_price, $brand, $serial)
    {
      $job = DataJobs::where('job_id',$job_id)->first();
      $client = Client::find($job->client_id);
      $devices = Quote::where('job_id', $job_id)->get()->toArray();

      $pdf = PDF::loadView('job.quotepdf', compact('job_id','job', 'client', 'devices', 'price', 'discount', 'total_price', 'brand', 'serial'));
      $file_path = 'Quote #'.$job_id.'.pdf';
      return $pdf->download($file_path);
    }

    public function generateQuoteViewTemplate($job_id, $price, $discount, $total_price, $brand, $serial)
    {
      $job = DataJobs::where('job_id',$job_id)->first();
      $client = Client::find($job->client_id);
      $devices = Quote::where('job_id', $job_id)->get()->toArray();

      $pdf = PDF::loadView('job.quotepdf', compact('job_id','job', 'client', 'devices', 'price', 'discount', 'total_price', 'brand', 'serial'));
      $file_path = 'Quote #'.$job_id.'.pdf';
      return $pdf->stream();
    }

    public function generateQuote($job_id)
    {
        $invoice = Quote::where('job_id', $job_id)->first();
        if($invoice)
        {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->convert_job_data_to_quote($job_id));
            $pdf->stream();
            $file_path = 'Quote #'.$job_id.'.pdf';
            return $pdf->download($file_path);
        }
        else
        {
            return redirect()->back()->with('alert', ' No quote data!');
        }
    }

    public function generateMediaReport($job_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_job_data_to_media($job_id));
        $pdf->stream();
        $file_path = 'Report #'.$job_id.'.pdf';
        return $pdf->download($file_path);
    }

    function convert_job_data_to_admission_form($job_id)
    {
        $job = DataJobs::where('job_id',$job_id)->first();
        $client = Client::find($job->client_id);
        $company_id = 1;
        $company = CompanyInfo::find($company_id);
        $output = '
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>CheckIn #'.$job_id.'</title>
  <style>
  body {
    font-family: Times New Roman;
    font-size: 0.9em;
    margin-top:25px;
    margin-left:45px;
    margin-right:45px;
    margin-bottom:35px;
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
  border: 0px solid #dddddd;
  padding: 8px;
  }

  td.newtable, th.newtable {
    border: 0px solid #dddddd;
    padding: 2px;
  }

  </style>
</head>
<body>
  <div>
    <img align="left" src="assets/images/logo-icon4.png" width="280" height="80" />
    <div align="right">
      <b><label style="font-size:12px;">'.$company->address.'</label><br>
      <label style="font-size:12px;">'.$company->city.', '.$company->country.'</label><br></b>
      <label style="font-size:12px;">'.$company->phone.'</label><img style="margin-top:2px;" src="assets/images/icon-tel.png" width="14" height="12" /><br>
      <label style="font-size:12px;">'.$company->email.'</label><img style="margin-top:2px;" src="assets/images/icon-mail.png" width="14" height="12" /><br>
      <label style="font-size:12px;">'.$company->website.'</label><img style="margin-top:2px;" src="assets/images/icon-space.png" width="14" height="12" /><br>
    </div>
  </div>
  <br><br><br><br>
  <div>
    <img align="left" src="assets/images/check-in.png" width="280" height="75" />
    <div align="right">
      <b><label style="font-size:16px;">'.$client->client_name.'</label><br></b>
      <label style="font-size:16px;">'.$client->company.'</label><br>
      <label style="font-size:16px;">'.$client->street.'</label><br>
      <label style="font-size:16px;">'.$client->country.'</label><br>
    </div>
  </div>
  <br><br>
  <div>
    <table style="border-bottom:0pt solid grey;width:100%">
      <tbody style="font-size:15px;margin:auto;">
        <tr>
          <td class="newtable" width="80">#CaseID</td>
          <td class="newtable" width="80">#Date</td>
          <td class="newtable" width="80">#Service</td>
          <td class="newtable" align="right">'.$client->phone_value.'</td>
        </tr>
        <tr>
          <td class="newtable" width="80"><b>'.$job->job_id.'</b></td>
          <td class="newtable" width="80"><b>'.date_format($job->created_at,"d/m/Y").'</b></td>
          <td class="newtable" width="80"><b>'.$job->services.'</b></td>
          <td class="newtable" align="right"><b>'.$client->email_value.'</b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <br><br><br>
  <table >
      <thead style="border-bottom:3pt solid black;color:#3092C3;">
          <tr >
              <td><b>#</b></td>
              <td><b>Brand</b></td>
              <td><b>Category</b></td>
              <td><b>Capacity</b></td>
              <td><b>Serial No</b></td>
          </tr>
      </thead>
      <tbody style="border-bottom:0pt solid grey;">';

    $devices = DataDevices::where('job_id', $job_id)->get()->toArray();
    $i = 1;
    foreach($devices as $item)
    {
      if (($item["role"] == "Patient") || ($item["role"] == "Data"))
      {
        $output .= '
        <tr>
        <td>'.number_format($i).'</td>
        <td>'.$item["brand"].'</td>
        <td>'.$item["category"].'</td>
        <td>'.$item["capacity"].'</td>
        <td>'.$item["serial"].'</td>
        </tr>';
        $i ++;
      }
    }
    $output .=
'     </tbody>
    </table>
  </div>
  <hr /><br><br><br><br><br><br><br><br><br><br><br>
  <div>
    <div>
      <table style="border-bottom:0pt solid grey;width:100%">
        <tbody style="font-size:15px;">
          <tr>
            <td class="newtable" style="font-size:17px;"><b>TRACK YOUR SERVICE</b></td>
            <td class="newtable" style="font-size:17px;" align="right">Prepared By</td>
          </tr>
          <tr>
            <td class="newtable"><label style="font-size:12px;">To get the latest status of your service</label><br></td>
            <td class="newtable" style="font-size:17px;" align="right">#'.$job->user_name.'</td>
          </tr>
          <tr>
            <td class="newtable"><label style="font-size:12px;">please visit the following link:</label><br></td>
          </tr>
          <tr>
            <td class="newtable"><label style="font-size:12px;color:#3092C3;">www.spacedatarecover.com/Jobtrack</label><br></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <br>
  <div align="left">
    <label style="font-size:12px;">User ID: '.$job->job_id.'</label><br>
    <label style="font-size:12px;">Password: '.$job->job_password.'</label><br>
  </div>
  <div align="right">
    <b><label style="font-size:22px;color:#3092C3;">Thank you</label><br></b>
    <b><label style="font-size:22px;color:#3092C3;">For Submitting your Case!</label><br></b>
  </div>
  </div>
  </body>
</html>';
        return $output;
    }

    function convert_job_data_to_checkout_form($job_id)
    {
      $job = DataJobs::where('job_id',$job_id)->first();
      $client = Client::find($job->client_id);
      $company = CompanyInfo::find(1);
      $output = '
      <!DOCTYPE HTML>
      <html lang="en">
      <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <title>CheckOut #'.$job_id.'</title>
        <style>
        body {
          font-family: Times New Roman;
          font-size: 0.9em;
          margin-top:25px;
          margin-left:45px;
          margin-right:45px;
          margin-bottom:35px;
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
        border: 0px solid #dddddd;
        padding: 8px;
        }

        td.newtable, th.newtable {
          border: 0px solid #dddddd;
          padding: 2px;
        }
      
        </style>
      </head>
      <body>
        <div>
          <img align="left" src="assets/images/logo-icon4.png" width="280" height="80" />
          <div align="right">
            <b><label style="font-size:12px;">'.$company->address.'</label><br>
            <label style="font-size:12px;">'.$company->city.', '.$company->country.'</label><br></b>
            <label style="font-size:12px;">'.$company->phone.'</label><img style="margin-top:2px;" src="assets/images/icon-tel.png" width="14" height="12" /><br>
            <label style="font-size:12px;">'.$company->email.'</label><img style="margin-top:2px;" src="assets/images/icon-mail.png" width="14" height="12" /><br>
            <label style="font-size:12px;">'.$company->website.'</label><img style="margin-top:2px;" src="assets/images/icon-space.png" width="14" height="12" /><br>
          </div>
        </div>
        <br><br><br><br>
        <div>
          <img align="left" src="assets/images/check-out.png" width="280" height="65" />
          <div align="right">
            <b><label style="font-size:16px;">'.$client->client_name.'</label><br></b>
            <label style="font-size:16px;">'.$client->company.'</label><br>
            <label style="font-size:16px;">'.$client->street.'</label><br>
            <label style="font-size:16px;">'.$client->country.'</label><br>
          </div>
        </div>
        <br><br>
        <div>
          <table style="border-bottom:0pt solid grey;width:100%">
            <tbody style="font-size:15px;margin:auto;">
              <tr>
                <td class="newtable" width="80">#CaseID</td>
                <td class="newtable" width="80">#Date</td>
                <td class="newtable" width="80">#Service</td>
                <td class="newtable" align="right">'.$client->phone_value.'</td>
              </tr>
              <tr>
                <td class="newtable" width="80"><b>'.$job->job_id.'</b></td>
                <td class="newtable" width="80"><b>'.date_format($job->created_at,"d/m/Y").'</b></td>
                <td class="newtable" width="80"><b>'.$job->services.'</b></td>
                <td class="newtable" align="right"><b>'.$client->email_value.'</b></td>
              </tr>
            </tbody>
          </table>
        </div>
        <br><br><br>
        <table >
            <thead style="border-bottom:3pt solid black;color:#3092C3;">
                <tr >
                    <td><b>#</b></td>
                    <td><b>Brand</b></td>
                    <td><b>Category</b></td>
                    <td><b>Capacity</b></td>
                    <td><b>Serial No</b></td>
                </tr>
            </thead>
            <tbody style="border-bottom:0pt solid grey;">';
      
          $devices = DataDevices::where('job_id', $job_id)->get()->toArray();
          $i = 1;
          foreach($devices as $item)
          {
            if (($item["role"] == "Patient") || ($item["role"] == "Data"))
            {
              $output .= '
              <tr>
              <td>'.number_format($i).'</td>
              <td>'.$item["brand"].'</td>
              <td>'.$item["category"].'</td>
              <td>'.$item["capacity"].'</td>
              <td>'.$item["serial"].'</td>
              </tr>';
              $i ++;
            }
          }
          $output .=
      '     </tbody>
          </table>
        </div>
        <hr /><br><br><br><br><br><br><br><br><br><br><br><br>
        <div>
          <div>
            <table style="border-bottom:0pt solid grey;width:100%">
              <tbody style="font-size:15px;">
                <tr>
                  <td class="newtable"><b><label style="font-size:15px;">COLLECTED BY</label></b></td>
                  <td class="newtable" style="font-size:17px;" align="right">Prepared By</td>
                </tr>
                <tr>
                  <td class="newtable"><label style="font-size:12px;">Name:</label></td>
                  <td class="newtable" style="font-size:17px;" align="right">#'.$job->user_name.'</td>
                </tr>
                <tr>
                  <td class="newtable"><label style="font-size:12px;">Contact No:</label></td>
                </tr>
                <tr>
                  <td class="newtable"><label style="font-size:12px;">Civil ID:</label></td>
                </tr>
                <tr>
                  <td class="newtable"><label style="font-size:12px;">Signature:</label></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <br>
        <div align="right">
          <b><label style="font-size:22px;color:#3092C3;">Thank you</label><br></b>
          <b><label style="font-size:22px;color:#3092C3;">For Your Business!</label><br></b>
        </div>
        </div>
        </body>
      </html>';
        return $output;
    }
    function convert_job_data_to_invoice($job_id)
    {
      $job = DataJobs::where('job_id',$job_id)->first();
      $invoice = Invoice::where('job_id', $job_id)->first();
      $backup = Backup::where('job_id', $job_id)->first();
      $company = CompanyInfo::find(1);
      $client = Client::find($job->client_id);
      $total_price = $invoice->item_total_price + ($backup ? $backup->total_price : 0);
      $output = '
      <!DOCTYPE HTML>
      <html lang="en">
      <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <title>Invoice #'.$job_id.'</title>
        <style>
        body {
          font-family: Times New Roman;
          font-size: 0.9em;
          margin-top:25px;
          margin-left:45px;
          margin-right:45px;
          margin-bottom:15px;
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
        border: 0px solid #dddddd;
        padding: 8px;
        }

        td.newtable, th.newtable {
          border: 0px solid #dddddd;
          padding: 2px;
        }
      
        </style>
      </head>
      <body>
        <div>
          <img align="left" src="assets/images/logo-icon4.png" width="280" height="80" />
          <div align="right">
            <b><label style="font-size:12px;">'.$company->address.'</label><br>
            <label style="font-size:12px;">'.$company->city.', '.$company->country.'</label><br></b>
            <label style="font-size:12px;">'.$company->phone.'</label><img style="margin-top:2px;" src="assets/images/icon-tel.png" width="14" height="12" /><br>
            <label style="font-size:12px;">'.$company->email.'</label><img style="margin-top:2px;" src="assets/images/icon-mail.png" width="14" height="12" /><br>
            <label style="font-size:12px;">'.$company->website.'</label><img style="margin-top:2px;" src="assets/images/icon-space.png" width="14" height="12" /><br>
          </div>
        </div>
        <br><br><br><br>
        <div>
          <img align="left" src="assets/images/invoice.png" width="280" height="80" />
          <div align="right">
            <b><label style="font-size:17px;">Bill To</label></b><br>
            <label style="font-size:16px;">'.$client->client_name.'</label><br>
            <label style="font-size:16px;">'.$client->company.'</label><br>
            <label style="font-size:16px;">'.$client->phone_value.'</label>
          </div>
        </div>
        <table style="border-bottom:0pt solid grey;width:100%">
          <tbody style="font-size:15px;">
            <tr>
              <td class="newtable"><label style="font-size:15px;">#Invoice</label></td>
              <td class="newtable" style="font-size:15px;" >#Date</td>
              <td class="newtable" style="font-size:16px;" align="right">'.$client->street.'</td>
            </tr>
            <tr>
              <td class="newtable"><b><label style="font-size:15px;">'.$job->job_id.'</label></b></td>
              <td class="newtable" style="font-size:15px;" ><b>'.date_format($job->created_at,"d/m/Y").'</b></td>
              <td class="newtable" style="font-size:16px;" align="right">'.$client->country.'</td>
            </tr>
          </tbody>
        </table>
        <br><br>
        <table >
            <thead style="border-bottom:3pt solid black;color:#3092C3;">
                <tr >
                    <td><b>#</b></td>
                    <td><b>Task Desciription</b></td>
                    <td><b>Rate</b></td>
                    <td><b>Qty</b></td>
                    <td><b>Total</b></td>
                </tr>
            </thead>
            <tbody style="border-bottom:0pt solid grey;">';
      
          $devices = DataDevices::where('job_id', $job_id)->get()->toArray();
          $i = 1;
          $total_price = 0;
          foreach($devices as $item)
          {
            if ($item["role"] == "Patient") {
              $total_price += $invoice->item_total_price;
              $output .= '
              <tr>
              <td>'.number_format($i).'</td>
              <td width="200">'.$job["services"].'-'.$item["category"].'-'.$item["brand"].'-'.$item["serial"].'</td>
              <td>RO '.number_format($invoice->item_total_price,3,".","").'</td>
              <td>1</td>
              <td>RO '.number_format($invoice->item_total_price,3,".","").'</td>
              </tr>';
              $i ++;
            }
          }
          if ($backup) {
            {
              {
                $total_price += $backup["total_price"];
                $output .= '
                <tr>
                <td>'.number_format($i).'</td>
                <td width="200"> Backup Device - '.$backup["brand"].'-'.$backup["type"].'-'.$backup["capacity"].'</td>
                <td>RO '.number_format($backup["total_price"],3,".","").'</td>
                <td>1</td>
                <td>RO '.number_format($backup["total_price"],3,".","").'</td>
                </tr>';
                $i ++;
              }
            }
          }
          $vat_price = $total_price * $invoice["item_vat"] / 100.0;
          $real_price = $total_price + $vat_price;
          $output .=
      '     </tbody>
          </table>
        </div>
        <hr /><br>
        <div align="right">
          <label style="font-size:16px;">Sub Total</label>
          <label style="font-size:16px;padding-left:8em;">RO '.number_format($total_price,3,".","").'</label><br>
        </div><br>
        <div align="right">
          <label style="font-size:16px;">VAT '.number_format($invoice->item_vat,2,".","").'%</label>
          <label style="font-size:16px;padding-left:8em;">RO '.number_format($vat_price,3,".","").'</label><br>
        </div><br>
        <div align="right" >
          <label style="background-color:#1483BB;color:white;font-size:20px;margin-top:5px;margin-bottom:5px;">Grand Total</label>
          <label style="background-color:#1483BB;color:white;font-size:20px;padding-left:4em;padding-top:5px;padding-bottom:5px;">RO '.number_format($real_price,3,".","").'</label><br>
        </div>
        <br><br><br><br>
        <div>
          <div>
            <table style="border-bottom:0pt solid grey;width:100%">
              <tbody style="font-size:15px;">
                <tr>
                  <td class="newtable"><b><label style="font-size:17px;font-family: Times New Roman;">Payment Methods</label></b></td>
                  <td class="newtable" style="font-size:17px;" align="right">Prepared By</td>
                </tr>
                <tr>
                  <td class="newtable"><label style="font-size:12px;">*We accept Cash, Visa, Master Card & Cheque</label></td>
                  <td class="newtable" style="font-size:17px;" align="right">#'.$job->user_name.'</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <br>
        <div align="left">
          <label style="font-size:12px;">Please make cheque payment to:</label><br>
          <b><label style="font-size:12px;color:#3092C3;">Salman Mohammad Ashraf Trdg & Cotg.</label><br></b>
          <label style="font-size:12px;">217-011519-001 | HSBC BANK OMAN S.A.O.G</label><br>
        </div>
        <br><br>
        <div align="left">
          <b><label style="font-size:15px;font-family: Times New Roman;">TERMS & CONDITION</label><br></b>
          <label style="font-size:12px;">No refund for any resason after delivery</label><br>
        </div>
        <div align="right">
          <b><label style="font-size:22px;color:#3092C3;">Thank you</label><br></b>
          <b><label style="font-size:22px;color:#3092C3;">For Your Business!</label><br></b>
        </div>
        </div>
        </body>
      </html>';
        return $output;
    }
    function convert_job_data_to_quote($job_id)
    {
      $job = DataJobs::where('job_id',$job_id)->first();
      $invoice = Quote::where('job_id', $job_id)->first();
      $company = CompanyInfo::find(1);
      $client = Client::find($job->client_id);
      $output = '
      <!DOCTYPE HTML>
    <html lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
      <title>Quote '.$job_id.'</title>
      <style>
      body {
        font-family: Times New Roman;
        font-size: 0.9em;
        margin-top:25px;
        margin-left:45px;
        margin-right:45px;
        margin-bottom:10px;
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
      border: 0px solid #dddddd;
      padding: 8px;
      }
      
      td.newtable, th.newtable {
        border: 0px solid #dddddd;
        padding: 2px;
      }
    
      </style>
    </head>
    <body>
      <div>
        <img align="left" src="assets/images/logo-icon4.png" width="280" height="80" />
        <div align="right">
          <b><label style="font-size:12px;">'.$company->address.'</label><br>
          <label style="font-size:12px;">'.$company->city.', '.$company->country.'</label><br></b>
          <label style="font-size:12px;">'.$company->phone.'</label><img style="margin-top:2px;" src="assets/images/icon-tel.png" width="14" height="12" /><br>
          <label style="font-size:12px;">'.$company->email.'</label><img style="margin-top:2px;" src="assets/images/icon-mail.png" width="14" height="12" /><br>
          <label style="font-size:12px;">'.$company->website.'</label><img style="margin-top:2px;" src="assets/images/icon-space.png" width="14" height="12" /><br>
        </div>
      </div>
      <br><br><br><br>
      <div>
        <img align="left" src="assets/images/quote.png" width="240" height="70" />
        <div align="right">
          <b><label style="font-size:17px;">Quote To</label></b><br>
          <label style="font-size:16px;">'.$client->client_name.'</label><br>
          <label style="font-size:16px;">'.$client->company.'</label><br>
          <label style="font-size:16px;">'.$client->phone_value.'</label>
        </div>
      </div>
      <table style="border-bottom:0pt solid grey;width:100%">
        <tbody style="font-size:15px;">
          <tr>
            <td class="newtable"><label style="font-size:15px;">#Quote</label></td>
            <td class="newtable" style="font-size:15px;" >#Date</td>
            <td class="newtable" style="font-size:16px;" align="right">'.$client->street.'</td>
          </tr>
          <tr>
            <td class="newtable"><b><label style="font-size:15px;">'.$job->job_id.'</label></b></td>
            <td class="newtable" style="font-size:15px;" ><b>'.date_format($job->created_at,"d/m/Y").'</b></td>
            <td class="newtable" style="font-size:16px;" align="right">'.$client->country.'</td>
          </tr>
        </tbody>
      </table>
      <br><br>
      <table >
          <thead style="border-bottom:3pt solid black;color:#3092C3;">
              <tr >
                  <td><b>#</b></td>
                  <td><b>Task Desciription</b></td>
                  <td><b>Rate</b></td>
                  <td><b>Qty</b></td>
                  <td><b>Total</b></td>
              </tr>
          </thead>
          <tbody style="border-bottom:0pt solid grey;">';
    
        $devices = Quote::where('job_id', $job_id)->get()->toArray();
        $i = 1;
        foreach($devices as $item)
        {
            $output .= '
            <tr>
            <td>'.number_format($i).'</td>
            <td width="200">'.$item["item_brand"].'-'.$item["item_serial"].'-'.$item["item_type"].'-'.$item["item_capacity"].'</td>
            <td>RO '.number_format($item["item_total_price"],3,".","").'</td>
            <td>1</td>
            <td>RO '.number_format($item["item_total_price"],3,".","").'</td>
            </tr>';
            $i ++;
        }
        $output .=
    '     </tbody>
        </table>
      </div>
      <hr /><br>
      <div align="right">
        <label style="font-size:16px;">Sub Total</label>
        <label style="font-size:16px;padding-left:8em;">RO '.number_format($invoice->item_total_price,3,".","").'</label><br>
      </div><br>
      <div align="right" >
        <label style="background-color:#1483BB;color:white;font-size:20px;margin-top:5px;margin-bottom:5px;">Grand Total</label>
        <label style="background-color:#1483BB;color:white;font-size:20px;padding-left:4em;padding-top:5px;padding-bottom:5px;">RO '.number_format($invoice->item_total_price,3,".","").'</label><br>
      </div>
      <br><br><br><br><br>
      <div>
        <div>
          <table style="border-bottom:0pt solid grey;width:100%">
            <tbody style="font-size:15px;">
              <tr>
                <td class="newtable"><b><label style="font-size:17px;font-family: Times New Roman;">Payment Methods</label></b></td>
                <td class="newtable" style="font-size:17px;" align="right">Prepared By</td>
              </tr>
              <tr>
                <td class="newtable"><label style="font-size:12px;">*We accept Cash, Visa, Master Card & Cheque</label></td>
                <td class="newtable" style="font-size:17px;" align="right">#'.$job->user_name.'</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <div align="left">
        <label style="font-size:12px;">Please make cheque payment to:</label><br>
        <b><label style="font-size:12px;color:#3092C3;">Salman Mohammad Ashraf Trdg & Cotg.</label><br></b>
        <label style="font-size:12px;">217-011519-001 | HSBC BANK OMAN S.A.O.G</label><br>
      </div>
      <br>
      <div align="left">
        <b><label style="font-size:15px;font-family: Times New Roman;">TERMS & CONDITION</label><br></b>
        <label style="font-size:12px;">50% advance to start the service</label><br>
        <label style="font-size:12px;">50% upon completion</label><br>
      </div>
      <div align="right">
        <b><label style="font-size:22px;color:#3092C3;">Thank you</label><br></b>
        <b><label style="font-size:22px;color:#3092C3;">For Your Enquiry!</label><br></b>
      </div>
      </div>
      </body>
    </html>';
        return $output;
    }
    function convert_job_data_to_media($job_id)
    {
        $job = DataJobs::where('job_id',$job_id)->first();
        $client = Client::find($job->client_id);
        $device = DataDevices::where('job_id', $job_id)->first();
        $company = CompanyInfo::find(1);
        $output = '
  <!DOCTYPE HTML>
  <html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Report #'.$job_id.'</title>
    <style>
    body {
      font-family: Times New Roman;
      font-size: 0.9em;
      margin-top:25px;
      margin-left:45px;
      margin-right:45px;
      margin-bottom:35px;
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
    border: 0px solid #dddddd;
    padding: 2px;
    }

    </style>
  </head>
  <body>
    <div>
      <img align="left" src="assets/images/logo-icon4.png" width="280" height="80" />
      <div align="right">
        <b><label style="font-size:12px;">'.$company->address.'</label><br>
        <label style="font-size:12px;">'.$company->city.', '.$company->country.'</label><br></b>
        <label style="font-size:12px;">'.$company->phone.'</label><img style="margin-top:2px;" src="assets/images/icon-tel.png" width="14" height="12" /><br>
        <label style="font-size:12px;">'.$company->email.'</label><img style="margin-top:2px;" src="assets/images/icon-mail.png" width="14" height="12" /><br>
        <label style="font-size:12px;">'.$company->website.'</label><img style="margin-top:2px;" src="assets/images/icon-space.png" width="14" height="12" /><br>
      </div>
    </div>
    <br><br><br>
    <div>
      <img align="left" src="assets/images/report.png" width="280" height="75" />
      <div align="right">
        <b><label style="font-size:16px;">'.$client->client_name.'</label><br></b>
        <label style="font-size:16px;">'.$client->company.'</label><br>
        <label style="font-size:16px;">'.$client->street.'</label><br>
        <label style="font-size:16px;">'.$client->country.'</label><br>
      </div>
    </div>
    <br>
    <div>
      <table style="border-bottom:0pt solid grey;width:100%">
        <tbody style="font-size:15px;margin:auto;">
          <tr>
            <td width="80">#CaseID</td>
            <td width="80">#Date</td>
            <td width="80">#Service</td>
            <td align="right">'.$client->phone_value.'</td>
          </tr>
          <tr>
            <td width="80"><b>'.$job->job_id.'</b></td>
            <td width="80"><b>'.date_format($job->created_at,"d/m/Y").'</b></td>
            <td width="80"><b>'.$job->services.'</b></td>
            <td align="right"><b>'.$client->email_value.'</b></td>
          </tr>
        </tbody>
      </table>
    </div>
    <br><br><br>
    <div style="margin-bottom:10px;">
      <b><label style="font-size:18px;color:#1483BB;margin-bottom:2px;">MEDIA EVALUATION REPORT</label><br>
    </div>
    <div style="border-bottom: 2pt solid black;margin-bottom:5px;">
    </div>
    <br>
    <div>
      <table style="border-bottom:0pt solid grey;">
        <thead style="color:#1483BB;">
          <tr>
            <td>#MEDIA DETAILS</td>
            <td>#MEDIA DETAILS</td>
            <td>#MEDIA STATUS</td>
          </tr>
        </thead>
        <tbody style="font-size:13px;margin:auto;">
        <tr>
          <td>Category: '.$device->category.'</td>
          <td>Interface: '.$device->interface.'</td>
          <td>PCB: '.$device->PCB.'</td>
        </tr>
        <tr>
          <td>Media Type: '.$device->type.'</td>
          <td>Platter: '.$device->platter_head.'</td>
          <td>MOTOR: '.$device->motor.'</td>
        </tr>
        <tr>
          <td>Brand: '.$device->brand.'</td>
          <td>Heads: '.$device->heads.'</td>
          <td>Firmware: '.$device->firmware.'</td>
        </tr>
        <tr>
          <td>Capacity: '.$device->capacity.'</td>
          <td>Made In: '.$device->made_in.'</td>
          <td>ENCRYPTION: '.$device->encryption.'</td>
        </tr>
        <tr>
          <td>Serial No: '.$device->serial.'</td>
          <td>DOM: '.$device->dom.'</td>
          <td>HEADS: '.$device->r_w_heads.'</td>
        </tr>
        <tr>
          <td>Model: '.$device->model.'</td>
          <td></td>
          <td></td>
        </tr>
        </tbody>
      </table>
    </div>
    <br><br>';
    $output .= '
    <div align="left" style="font-size:13px;font-family: arial, sans-serif;">
      <label style="font-size:15px;color:#1483BB;">#ANALYSIS</label><br>
      '.$device->mediaDiagnosis.'
    </div>
    <br>
    <div align="left" style="font-size:13px;font-family: arial, sans-serif;">
      <label style="font-size:15px;color:#1483BB;">#CONSULTATION</label><br>
      '.$device->mediaConsultation.'
    </div>
    <br>
    <div align="left" style="font-size:13px;font-family: arial, sans-serif;">
      <label style="font-size:15px;color:#1483BB;">#RECOVER TIME</label><br>
      '.$device->mediaRecover.'
    </div>
    <br>
    <div align="right">
      <b><label style="font-size:16px;">REPORT BY</label><br></b>
      <b><label style="font-size:16px;">#'.$job->user_name.'</label><br></b>
    </div>
    </body>
  </html>';
        return $output;
    }
}


