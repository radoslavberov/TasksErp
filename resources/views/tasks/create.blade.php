@extends('adminlte::page')

@section('title', __('Create New Task').' - '.env('APP_NAME'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-3">
                <div class="card">
                    <h5 class="card-header">{{ __('Create Task') }}</h5>
                    <div class="card-body">
                        <form method="post" action="{{route('tasks.store')}}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="title" value="{{ old('title') }}" required
                                           autocomplete="name" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                    
                                    <textarea class="form-control" @error('description') is-invalid @enderror id="description" name="description" rols="5" cols="20" value="description">

                                    </textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="status"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Assign Employee') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="employee_id"
                                            required>
                                        <option value="" selected disabled>{{__('Select Employee')}}...</option>
                                       @foreach(\App\Models\Employee::all() as $employee)
                                            <option value="{{$employee -> id}}">
                                                {{$employee->employee_name}}
                                            </option>
                                       @endforeach
                                    </select>

                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="status"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('status') is-invalid @enderror" name="status"
                                            required>
                                        <option value="" selected disabled>{{__('Choose status')}}...</option>
                                        <option value="Completed">{{__('Completed')}}</option>
                                        <option value="In Review">{{__('In Review')}}</option>
                                        <option value="In Progress">{{__('In Progress')}}</option>
                                        <option value="Blocked">{{__('Blocked')}}</option>
                                    </select>

                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4 mt-3">
                                    <button type="submit" class="btn btn-primary">Create Task</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection