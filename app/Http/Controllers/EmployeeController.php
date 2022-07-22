<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EmployeeRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:employee-view', ['only' => ['index']]);
        $this->middleware('permission:employee-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employee-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employee-delete', ['only' => ['delete']]);
    }

    public function index()
    {
        
        $employees = Employee::all();
        
        return view('employees.index')->with(['employees' => $employees, 'tasks'=> $tasks]);
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'email'        => $request->get('email'),
            'password'     => '$2a$12$t1P8XEMuA7lx9L1ntNm1xusb4tLK8vjfYfL1EF8MCQXS4iNxj3Lnq',
            'first_name'   => $request->get('first_name'),
            'last_name'    => $request->get('last_name'),
            'phone_number' => $request->get('phone_number'),
        ]);
        $user->assignRole('employee');
        $employee = Employee::create([
            'employee_name' => $user->first_name . " " . $user->last_name,
            'user_id'     => $user->id,
            'address'     => $request->get('address'),
            'employee_status'      => $request->get('employee_status'),
        ]);

        Alert::success('Great!', 'Employee created successfully!');
        return redirect()->action([EmployeeController::class, 'index']);
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit')->with(['employee' => $employee]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $user = $employee->user;
        $rules = array(
            'employee_status'  => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('employees.edit', $employee->id))->withErrors($validator)->withInput($request->all());
        }
        $employee->employee_status = $request->get('employee_status');
        $employee->save();

        Alert::success('Great!', 'Employee updated successfully!');
        return redirect()->action([EmployeeController::class, 'index']);
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $userId = $employee->user_id;
        $user = User::findOrFail($userId);
        $user->removeRole('employee');

        if ($employee) {
            $employee->delete();
        }
        return redirect()->action([EmployeeController::class, 'index']);
    }

}
