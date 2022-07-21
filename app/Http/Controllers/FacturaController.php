<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class FacturaController
 * @package App\Http\Controllers
 */
class FacturaController extends Controller
{

    const ROUTE_BASE = 'factura';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $facturas = \App\Models\Factura::where('status', 1)
                ->orderBy('created_at', 'Desc')
                ->paginate();
            return view('factura.index', compact('facturas'))
                ->with('i', (request()->input('page', 1) - 1) * $facturas->perPage());
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $factura = new \App\Models\Factura();
            return view('factura.create', compact('factura'));
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {

        request()->validate(\App\Models\Factura::$rules);
        try {
            $factura = \App\Models\Factura::create($request->all());

            return redirect()->route('factura.index')
                ->with('success', 'Factura creada correctamente.');
        } catch (\Exception $ex) {
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {
        $factura = \App\Models\Factura::where(
            ['uuid', $uuid],
            ['status', 1]
        );

        if (!empty($factura)) {
        }else{
            
        }

        return view('factura.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $factura = \App\Models\Factura::find($id);

        return view('factura.edit', compact('factura'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Factura $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\Factura $factura)
    {
        request()->validate(\App\Models\Factura::$rules);

        $factura->update($request->all());

        return redirect()->route('factura.index')
            ->with('success', 'Factura updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $factura = \App\Models\Factura::find($id)->delete();

        return redirect()->route('factura.index')
            ->with('success', 'Factura deleted successfully');
    }
}
