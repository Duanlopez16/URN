<?php

namespace App\Http\Controllers;

use \App\Models\Categoria;
use Illuminate\Http\Request;

/**
 * Class categoriaController
 * @package App\Http\Controllers
 */
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = \App\Models\Categoria::where('status', '=', 1)->paginate();
        return view('categoria.index', compact('categoria'))
            ->with('i', (request()->input('page', 1) - 1) * $categoria->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = new \App\Models\Categoria();
        return view('categoria.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(\App\Models\Categoria::$rules);

        $categoria = \App\Models\Categoria::create($request->all());

        return redirect()->route('categoria.index')
            ->with('success', 'Categoria created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = \App\Models\Categoria::find($id);

        return view('categoria.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = \App\Models\Categoria::find($id);

        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\Categoria $categoria)
    {
        request()->validate(\App\Models\Categoria::$rules);

        $categoria->update($request->all());

        return redirect()->route('categoria.index')
            ->with('success', 'categoria updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $categoria = \App\Models\Categoria::find($id);
        $categoria->status = 0;
        $categoria->update();
        return redirect()->route('categoria.index')
            ->with('success', 'categoria deleted successfully');
    }
}
