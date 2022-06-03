@extends('layouts.app')

@section('template_title')
{{ $user->name ?? 'Show User' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Show User</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Uuid:</strong>
                        {{ $user->uuid }}
                    </div>
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                    <div class="form-group">
                        <strong>Rol Id:</strong>
                        {{ $user->rol_id }}
                    </div>
                    <div class="form-group">
                        <strong>Tipo Documento Id:</strong>
                        {{ $user->tipo_documento_id }}
                    </div>
                    <div class="form-group">
                        <strong>Documento:</strong>
                        {{ $user->documento }}
                    </div>
                    <div class="form-group">
                        <strong>Direccion:</strong>
                        {{ $user->direccion }}
                    </div>
                    <div class="form-group">
                        <strong>Telefono:</strong>
                        {{ $user->telefono }}
                    </div>
                    <div class="form-group">
                        <strong>Status:</strong>
                        {{ $user->status }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection