<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group mb-3">
            {{ Form::label('name') }}
            {{ Form::text('name', $company->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-3">
            {{ Form::label('address') }}
            {{ Form::text('address', $company->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Address']) }}
            {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        @if($company->logo)
        <div class="form-group mb-3">
            <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="img-thumbnail" width="450">
        </div>
        @endif
        <div class="form-group mb-3">
            {{ Form::label('logo') }}
            {{ Form::file('logo', ['class' => 'form-control' . ($errors->has('logo') ? ' is-invalid' : ''), 'placeholder' => 'Logo']) }}
            {!! $errors->first('logo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>