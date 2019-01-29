<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipality;
use App\Department;

class MunicipalityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:municipalities.index')->only('index');
        $this->middleware('permission:municipalities.create')->only(['create', 'store']);
        $this->middleware('permission:municipalities.edit')->only(['edit', 'update']);
        $this->middleware('permission:municipalities.show')->only('show');
        $this->middleware('permission:municipalities.destroy')->only('destroy'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('municipalities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento', "");
        return view('municipalities.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Municipality::rules());

        $municipality = Municipality::create($request->all());

        return redirect()->route('municipalities.index')->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Municipality $municipality)
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento', "");
        return view('municipalities.show', compact('municipality', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipality $municipality)
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento', "");
        return view('municipalities.edit', compact('municipality', 'departments'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipality $municipality)
    {
        $this->validate($request, Municipality::rules());

        $data = $request->all();

        $data['prime'] = isset($data['prime']) ? $data['prime']: false;

        $data['legal'] = isset($data['legal']) ? $data['legal']: false; 

        $municipality->update($data);

        return redirect()->route('municipalities.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipality $municipality)
    {
        $municipality->delete();

        return back()->withSuccess(trans('app.success_destroy'));
    }
}
