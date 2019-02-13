<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Backup;
use App\Models\DataJobs;
use App\Models\DataDevices;
use Illuminate\Support\Facades\Auth;
use App\User;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __constuct() 
    {
        parent::__constuct();
        $this->middleware('auth');
    }

    public function index()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $invoices = Invoice::all();
        return view('invoice/all_invoices', compact('invoices'));
    }

    public function unpaid()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $invoices = Invoice::all();
        return view('invoice/unpaid_invoices', compact('invoices'));
    }

    public function paid()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $invoices = Invoice::all();
        return view('invoice/paid_invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( !Auth::check() )
            return redirect()->route('login');
            
        $unique_id =  Date('Y:m:d').':'.rand();
        $jobIds = DB::table('data_jobs')->pluck('job_id');
        return view('invoice/add_invoice', compact('unique_id', 'jobIds'));
    }

    public function getDetailJob(Request $request) {
        $unique_id =  Date('Y:m:d').':'.rand();
        $jobIds = DB::table('data_jobs')->pluck('job_id'); 

        $invoice_job_id = $request->invoice_job_id;

        $invoiceJobDetail = DB::table('data_jobs')->where('job_id', $invoice_job_id)->first();
        $invoiceitems = DB::table('data_devices')->where('job_id', $invoice_job_id)->first();

        return response()->json(array(
            'response' => 'success',
            'invoiceJobDetail' => $invoiceJobDetail,
            'invoiceitems' => $invoiceitems
        ));
   
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
           
        $invoice_id = $request->invoice_id;
        $job_id = $request->invoice_job_id;
        $client_name = $request->client_name;
        $job_status = $request->job_status;
        $service_name = $request->service_name;
        $invoice_language = $request->invoice_language;
        $currency = $request->currency;
        $invoice_note = $request->invoice_note;
        
        $item_type = $request->item_type;
        $item_capacity = $request->item_capacity;
        $item_price = $request->item_price;
        $item_vat = $request->item_vat;
        $item_disaccount = $request->item_disaccount;
        $item_total_price = $request->item_total_price;   
      
        $invoice = new Invoice();
        $invoice->invoice_id = $invoice_id;
        $invoice->job_id = $job_id;
        $invoice->status = $job_status;
        $invoice->client_name = $client_name;
        $invoice->service = $service_name;
        $invoice->invoice_language = $invoice_language;
        $invoice->currency = $currency;
        $invoice->invoice_note = $invoice_note;
        $invoice->item_type = $item_type;
        $invoice->item_capacity = $item_capacity;
        $invoice->item_price = $item_price;
        $invoice->item_vat = $item_vat;
        $invoice->item_disaccount = $item_disaccount;
        $invoice->item_total_price = $item_total_price;
        $invoice->created_by = Auth::user()->username;
        $invoice->save();
        

        $backup_type = $request->backup_type;
        $backup_capacity = $request->backup_capacity;
        $backup_price = $request->backup_price;
        $backup_vat = $request->backup_vat;
        $backup_disaccount = $request->backup_disaccount;
        $backup_total_price = $request->backup_total_price;
   

        $backupItem = new Backup();
        $backupItem->invoice_id = $invoice_id;
        $backupItem->job_id = $job_id;
        $backupItem->type = $backup_type;
        $backupItem->capacity = $backup_capacity;
        $backupItem->price = $backup_price;
        $backupItem->vat = $backup_vat;
        $backupItem->disaccount = $backup_disaccount;
        $backupItem->total_price = $backup_total_price;

        $backupItem->save();

        return response()->json(array(
            'response' => 'success'           
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $invoice_id = DB::table('invoices')->where('id', $id)->value('invoice_id');
        $job_status = DB::table('invoices')->where('id', $id)->value('status');
        $job_id = DB::table('invoices')->where('id', $id)->value('job_id');
        $backupItem = Backup::where('job_id', $job_id)->first();
        return view('invoice/edit_invoice', compact('invoice', 'backupItem', 'invoice_id', 'job_id', 'job_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->update_invoice_id;
        $invoice = Invoice::where('id', $id)->first();

        $invoice_id = $request->invoice_id;
        $job_id = $request->update_job_id;
        $client_name = $request->client_name;
        $job_status = $request->update_job_status;
        $service_name = $request->service_name;
        $invoice_language = $request->invoice_language;
        $currency = $request->currency;
        $invoice_note = $request->invoice_note;
        
        $item_type = $request->item_type;
        $item_capacity = $request->item_capacity;
        $item_price = $request->item_price;
        $item_vat = $request->item_vat;
        $item_disaccount = $request->item_disaccount;
        $item_total_price = $request->item_total_price;


        
 
        $invoice->invoice_id = $invoice_id;
        $invoice->job_id = $job_id;
        $invoice->status = $job_status;
        $invoice->client_name = $client_name;
        $invoice->service = $service_name;
        $invoice->invoice_language = $invoice_language;
        $invoice->currency = $currency;
        $invoice->invoice_note = $invoice_note;
        $invoice->item_type = $item_type;
        $invoice->item_capacity = $item_capacity;
        $invoice->item_price = $item_price;
        $invoice->item_vat = $item_vat;
        $invoice->item_disaccount = $item_disaccount;
        $invoice->item_total_price = $item_total_price;
        $invoice->created_by = Auth::user()->username;

        $invoice->update();

        $backup_type = $request->backup_type;
        $backup_capacity = $request->backup_capacity;
        $backup_price = $request->backup_price;
        $backup_vat = $request->backup_vat;
        $backup_disaccount = $request->backup_disaccount;
        $backup_total_price = $request->backup_total_price;

        $backupItem = Backup::where('invoice_id', $invoice_id)->first();
        
        $backupItem->job_id = $job_id;
        $backupItem->invoice_id = $invoice_id;
        $backupItem->type = $backup_type;
        $backupItem->capacity = $backup_capacity;
        $backupItem->price = $backup_price;
        $backupItem->vat = $backup_vat;
        $backupItem->disaccount = $backup_disaccount;
        $backupItem->total_price = $backup_total_price;


        $backupItem->update();

        return response()->json(array(
            'response' => 'success'           
        ));      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Invoice::find($id)->delete();

        return redirect(route('allInvoices'));
    }

    //create invoice details/ create job
    public function storeJob(Request $request){
        $invoice_id = $request->invoice_id;
        $type = $request->type;
        $text = $request->text;
        $price = $request->price;
        $VAT = $request->VAT;
        $disaccount = $request->disaccount;
        $total_price = $request->total_price;

        $invoiceItem = new InvoiceItem();
        $invoiceItem->invoice_id = $invoice_id;
        $invoiceItem->type = $type;
        $invoiceItem->text = $text;
        $invoiceItem->price = $price;
        $invoiceItem->VAT = $VAT;
        $invoiceItem->disaccount = $disaccount;
        $invoiceItem->total_price = $total_price;
        $invoiceItem->save();

        return response()->json(['success'=>'Data is successfully added']);



    }

    public function reset() {
        return redirect()->back();
    }
}
