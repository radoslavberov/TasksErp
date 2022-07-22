<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
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
        return view('home');
    }

    public function dashboard()
    {
        if((\Auth::user()->hasRole('admin'))){
            return view('dashboard');
        }
        else{
        $employee = Auth::user()->employee;
        $tasks = Task::where('employee_id', $employee->id)
        ->get();

        return view('dashboard')->with( ['tasks'=> $tasks, 'employee'=> $employee]);
        }
       
        
     
    
    }

    public function website()
    {
        return view('frontend.homepage');
    }
}
