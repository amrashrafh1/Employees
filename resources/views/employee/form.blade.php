<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group mb-3">
            {{ Form::label('name') }}
            {{ Form::text('name', $employee->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-3">
            {{ Form::label('email') }}
            {{ Form::text('email', $employee->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-3">
            {{ Form::label('password') }}
            {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'password']) }}
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        @if($employee->avatar)
        <div class="form-group mb-3">
            <img src="{{ Storage::url($employee->avatar) }}" class="img-fluid" alt="">
        </div>
        @endif
        <div class="form-group mb-3">
            {{ Form::label('avatar') }}
            {{ Form::file('avatar', ['class' => 'form-control' . ($errors->has('avatar') ? ' is-invalid' : ''), 'placeholder' => 'Avatar']) }}
            {!! $errors->first('avatar', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-3">
            {{ Form::label('company') }}
            {{ Form::select('company_id', App\Company::pluck('name', 'id'),$employee->company_id, ['class' => 'form-control' . ($errors->has('company_id') ? ' is-invalid' : ''), 'placeholder' => 'Select company']) }}
            {!! $errors->first('company_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>