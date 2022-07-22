@extends('adminlte::page')
@section('title', __('Dashboard').' - '.env('APP_NAME'))
@section('content')
@if((\Auth::user()->hasRole('admin')))
    <div class="container">
        <h2 class="py-3">Dashboard</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mx-2 w-100">
                            <x-adminlte-small-box title="All Users" text="View all created users" icon="fas fa-user-tie"
                                                  theme="teal" url="{{route('users.index')}}" url-text="View details"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mx-2 w-100">
                            <x-adminlte-small-box title="Employees" text="View all created employees" icon="fas fa-user-tie"
                                                  theme="teal" url="{{route('employees.index')}}" url-text="View details"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mx-2 w-100">
                            <x-adminlte-small-box title="Tasks" text="View all created tasks" icon="fas fa-user-tie"
                                                  theme="teal" url="{{route('tasks.index')}}" url-text="View details"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mx-2 w-100">
                            <x-adminlte-small-box title="Roles" text="View all created roles" icon="fas fa-user-tie"
                                                  theme="teal" url="{{route('admin.roles.index')}}" url-text="View details"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mx-2 w-100">
                            <x-adminlte-small-box title="Permissions" text="View all created permissions" icon="fas fa-user-tie"
                                                  theme="teal" url="{{route('admin.permissions.index')}}" url-text="View details"/>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @elseif(\Auth::user()->hasRole('employee'))
        

    <div class="container">
        <div class="card-header d-flex flex-column align-items-center">
            <h3 class="mb-0">Welcome {{ Auth::user()->employee->employee_name}}</h3>
            <br>
            <h5 class="mb-0">{{__('Your Account Dashboard')}}</h5>
        </div>
        <div class="dashboard-content-wrap my-5">
            


            <div class="d-flex  align-items-center">
                <label class="mb-0 mr-3">First Name:</label>
                <p class="mb-0 user-info">{{ Auth::user()->first_name }}</p>
            </div>
            <div class="d-flex  align-items-center">
                <label class="mb-0 mr-3">Last Name</label>
                <p class="mb-0 user-info">{{ Auth::user()->last_name}}</p>
            </div>
            <div class="d-flex  align-items-center">
                <label class="mb-0 mr-3">Email:</label>
                <p class="mb-0 user-info">{{ Auth::user()->email}}</p>
            </div>

            <div class="d-flex  align-items-center">
                <label class="mb-0 mr-3">Phone Number:</label>
                <p class="mb-0 user-info">{{ Auth::user()->phone_number}}</p>
            </div>

            <div class="d-flex  align-items-center">
                <label class="mb-0 mr-3">Address:</label>
                <p class="mb-0 user-info">{{ Auth::user()->employee->address}}</p>
            </div>
            <div class="d-flex align-items-center">
                <label class="mb-0 mr-3">Company Status:</label>
                <p class="mb-0 user-info">{{ Auth::user()->employee->employee_status}}</p>
            </div> 

            <div class="d-flex align-items-center">
                <label class="mb-0 mr-3 ">Account Created At:</label>
                <p class="mb-0">{{ Auth::user()->employee->created_at}}</p>
            </div> 
        </div>
        
        <table class="table table-dark">
            <thead>
            <tr>
               
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
                        @elseif($task->status == 'In Review')
                            <button class="btn btn-warning">{{$task->status}}</button>

                        @elseif($task->status == 'Completed')
                            <button class="btn btn-success">{{$task->status}}</button>
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

        <a class="btn btn-primary" href="{{route('tasks.index')}}">View Other Tasks</a>
    </div>


    @endif
@endsection
