<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StockItem;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $stockItems = StockItem::all();
        return view('stock/all_stocks', compact('stockItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock/add_stock');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        
        $device_type = $request->device_type;
        $connection = $request->connection;
        $form_factor = $request->form_factor;
        $manufacturer = $request->manufacturer;
        $model = $request->model;
        $location = $request->location;
        $diler_info = $request->diler_info;
        $serial_number = $request->serial_number;
        $input_price = $request->input_price;
        $vat_value = $request->vat_value;
        $interest = $request->interest;
        $final_price = $request->final_price;
        $stock_note = $request->stock_note;

        $stockItem = new StockItem();
        $stockItem->device_type = $device_type;
        $stockItem->connection = $connection;
        $stockItem->form_factor = $form_factor;
        $stockItem->manufacturer = $manufacturer;
        $stockItem->stock_model = $model;
        $stockItem->location = $location;
        $stockItem->serial_number = $serial_number;
        $stockItem->input_price = $input_price;
        $stockItem->diler_info = $diler_info;
        $stockItem->interest = $interest;
        $stockItem->vat_value = $vat_value;
        $stockItem->final_price = $final_price;
        $stockItem->stock_note = $stock_note;

        $stockItem->save();
         
        return redirect(route('allstocks'));

    }
            
    /**
     * 
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
    public function destroy(Request $request)
    {
        $id = $request->id;
        StockItem::find($id)->delete();
        return redirect()->back();
    }

    public function reset() {
        return redirect()->back();
    }

    
}
