@extends('layouts.app')

@section('template_title')
    {{ $company->name ?? 'Show Company' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Company</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group mb-3">
                            <strong>Name:</strong>
                            {{ $company->name }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Address:</strong>
                            {{ $company->address }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Logo:</strong>
                            <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->name }}" width="100px" height="100px">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
