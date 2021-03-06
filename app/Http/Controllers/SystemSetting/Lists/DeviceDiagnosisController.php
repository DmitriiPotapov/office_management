<?php

namespace App\Http\Controllers\SystemSetting\Lists;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeviceDiagnosis;

class DeviceDiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devicediagnosis = DeviceDiagnosis::all();
        return view('settings/lists/devicediagnosis',compact('devicediagnosis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings/lists/devicediagnosis_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_devicename = $request->new_devicename;
        $new_devicetype = $request->new_devicetype;
        $DeviceDiagnosis = new DeviceDiagnosis();
        $DeviceDiagnosis->device_name = $new_devicename;
        $DeviceDiagnosis->device_type = $new_devicetype;
        $DeviceDiagnosis->save();
        return redirect('settings/lists/devicediagnosis');
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
        $deviceDiagnosis = DeviceDiagnosis::where('id', $id)->first();
        return view('settings/lists/devicediagnosis_edit', compact('deviceDiagnosis'));
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
        $id = $request->device_diagnosis_id;
        $deviceDiagnosis = DeviceDiagnosis::where('id', $id)->first();
        $deviceDiagnosis->device_name = $request->update_devicename;
        $deviceDiagnosis->device_type = $request->update_devicetype;
        $deviceDiagnosis->update();

        return redirect(route('devicediagnosis'));
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
        DeviceDiagnosis::find($id)->delete();
        return redirect()->back();       
    }
}
