<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Quote;

class QuoteController extends Controller
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
        $quotes = Quote::all();
        return view('quote/all_quotes', compact('quotes'));
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
            return view('quote/add_quote', compact('unique_id', 'jobIds'));
    }


    public function getDetailJob(Request $request){
        $quote_job_id = $request->quote_job_id;

        $quoteJobDetail = DB::table('data_jobs')->where('job_id', $quote_job_id)->first();
        $quoteitems = DB::table('data_devices')->where('job_id', $quote_job_id)->where('role', 'Patient')->first();

        

        return response()->json(array(
            'response' => 'success',
            'quoteJobDetail' => $quoteJobDetail,
            'quoteitems' => $quoteitems
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
        $quote_id = $request->quote_id;
        $job_id = $request->quote_job_id;
        $client_name = $request->client_name;
        $job_status = $request->job_status;
        $service_name = $request->service_name;
        $quote_language = $request->quote_language;
        $currency = $request->currency;
        $quote_note = $request->quote_note;
        
        $item_type = $request->item_type;
        $item_capacity = $request->item_capacity;
        $item_price = $request->item_price;

        $item_disaccount = $request->item_disaccount;
        $item_brand = $request->item_brand;
        $item_serial = $request->item_serial;
        $item_total_price = $request->item_total_price;
                    
        $quote = new Quote();
        $quote->quote_id = $quote_id;
        $quote->job_id = $job_id;
        $quote->status = $job_status;
        $quote->client_name = $client_name;
        $quote->service = $service_name;
        $quote->quote_language = $quote_language;
        $quote->currency = $currency;
        $quote->quote_note = $quote_note;
        $quote->item_type = $item_type;
        $quote->item_brand = $item_brand;
        $quote->item_serial = $item_serial;
        $quote->item_capacity = $item_capacity;
        $quote->item_price = $item_price;

        $quote->item_disaccount = $item_disaccount;
        $quote->item_total_price = $item_total_price;
        $quote->created_by = Auth::user()->username;
        $quote->save();

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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        // $quoteJobDetail = DB::table('data_jobs')->where('job_id', $quote_job_id)->first();
        // $quoteitems = DB::table('data_devices')->where('job_id', $quote_job_id)->first();
        $quote = Quote::where('id', $id)->first();
        $job_id = Quote::where('id', $id)->value('job_id');
        return view('quote.edit_quote', compact('quote', 'job_id'));
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
        $id = $request->update_quote_id;
        $quote = Quote::where('id', $id)->first();

        $quote_id = $request->quote_id;
        $job_id = $request->quote_job_id;
        $client_name = $request->client_name;
        $job_status = $request->job_status;
        $service_name = $request->service_name;
        $quote_language = $request->quote_language;
        $currency = $request->currency;
        $quote_note = $request->quote_note;
        
        $item_type = $request->item_type;
        $item_capacity = $request->item_capacity;
        $item_price = $request->item_price;

        $item_disaccount = $request->item_disaccount;
        $item_total_price = $request->item_total_price;
                    
      
        $quote->quote_id = $quote_id;
        $quote->job_id = $job_id;
        $quote->status = $job_status;
        $quote->client_name = $client_name;
        $quote->service = $service_name;
        $quote->quote_language = $quote_language;
        $quote->currency = $currency;
        $quote->quote_note = $quote_note;
        $quote->item_type = $item_type;
        $quote->item_capacity = $item_capacity;
        $quote->item_price = $item_price;

        $quote->item_disaccount = $item_disaccount;
        $quote->item_total_price = $item_total_price;
        $quote->created_by = Auth::user()->username;
        $quote->update();

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
        Quote::find($id)->delete();
        return redirect(route('allQuotes'));
    }

    public function reset() {
        return redirect()->back();
    }
}
