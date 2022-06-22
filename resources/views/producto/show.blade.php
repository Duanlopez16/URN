@extends('layouts.app')

@section('template_title')
{{ $producto->name ?? 'Show Producto' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Ver Producto</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('producto.index') }}"> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>Uuid:</strong>
                        {{ $producto->uuid }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $producto->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Color:</strong>
                        {{ $producto->color }}
                    </div>
                    <div class="form-group">
                        <strong>Precio:</strong>
                        {{ $producto->precio }}
                    </div>
                    <div class="form-group">
                        <strong>Descripcion:</strong>
                        {{ $producto->descripcion }}
                    </div>
                    <div class="form-group">
                        <strong>Id Categoria:</strong>
                        {{ $producto->id_categoria }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection