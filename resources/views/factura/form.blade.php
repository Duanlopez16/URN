<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('uuid') }}
            {{ Form::text('uuid', $factura->uuid, ['class' => 'form-control' . ($errors->has('uuid') ? ' is-invalid' : ''), 'placeholder' => 'Uuid']) }}
            {!! $errors->first('uuid', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cliente_id') }}
            {{ Form::text('cliente_id', $factura->cliente_id, ['class' => 'form-control' . ($errors->has('cliente_id') ? ' is-invalid' : ''), 'placeholder' => 'Cliente Id']) }}
            {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('total') }}
            {{ Form::text('total', $factura->total, ['class' => 'form-control' . ($errors->has('total') ? ' is-invalid' : ''), 'placeholder' => 'Total']) }}
            {!! $errors->first('total', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('subtotal') }}
            {{ Form::text('subtotal', $factura->subtotal, ['class' => 'form-control' . ($errors->has('subtotal') ? ' is-invalid' : ''), 'placeholder' => 'Subtotal']) }}
            {!! $errors->first('subtotal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('iva') }}
            {{ Form::text('iva', $factura->iva, ['class' => 'form-control' . ($errors->has('iva') ? ' is-invalid' : ''), 'placeholder' => 'Iva']) }}
            {!! $errors->first('iva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $factura->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_creator') }}
            {{ Form::text('user_creator', $factura->user_creator, ['class' => 'form-control' . ($errors->has('user_creator') ? ' is-invalid' : ''), 'placeholder' => 'User Creator']) }}
            {!! $errors->first('user_creator', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_last_update') }}
            {{ Form::text('user_last_update', $factura->user_last_update, ['class' => 'form-control' . ($errors->has('user_last_update') ? ' is-invalid' : ''), 'placeholder' => 'User Last Update']) }}
            {!! $errors->first('user_last_update', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>