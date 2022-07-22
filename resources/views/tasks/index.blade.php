@extends('adminlte::page')

@section('title', __('Tasks').' '.env('APP_NAME'))

@section('content')
    <div class="row justify-content-center">
        <h1 class="text-center">{{__('All Tasks')}}</h1>
        <div class="col-12">
            @if(session('error'))
                <div class="row justify-content-center">
                    <div class="alert alert-danger"> {{session('error')}}</div>
                </div>
            @endif
            @if(session('success'))
                <div class="row justify-content-center">
                    <div class="alert alert-success"> {{session('success')}}</div>
                </div>
            @endif
            @can('task-create')
                <a href="{{route('tasks.create')}}" class="btn btn-primary mb-3 float-right">{{__('Create New Task')}}</a>
            @endcan
            <table class="table table-dark">
                <thead>
                <tr>
                    @if(Auth::user()->can('task-edit') || Auth::user()->can('task-delete'))
                    <th> {{__('ID')}}</th>
                    @endif
                    <th>{{__('Title')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Status')}}
                    <th>{{__('Assigned To')}}</th>
                    @if(Auth::user()->can('task-edit') || Auth::user()->can('task-delete'))
                    <th>{{__('Actions')}}</th>
                    @endif
                    <th>{{__('Created At')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        @if(Auth::user()->can('task-edit') || Auth::user()->can('task-delete'))
                        <td>
                            
                            @if($task->id)
                            {{$task->id}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        @endif
                        <td>
                            @if($task->title)
                                {{$task->title}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                            @if($task->description)
                            {{$task->description}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                        
                            @if($task->status == 'In Progress')
                            
                                <button class="btn btn-info">{{$task->status}}</button>

                            @elseif($task->status == 'Completed')
                                <button class="btn btn-success">{{$task->status}}</button>

                            @elseif($task->status == 'In Review')
                                <button class="btn btn-warning">{{$task->status}}</button>

                            @elseif($task->status == 'Blocked')
                                <button class="btn btn-danger">{{$task->status}}</button>
                            @endif
                       </td>
                            <td>
                                @if($task->employee->employee_name)
                                   {{$task->employee->employee_name}}
                                @else
                                    {{__('No Data')}}
                                @endif
                            </td>
                      
                        @if(Auth::user()->can('task-edit') || Auth::user()->can('task-delete'))
                        <td>
                            
                            @can('task-edit')
                                <a href="{{route('tasks.edit', $task->id)}}"
                                   class="text-decoration-none text-white">
                                    <button class="btn btn-primary">{{__('Edit')}}</button>
                                </a>
                            @endcan
                            @can('task-delete')
                                <form action="{{route('tasks.delete', $task->id)}}"
                                      method="post" class="d-inline" autocomplete="off">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"
                                            onclick="return confirm('Are you sure you want to delete this task?');">
                                        {{__('Delete')}}
                                    </button>
                                </form>
                            @endcan
                        </td>
                        
                           
                        @endcan
                        <td>
                            {{$task->created_at}}
                        <td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection


