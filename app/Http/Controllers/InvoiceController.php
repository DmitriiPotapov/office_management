<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoice/all_invoices');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unique_id =  Date('Y:m:d').':'.rand();
        return view('invoice/add_invoice',compact('unique_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client_name = $request->client_name;
        $invoice_language = $request->invoice_language;
        $currency = $request->currency;
        $footer_text = $request->footer_text;
        $invoice_note = $request->invoice_note;
      
        $invoice = new Invoice();
        $invoice->client_name = $client_name;
        $invoice->invoice_language = $invoice_language;
        $invoice->currency = $currency;
        $invoice->footer_text = $footer_text;
        $invoice->invoice_note = $invoice_note;

        $invoice->save();

        return redirect('invoice/allview');

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
}
