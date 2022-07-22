@extends('adminlte::page')

@section('title', __('Edit Task'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-3">
                <div class="card">
                    <div class="card-header">{{ __('Edit Task') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{route('tasks.update', $task->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" @error('description') is-invalid @enderror id="description" name="description" rols="5" cols="20" value="{{$task->description}}">

                                    </textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @if((\Auth::user()->hasRole('employee')))
                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Change Status') }}</label>

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
                            @endif
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
