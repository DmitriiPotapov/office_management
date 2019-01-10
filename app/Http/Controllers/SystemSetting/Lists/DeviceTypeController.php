<?php

namespace App\Http\Controllers\SystemSetting\Lists;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeviceType;

class DeviceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deviceTypes = DeviceType::all();
        return view('settings/lists/devicetypes',compact('deviceTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings/lists/devicetypes_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_devicetype = $request->new_devicetype;
        $DeviceType = new DeviceType();
        $DeviceType->device_name = $new_devicetype;
        $DeviceType->save();
        return redirect('settings/lists/devicetypes');
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
    public function destroy(Request $request)
    {
       $id = $request->id;
       DeviceType::find($id)->delete();
       return redirect()->back();          
    }
}
