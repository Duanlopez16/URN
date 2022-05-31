@extends('layouts.app')

@section('template_title')
Categoria
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Categoria') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('categoria.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear categoria') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Uuid</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoria as $categorium)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $categorium->uuid }}</td>
                                    <td>{{ $categorium->nombre }}</td>
                                    <td>{{ $categorium->descripcion }}</td>

                                    <td>
                                        <form action="{{ route('categoria.destroy',$categorium->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('categoria.show',$categorium->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('categoria.edit',$categorium->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $categoria->links() !!}
        </div>
    </div>
</div>
@endsection