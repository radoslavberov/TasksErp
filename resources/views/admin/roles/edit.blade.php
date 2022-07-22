@extends('adminlte::page')

@section('title', __('Edit Category').' - '.env('APP_NAME'))

@section('js')
    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-3">
                <div class="card">
                    <h5 class="card-header">{{ __('Edit Role') }}/ <b>{{$role->name}}</b></h5>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.roles.update', $role->name)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ old('name') ? old('name') : $role->name}}" required
                                           autocomplete="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="permissions"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Permissions') }}</label>

                                <div class="col-md-6">
                                    @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                   id="optionCheck{{$permission->id}}"
                                                   value="{{$permission->id}}"
                                                   @if(in_array($permission->name, array_column($role->permissions->toArray(), 'name'))))
                                                   checked @endif>
                                            <label class="form-check-label"
                                                   for="attributeCheck{{$permission->id}}">{{ucwords($permission->name)}}</label>
                                        </div>
                                    @endforeach

                                    @error('permissions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-2">
                                <input type="checkbox" class="check" id="option-all" onchange="toggle(this)">
                                <label for="option-all">{{__('Select all')}}</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
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

