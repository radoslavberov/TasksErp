@extends('adminlte::page')

@section('title', __('Users').' - '.env('APP_NAME'))

@section('content')
    <div class="row justify-content-center">
        <h1 class="text-center">{{__('Users')}}</h1>
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

                <a href="{{route('users.create')}}" class="btn btn-primary mb-3 float-right">{{__('Create New')}}</a>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th> {{__('ID')}}</th>
                    <th>{{__('User Email')}}</th>
                    <th>{{__('First Name')}}</th>
                    <th>{{__('Last Name')}}</th>
                    <th>{{__('Phone Number')}}</th>
                    <th>{{(__('Role'))}}</th>
                    <th>{{(__('Actions'))}}</th>
                    
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            @if($user->id)
                                {{$user->id}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                            @if($user->email)
                                {{$user->email}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                            @if($user->first_name)
                                {{$user->first_name}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                            @if($user->last_name)
                                {{$user->last_name}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                            @if($user->phone_number)
                                {{$user->phone_number}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                            {{$user->roles->isNotEmpty()?$user->roles->first()->name:'No Data'}}
                        </td>
                        <td>
                            <div class="d-flex">

                                <a href="{{route('users.edit', $user->id)}}"
                                   class="text-decoration-none text-white mx-2">
                                    <button class="btn btn-primary">{{__('Edit')}}</button>
                                </a>


                                <form action="{{route('users.delete', $user->id)}}"
                                      method="post" class="d-inline" autocomplete="off">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete" class="btn btn-danger" type="submit"
                                            onclick="return confirm('Are you sure you want to delete this user?');">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
