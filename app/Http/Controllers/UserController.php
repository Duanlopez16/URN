<?php

namespace App\Http\Controllers;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users =  \Illuminate\Support\Facades\DB::table('users')
            ->join('rol', 'users.rol_id', '=', 'rol.id')
            ->join('tipo_documento', 'users.tipo_documento_id', '=', 'tipo_documento.id')
            ->select('users.*', 'tipo_documento.abreviatura', 'rol.nombre')
            ->where('users.id', '!=', auth()->id())
            ->where('users.status', '=', 1)
            ->paginate();

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rols =  \App\Models\Rol::where('status', '=', 1)->pluck('nombre', 'id');
        $tipo_documentos = \App\Models\TipoDocumento::where('status', '=', 1)->pluck('nombre', 'id');
        $user = new \App\Models\User();
        return view('user.create', compact('user', 'rols', 'tipo_documentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        request()->validate(\App\Models\User::$rules);
        $data = $request->all();
        $data['password'] = \Illuminate\Support\Facades\Hash::make($data['documento']);
        $user = \App\Models\User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'Usuario  creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {

        $user =  \Illuminate\Support\Facades\DB::table('users')
            ->join('rol', 'users.rol_id', '=', 'rol.id')
            ->join('tipo_documento', 'users.tipo_documento_id', '=', 'tipo_documento.id')
            ->select('users.*', 'tipo_documento.abreviatura', 'rol.nombre')
            ->where('users.uuid', '=', $uuid)
            ->where('users.status', '=', 1)
            ->first();
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit(string $uuid)
    {
        $rols =  \App\Models\Rol::where('status', '=', 1)->pluck('nombre', 'id');
        $tipo_documentos = \App\Models\TipoDocumento::where('status', '=', 1)->pluck('nombre', 'id');
        $user = \App\Models\User::where('uuid', '=', $uuid)->where('status', '=', 1)->first();

        return view('user.edit', compact('user', 'rols', 'tipo_documentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\User $user)
    {
        request()->validate(\App\Models\User::$rules);

        $user->update($request->all());

        return redirect()->route('user.index')
            ->with('success', 'Usuario editado Correctamente');
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(string $uuid)
    {
        $user = \App\Models\User::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
        if (!empty($user)) {
            $user->status = 0;
            $user->update();
        }

        return redirect()->route('user.index')
            ->with('success', 'Usuario Eliminado Correctamente');
    }
}
