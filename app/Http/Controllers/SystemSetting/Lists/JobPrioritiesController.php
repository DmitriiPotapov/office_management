<?php

namespace App\Http\Controllers\SystemSetting\Lists;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobPriority;

class JobPrioritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobPriorities = JobPriority::all();
        return view('settings/lists/jobpriorities', compact('jobPriorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings/lists/jobpriorities_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_jobpriorityname = $request->new_jobpriorityname;
        $JobPriority = new JobPriority();
        $JobPriority->job_priority_name = $new_jobpriorityname;
        $JobPriority -> save();
        return redirect('settings/lists/jobpriorities');
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
        $jobPriority = JobPriority::where('id', $id)->first();
        return view('settings/lists/jobpriorities_edit', compact('jobPriority'));
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
        $id = $request->jobpriority_id;
        $jobpriority = JobPriority::where('id', $id)->first();
        $jobpriority->job_priority_name = $request->update_jobpriorityname;
        $jobpriority->update();

        return redirect(route('jobpriorities'));
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
        JobPriority::find($id)->delete();
        return redirect()->back();
    }
}
