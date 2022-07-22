<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class RoleController extends Controller

{
    function __construct()
    {
        $this->middleware('permission:role-view', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.roles.index')->with('roles', $roles);
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name'        => 'required|unique:roles,name',
            'permissions' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect(route('admin.roles.create'))->withErrors($validator)->withInput($request->all());
        } else {
            Role::create([
                'name' => $request->get('name'),
            ])->syncPermissions($request->get('permissions'));

            Alert::success('Great!', 'Role created successfully!');
            return redirect()->action([RoleController::class, 'index']);
        }
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit')->with('role', $role);
    }

    public function update(Request $request, Role $role)
    {

        $rules = array('name' => ['required', Rule::unique('roles')->ignore($role->id)]);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('admin.roles.edit', $role->name))->withErrors($validator)->withInput($request->all());
        }
        $role->name = $request->get('name');
        $role->syncPermissions($request->get('permissions'));
        $role->save();

        Alert::success('Great!', 'Role updated successfully!');
        return redirect()->action([RoleController::class, 'index'])->with('success', __('Role updated successfully!'));

    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->action([RoleController::class, 'index'])->with('success', 'Role successfully deleted!');
    }
}
