<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:departments.index')->only('index');
        $this->middleware('permission:departments.create')->only(['create', 'store']);
        $this->middleware('permission:departments.edit')->only(['edit', 'update']);
        $this->middleware('permission:departments.show')->only('show');
        $this->middleware('permission:departments.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('departments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Department::rules());

        $department = Department::create($request->all());

        return redirect()->route('departments.index')->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function municipalities(Department $department)
    {
        return $department->municipalities()->select('id', 'name')->get()
            ->prepend(['id' => null, 'name' => 'Seleccione un municipio']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $this->validate($request, Department::rules());

        $data = $request->all();

        $data['prime'] = isset($data['prime']) ? $data['prime'] : false;

        $data['legal'] = isset($data['legal']) ? $data['legal'] : false;

        $department->update($data);

        return redirect()->route('departments.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return back()->withSuccess(trans('app.success_destroy'));
    }
}
