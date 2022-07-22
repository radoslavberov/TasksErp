@extends('adminlte::page')

@section('title', __('Employees').' - '.env('APP_NAME'))

@section('content')
    <div class="row justify-content-center">
        <h1 class="text-center">{{__('Employees')}}</h1>
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
            @can('employee-create')
                <a href="{{route('employees.create')}}" class="btn btn-primary mb-3 float-right">{{__('Create New')}}</a>
            @endcan
            <table class="table table-dark">
                <thead>
                <tr>
                    <th> {{__('ID')}}</th>
                    <th>{{__('Employee Name')}}</th>
                    <th>{{__('Employee Email')}}</th>
                    <th>{{__('Employee Status')}}</th>
                    <th>{{__('Employee Address')}}</th>
                    <th>{{__('Actions')}}</th>
                    <th>{{__('Created At')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>
                            @if($employee->id)
                            {{$employee->id}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                            @if($employee->employee_name)
                                {{$employee->employee_name}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                            @if($employee->user->email)
                            {{$employee->user->email}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                       
                            <td>
                                @if($employee->employee_status)
                                {{$employee->employee_status}}
                                @else
                                    {{__('No Data')}}
                                @endif
                            </td>
                       
                       

                        <td>
                            @if($employee->address)
                            {{$employee->address}}
                            @else
                            {{__('No Data')}}
                            @endif
                        </td>
                        @if(Auth::user()->can('employee-edit') || Auth::user()->can('employee-delete'))
                        <td>
                            @can('employee-edit')
                                <a href="{{route('employees.edit', $employee->id)}}"
                                   class="text-decoration-none text-white">
                                    <button class="btn btn-primary">{{__('Edit')}}</button>
                                </a>
                            @endcan
                            @can('employee-delete')
                                <form action="{{route('employees.delete', $employee->id)}}"
                                      method="post" class="d-inline" autocomplete="off">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"
                                            onclick="return confirm('Are you sure you want to delete this employee?');">
                                        {{__('Delete')}}
                                    </button>
                                </form>
                            @endcan
                        </td>
                        <td>
                            {{$employee->created_at}}
                        <td>
                           
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection


