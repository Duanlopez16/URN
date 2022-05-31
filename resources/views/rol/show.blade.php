@extends('layouts.app')

@section('template_title')
    {{ $rol->name ?? 'Show Rol' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Rol</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rols.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Uuid:</strong>
                            {{ $rol->uuid }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $rol->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $rol->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $rol->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $rol->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
