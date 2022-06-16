<?php

namespace App\Http\Controllers;

/**
 * Class CategoriaController
 * @package App\Http\Controllers
 */
class CategoriaController extends Controller
{

    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = \App\Models\Categoria::Where('status', '=', 1)->paginate();

        return view('categorium.index', compact('categoria'))
            ->with('i', (request()->input('page', 1) - 1) * $categoria->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorium = new \App\Models\Categoria();
        return view('categorium.create', compact('categorium'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        request()->validate(\App\Models\Categoria::$rules);

        $categorium = \App\Models\Categoria::create($request->all());

        return redirect()->route('categoria.index')
            ->with('success', 'Categoria creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $categorium = \App\Models\Categoria::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
        if (!empty($categorium)) {
            return view('categorium.show', compact('categorium'));
        } else {
            return response()->view('errors.404', [], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $categorium = \App\Models\Categoria::where('uuid', '=', $uuid)->where('status', '=', 1)->first();

        return view('categorium.edit', compact('categorium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\Categoria $categorium)
    {
        request()->validate(\App\Models\Categoria::$rules);

        $categorium->update($request->all());

        return redirect()->route('categoria.index')
            ->with('success', 'Categoria editada correctamente');
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($uuid)
    {
        $categoria = \App\Models\Categoria::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
        if (!empty($categoria)) {
            $categoria->status = 0;
            $categoria->update();
        }
        return redirect()->route('categoria.index')
            ->with('success', 'Categoria Eliminada correctamente');
    }
}
