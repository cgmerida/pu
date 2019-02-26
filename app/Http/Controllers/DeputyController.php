<?php

namespace App\Http\Controllers;

use App\Deputy;
use App\Department;
use Illuminate\Http\Request;


class DeputyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:deputies.index')->only('index');
        $this->middleware('permission:deputies.create')->only(['create', 'store']);
        $this->middleware('permission:deputies.edit')->only(['edit', 'update']);
        $this->middleware('permission:deputies.show')->only('show');
        $this->middleware('permission:deputies.destroy')->only('destroy');
    }

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
        if ($request->name) {
            $deputy->name = $request->name;
        } else {
            $deputy->{$request->attr} = ($request->option === 'true');
        }

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
        $deputies = $department->deputies()->with(['department' => function ($query) {
            $query->select('id', 'name', 'prime', 'legal');
        }])->get();

        return datatables($deputies)
            ->addColumn('actions', function ($deputies) {
                $id = $deputies->id;
                return view('deputies.partials.actions', compact('id'));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
