@extends('adminlte::page')

@section('title', __('Roles').' - '.env('APP_NAME'))

@section('content')
    <div class="row justify-content-center">
        <h1 class="text-center">{{__('Roles')}}</h1>
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
            <a href="{{route('admin.roles.create')}}" class="btn btn-primary mb-3 float-right">{{__('Create New')}}</a>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>
                            @if($role->name)
                            {{$role->name}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary">
                                <a href="{{route('admin.roles.edit',$role->name)}}"
                                   class="text-decoration-none text-white">Edit</a>
                            </button>
                            <form action="{{route('admin.roles.delete', $role->name)}}"
                                  method="post" class="d-inline" autocomplete="off">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Are you sure you want to delete this item?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $roles->links('pagination::bootstrap-5') }}
@endsection
