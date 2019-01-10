<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class JobController extends Controller
{
    //
    public function __constuct() 
    {
        parent::__constuct();
        $this->middleware('auth');
    }

    public function showAddJob()
    {
        return view('job.addJob');
    }

    public function showAllJob()
    {
        return view('job.viewJobs');
    }

    public function showAllPriorityJob()
    {
        return view('job.viewJobs');
    }

    public function showOverview()
    {

    }

    public function showEditJob($id)
    {
        return view('job.editJob');
    }

    public function updateJob()
    {

    }

    public function deleteJob($id)
    {

    }
}
