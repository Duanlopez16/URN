<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $users = User::Where('status', '=', 1)->where('id', '!=', auth()->id())->paginate();

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
        $user = new User();
        return view('user.create', compact('user', 'rols', 'tipo_documentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(User::$rules);
        $data = $request->all();
        $data['password'] = \Illuminate\Support\Facades\Hash::make($data['documento']);
        $user = User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rols =  \App\Models\Rol::where('status', '=', 1)->pluck('nombre', 'id');
        $tipo_documentos = \App\Models\TipoDocumento::where('status', '=', 1)->pluck('nombre', 'id');
        $user = User::find($id);

        return view('user.edit', compact('user', 'rols', 'tipo_documentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        request()->validate(User::$rules);

        $user->update($request->all());

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
