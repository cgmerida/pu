<?php

namespace App\Http\Controllers;

use App\Deputy;
use App\Department;
use App\Municipality;
use Illuminate\Http\Request;


class DeputyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('deputies.index', compact('departments'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('deputies.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Deputy::rules());

        Deputy::create($request->all());

        return redirect()->route('deputies.index')->withSuccess(trans('app.success_store'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Deputy  $deputy
     * @return \Illuminate\Http\Response
     */
    public function show(Deputy $deputy)
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('deputies.show', compact('deputy', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deputy  $deputy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deputy $deputy)
    {
        $deputy->name = $request->name;

        $deputy->save();

        return response()->json([
            'status' => 'exito',
            'message' => 'Se actualizo correctamente',
            'deputy' => $deputy
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deputy  $deputy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deputy $deputy)
    {
        $deputy->delete();

        return response()->json([
            'status' => 'exito',
            'message' => 'Se elimino correctamente'
        ], 200);
    }

    public function getDeputies(Department $department)
    {
        $deputies = $department->deputies()->with('department')
            ->select('id', 'name', 'department_id')->get();

        return datatables($deputies)
            ->addColumn('actions', function ($deputies) use ($department) {
                $id = $deputies->id;
                $depto = $department->id;
                return view('deputies.partials.actions', compact('id'));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
