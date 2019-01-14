<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\DataJobs;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jobs = DataJobs::orderBy('created_at', 'DESC')->limit(12)->get()->toArray();
        if (Auth::check()) {
            return view('dashboard',compact('jobs'));            
        } else {
            return redirect()->route('login');
        }
    }
}
