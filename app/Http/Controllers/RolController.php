<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

/**
 * Class RolController
 * @package App\Http\Controllers
 */
class RolController extends Controller
{

    /**
     * search
     *
     * @var mixed
     */
    public $search;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rols = Rol::where('status', '=', 1)->paginate();

        return view('rol.index', compact('rols'))
            ->with('i', (request()->input('page', 1) - 1) * $rols->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = new Rol();
        return view('rol.create', compact('rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Rol::$rules);

        $rol = Rol::create($request->all());

        return redirect()->route('rol.index')
            ->with('success', 'Rol created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $rol = Rol::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
        return view('rol.show', compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $rol = Rol::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
        return view('rol.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Rol $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\Rol $rol)
    {
        request()->validate(Rol::$rules);

        $rol->update($request->all());

        return redirect()->route('rol.index')
            ->with('success', 'Rol editado correctamente');
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($uuid)
    {
        $rol = Rol::where('uuid', '=', $uuid)->where('status', '=', 1)->first();

        if (!empty($rol)) {
            $rol->status = 0;
            $rol->update();
        }
        return redirect()->route('rol.index')
            ->with('success', 'Rol deleted successfully');
    }
}
