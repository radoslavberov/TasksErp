@extends('adminlte::page')

@section('title', __('Create New Permission').' - '.env('APP_NAME'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-3">
                <div class="card">
                    <h5 class="card-header">{{ __('Create New Permission') }}</h5>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.permissions.store')}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="roles"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Roles') }}</label>

                                <div class="col-md-6">
                                    @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                   id="optionCheck{{$role->id}}"
                                                   value="{{$role->id}}">
                                            <label class="form-check-label"
                                                   for="attributeCheck{{$role->id}}">{{ucwords($role->name)}}</label>
                                        </div>
                                    @endforeach

                                    @error('roles')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create New') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

