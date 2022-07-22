<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-view', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string', 'min:2'],
            'last_name' => ['required', 'string', 'min:2'],
            'phone_number' => ['required', 'string'],
        );
        $validator =Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return redirect(route('users.create'))->withErrors($validator)->withInput($request->all());
        }
        else
        {
            $user =User::create(
                [
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'phone_number' => $request['phone_number'],
                ]
            );
            return redirect()->action([UserController::class, 'index']);
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if(isset($request->first_name, $request)){
            $user->first_name = $request->first_name;
        }
        if(isset($request->last_name, $request)) {
            $user->last_name = $request->last_name;
        }
        if(isset($request->phone_number, $request)) {
            $user->phone_number = $request->phone_number;
        }

        $user->update();
        Alert::success('Great','Profile updated successfully!');
        return redirect()->action([UserController::class, 'index']);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user)
        {
            $user->delete();

        }
        return redirect()->action([UserController::class, 'index']);
    }
}
