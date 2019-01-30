<?php

namespace App\Http\Controllers;

use App\Department;
use App\Mayor;
use App\Municipality;
use Illuminate\Http\Request;

class MayorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:mayors.index')->only('index');
        $this->middleware('permission:mayors.create')->only(['create', 'store']);
        $this->middleware('permission:mayors.edit')->only(['edit', 'update']);
        $this->middleware('permission:mayors.show')->only('show');
        $this->middleware('permission:mayors.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        $municipalities = [0 => 'Seleccione un departamento antes'];

        return view('mayors.index', compact('departments', 'municipalities'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Mayor::rules());

        $mayor = Mayor::create($request->all());

        $mayor->depto = $mayor->department->name;
        $mayor->muni = $mayor->municipality->name;

        return response()->json([
            'status' => 'exito',
            'message' => 'Se creo correctamente',
            'mayor' => $mayor,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mayor  $mayor
     * @return \Illuminate\Http\Response
     */
    public function show(Mayor $mayor)
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        $municipalities = $mayor->municipality()->pluck('name', 'id');

        return view('mayors.show', compact('mayor', 'departments', 'municipalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mayor  $mayor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mayor $mayor)
    {
        if ($request->name) {
            $mayor->name = $request->name;
        } else {
            $mayor->{$request->attr} = ($request->option === 'true');
        }

        $mayor->save();

        return response()->json([
            'status' => 'exito',
            'message' => 'Se actualizo correctamente',
            'mayor' => $mayor,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mayor  $mayor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mayor $mayor)
    {
        $mayor->delete();

        return response()->json([
            'status' => 'exito',
            'message' => 'Se elimino correctamente',
        ], 200);
    }

    public function getMayors(Department $department, $muni_id)
    {
        $municipalities = (int) $muni_id === 0 ?
        $department->municipalities()
            ->with('mayor')->get() :
        $department->municipalities()->whereId($muni_id)
            ->with('mayor')->get();

        return datatables($municipalities)
            ->editColumn('mayor.name', function ($municipalities) {
                if ($municipalities->mayor) {
                    return $municipalities->mayor->name;
                }
                return 'Sin Candidato';
            })
            ->editColumn('mayor.nominated', function ($municipalities) {
                if ($municipalities->mayor) {
                    return $municipalities->mayor->nominated;
                }
                return 'Sin Candidato';
            })
            ->editColumn('mayor.signed_up', function ($municipalities) {
                if ($municipalities->mayor) {
                    return $municipalities->mayor->signed_up;
                }
                return 'Sin Candidato';
            })
            ->addColumn('actions', function ($municipalities) {
                $mayor_id = 0;
                $depto = $municipalities->department->id;
                $muni = $municipalities->id;
                if ($municipalities->mayor) {
                    $mayor_id = $municipalities->mayor->id;
                }
                return view('mayors.partials.actions', compact('mayor_id', 'depto', 'muni'));
            })
            // ->addColumn('actions', 'mayors.partials.mayors-action')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
