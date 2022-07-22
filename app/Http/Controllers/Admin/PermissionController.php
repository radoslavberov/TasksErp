<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission-view', ['only' => ['index']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('admin.permissions.index')->with('permissions', $permissions);
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|unique:permissions,name',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect(route('admin.permissions.create'))->withErrors($validator)->withInput($request->all());
        } else {
            $permission = Permission::create([
                'name' => $request->get('name'),
            ]);
            $permission->syncRoles($request->get('roles'));
            $permission->save();

            Alert::success('Great!', 'Permission created successfully!');
            return redirect()->action([PermissionController::class, 'index']);
        }
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit')->with('permission', $permission);
    }

    public function update(Request $request, Permission $permission)
    {

        $rules = array('name' => ['required', Rule::unique('permissions')->ignore($permission->id)]);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('admin.permissions.edit', $permission->name))->withErrors($validator)->withInput($request->all());
        } else {
            $permission->name = $request->get('name');
            $permission->syncRoles($request->get('roles'));
            $permission->save();

            Alert::success('Great!', 'Permission updated successfully!');
            return redirect()->action([PermissionController::class, 'index'])->with('success', __('Permission updated successfully!'));
        }
        return redirect()->action([PermissionController::class, 'index'])->with('error', 'Such permission does not exist!');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->action([PermissionController::class, 'index'])->with('success', 'Permission successfully deleted!');
    }
}
