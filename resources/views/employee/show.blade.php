@extends('layouts.app')

@section('template_title')
    {{ $employee->name ?? 'Show Employee' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Employee</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $employee->name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $employee->email }}
                        </div>
                        <div class="form-group">
                            <strong>Avatar:</strong>
                            <img src="{{ Storage::url($employee->avatar) }}" alt="{{ $employee->name }}" class="img-thumbnail" width="300px" height="300px">
                        </div>
                        <div class="form-group">
                            <strong>Company:</strong>
                            {{ $employee->company?->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
