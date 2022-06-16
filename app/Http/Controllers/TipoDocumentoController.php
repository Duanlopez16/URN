<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class TipoDocumentoController
 * @package App\Http\Controllers
 */
class TipoDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoDocumentos = \App\Models\TipoDocumento::where('status', '=', 1)->paginate();

        return view('tipo-documento.index', compact('tipoDocumentos'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoDocumentos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoDocumento = new \App\Models\TipoDocumento();
        return view('tipo-documento.create', compact('tipoDocumento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(\App\Models\TipoDocumento::$rules);

        $tipoDocumento = \App\Models\TipoDocumento::create($request->all());

        return redirect()->route('tipo-documento.index')
            ->with('success', 'Tipo Documento creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {
        $tipoDocumento = \App\Models\TipoDocumento::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
        return view('tipo-documento.show', compact('tipoDocumento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit(string $uuid)
    {
        $tipoDocumento = \App\Models\TipoDocumento::where('uuid', '=', $uuid)->where('status', '=', 1);

        return view('tipo-documento.edit', compact('tipoDocumento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoDocumento $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\TipoDocumento $tipoDocumento)
    {
        request()->validate(\App\Models\TipoDocumento::$rules);

        $tipoDocumento->update($request->all());

        return redirect()->route('tipo-documento.index')
            ->with('success', 'TipoDocumento updated successfully');
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(string $uuid)
    {
        $tipoDocumento = \App\Models\TipoDocumento::where('uuid', '=', $uuid)->where('status', '=', 1)->first();

        return redirect()->route('tipo-documento.index')
            ->with('success', 'TipoDocumento deleted successfully');
    }
}
