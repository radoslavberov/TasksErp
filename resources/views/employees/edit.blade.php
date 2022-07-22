@extends('adminlte::page')

@section('title', __('Edit Employee').' - '.env('APP_NAME'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-3">
                <div class="card">
                    <h5 class="card-header">{{ __('Edit Employee') }}</h5>
                    <div class="card-body">
                                <form method="post" action="{{route('employees.update', $employee->id)}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="employee_status"
                                               class="col-md-4 col-form-label text-md-end">{{ __('Employee Status') }}</label>
                                        <div class="col-md-6">
                                            <select class="form-control @error('employee_status') is-invalid @enderror" name="employee_status"
                                                    required>
                                                <option value="Junior Developer"
                                                        @if($employee->employee_status == 'Junior Developer') selected @endif>{{__('Junior Developer')}}</option>
                                                <option value="Mid Developer"
                                                        @if($employee->employee_status == 'Mid Developer') selected @endif>{{__('Mid Developer')}}</option>
                                                <option value="Senior Developer"
                                                        @if($employee->employee_status == 'Senior Developer') selected @endif>{{__('Senior Developer')}}</option>
                                            </select>

                                            @error('employee_status')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary mt-3">{{__('Save')}}</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
