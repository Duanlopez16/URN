<?php

namespace App\Http\Controllers;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    const ROUTE_BASE = 'user';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $users = \App\Models\User::where('status', '=', 1)
                ->where('users.id', '!=', auth()->id())
                ->paginate();

            return view('user.index', compact('users'))
                ->with(['rol:id,nombre'])
                ->with(['TipoDocumento:id,abreviatura'])
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
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
            $rols =  \App\Models\Rol::where('status', '=', 1)->pluck('nombre', 'id');
            $tipo_documentos = \App\Models\TipoDocumento::where('status', '=', 1)->pluck('nombre', 'id');
            $user = new \App\Models\User();
            return view('user.create', compact('user', 'rols', 'tipo_documentos'));
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

        request()->validate(\App\Models\User::$rules);
        try {
            $data = $request->all();
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['documento']);
            $user = \App\Models\User::create($data);

            return redirect()->route('user.index')
                ->with('success', 'Usuario  creado correctamente.');
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
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

        $route = self::ROUTE_BASE;

        try {
            $user =  \Illuminate\Support\Facades\DB::table('users')
                ->join('rol', 'users.rol_id', '=', 'rol.id')
                ->join('tipo_documento', 'users.tipo_documento_id', '=', 'tipo_documento.id')
                ->select('users.*', 'tipo_documento.abreviatura', 'rol.nombre')
                ->where('users.uuid', '=', $uuid)
                ->where('users.status', '=', 1)
                ->first();
            if (!empty($user)) {
                $user->edad =  \App\Services\Utils::calculate_edad($user->fecha_nacimiento)->data->y ?? 0;
                return view('user.show', compact('user'));
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit(string $uuid)
    {
        $route = self::ROUTE_BASE;

        try {
            $rols =  \App\Models\Rol::where('status', '=', 1)->pluck('nombre', 'id');
            $tipo_documentos = \App\Models\TipoDocumento::where('status', '=', 1)->pluck('nombre', 'id');
            $user = \App\Models\User::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($user)) {
                return view('user.edit', compact('user', 'rols', 'tipo_documentos'));
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
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
        try {

            $user->update($request->all());

            return redirect()->route('user.index')
                ->with('success', 'Usuario editado Correctamente');
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(string $uuid)
    {
        $route = self::ROUTE_BASE;
        try {
            $user = \App\Models\User::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($user)) {
                $user->status = 0;
                $user->update();
                return redirect()->route('user.index')
                    ->with('success', 'Usuario Eliminado Correctamente');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * search
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function search(\Illuminate\Http\Request $request,)
    {
        $route = self::ROUTE_BASE;

        try {
            $data = $request->all();

            $users = \App\Models\User::where('status', '=', 1)
                ->where('id', '!=', auth()->id())
                ->where('email', 'LIKE', '%' . $data['email'] . '%')
                ->paginate();

            return view('user.index', compact('users'))
                ->with(['rol:id,nombre'])
                ->with(['TipoDocumento:id,abreviatura'])
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
