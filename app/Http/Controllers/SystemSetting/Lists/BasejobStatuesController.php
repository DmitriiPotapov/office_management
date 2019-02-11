<?php

namespace App\Http\Controllers\SystemSetting\Lists;
use App\Models\BaseJobStatuse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BasejobStatuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobstatusdata = BaseJobStatuse::all();

        return view('settings/lists/basejobstatuses',compact('jobstatusdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings/lists/basejobstatues_create');
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_jobstatus = $request->new_jobstatus;
        $BaseJobstatus = new BaseJobStatuse();
        $BaseJobstatus -> status_name = $new_jobstatus;
        $BaseJobstatus -> save();
        return redirect('settings/lists/basejobstatues');
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
        $basejobstatus = BaseJobStatuse::where('id', $id)->first();
       
        return view('settings/lists/basejobstatues_edit', compact('basejobstatus'));
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
        $id = $request->job_status_id;
        $basejobstatus = BaseJobStatuse::where('id', $id)->first();
        $basejobstatus->status_name = $request->new_jobstatus;

        $basejobstatus -> update();

        return redirect(route('basejobstatuses'));
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
        BaseJobStatuse::find($id)->delete();
        return redirect()->back();
    }
}
