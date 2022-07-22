<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:task-view', ['only' => ['index']]);
        $this->middleware('permission:task-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:task-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:task-delete', ['only' => ['delete']]);
    }
    public function index()
    {
        $tasks = Task::orderByDesc('created_at')->paginate(10);
        return view('tasks.index', ['tasks'=>$tasks]);
    }
    public function create()
    {
        return view('tasks.create');
    }
    
    public function store(Request $request)
    {
       
        $data = $request->except('_method', '_token');
        Task::create($data);

        Alert::success('Great!', 'Task created successfully!');
        return redirect(route('tasks.index'));

    }
    
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        $rules = array(
            'description' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect(route('tasks.edit', $task->id))->withErrors($validator)->withInput($request->all());
        }
        $task->description = $request->description;
        $task->status = $request->get('status');
        $task->save();

        Alert::success('Great!', 'Task updated successfully!');
        return redirect()->action([TaskController::class, 'index']);
        $task->update();
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        if ($task)
        {
            $task->delete();

        }
        return redirect()->action([TaskController::class, 'index']);
    }
}
