@extends('adminlte::page')

@section('title', __('Create New Role').' - '.env('APP_NAME'))

@section('js')
    <script>
        var loadFile = function (event) {
            var output = document.getElementById('image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src)
            }
        };

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
                    <h5 class="card-header">{{ __('Create New Role') }}</h5>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.roles.store')}}"
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
                                <label for="permissions"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Permissions') }}</label>

                                <div class="col-md-6">
                                    @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                   id="optionCheck{{$permission->id}}"
                                                   value="{{$permission->id}}">
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

