<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\Request;

/**
 * Class TallaController
 * @package App\Http\Controllers
 */
class TallaController extends Controller
{

    const ROUTE_BASE = 'talla';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tallas = Talla::where('status', '=', 1)->paginate();

        return view('talla.index', compact('tallas'))
            ->with('i', (request()->input('page', 1) - 1) * $tallas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $talla = new Talla();
        return view('talla.create', compact('talla'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Talla::$rules);

        $talla = Talla::create($request->all());

        return redirect()->route('talla.index')
            ->with('success', 'Talla created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {
        $talla = Talla::where('status', '=', 1)->where('uuid', '=', $uuid)->first();
        if (!empty($talla)) {
            return view('talla.show', compact('talla'));
        } else {
            $route = self::ROUTE_BASE;
            return view('errors.notfound', compact('route'));
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
            $talla = Talla::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($talla)) {
                return view('talla.edit', compact('talla'));
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
     * @param  Talla $talla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Talla $talla)
    {
        try {
            request()->validate(Talla::$rules);
            $talla->update($request->all());
            return redirect()->route('talla.index')
                ->with('success', 'Talla updated successfully');
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(string $uuid)
    {
        $route = self::ROUTE_BASE;

        try {
            $talla = Talla::where('status', '=', '1')->where('uuid', '=', $uuid)->first();
            if (!empty($talla)) {
                $talla->status = 0;
                $talla->update();
                return redirect()->route('talla.index')
                    ->with('success', 'Talla deleted successfully');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
