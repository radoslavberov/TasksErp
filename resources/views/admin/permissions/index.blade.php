@extends('adminlte::page')

@section('title', __('Permissions').' - '.env('APP_NAME'))

@section('content')
    <div class="row justify-content-center">
        <h1 class="text-center">{{__('Permissions')}}</h1>
        <div class="col-12">
            <a href="{{route('admin.permissions.create')}}" class="btn btn-primary mb-3 float-right">{{__('Create New')}}</a>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>
                            @if($permission->name)
                            {{$permission->name}}
                            @else
                                {{__('No Data')}}
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary">
                                <a href="{{route('admin.permissions.edit',$permission->name)}}"
                                   class="text-decoration-none text-white">Edit</a>
                            </button>
                            <form action="{{route('admin.permissions.delete', $permission->name)}}"
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
    {{ $permissions->links('pagination::bootstrap-5') }}
    <script src="{{asset('vendor')}}/lightbox2-2.11.3/dist/js/lightbox-plus-jquery.min.js"></script>
@endsection
