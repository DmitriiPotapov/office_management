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
        if (Auth::check()) {
            $jobs = DataJobs::orderBy('created_at', 'DESC')->limit(12)->get()->toArray();
            $urgentCount = DataJobs::all()->count();
            $completedCount = DataJobs::where('status', 'Completed successfully')->count();
            $paymentPendingCount = DataJobs::where('status', 'Payment pending')->count();
            $paidCount = DataJobs::where('status', 'Paid')->count();
            return view('dashboard',compact('jobs', 'urgentCount', 'completedCount', 'paymentPendingCount', 'paidCount'));
        } else {
            return redirect()->route('login');
        }
    }
}
