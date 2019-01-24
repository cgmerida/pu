<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Department;
use App\Municipality;
use Illuminate\Http\Request;


class MayorController extends Controller
{
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
        $this->validate($request, Candidate::rules());

        $mayor = Candidate::create($request->all());

        $mayor->depto = $mayor->department->name;
        $mayor->muni = $mayor->municipality->name;

        return response()->json([
            'status' => 'exito',
            'message' => 'Se creo correctamente',
            'mayor' => $mayor
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        $positions = Candidate::positions();

        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        $municipalities = $candidate->municipality()->pluck('name', 'id');

        return view('mayors.show', compact('candidate', 'departments', 'municipalities', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $mayor)
    {
        $mayor->name = $request->name;

        $mayor->save();

        return response()->json([
            'status' => 'exito',
            'message' => 'Se actualizo correctamente',
            'mayor' => $mayor
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();

        return back()->withSuccess(trans('app.success_destroy'));
    }

    public function getMayors(Department $department, $muni_id)
    {
        $municipalities = (int)$muni_id === 0 ?
            $department->municipalities()->with([
            'department' => function ($query) {
                $query->select('id', 'name');
            },
            'candidates',
        ])->get() :
            $department->municipalities()->where('id', $muni_id)->with([
            'department' => function ($query) {
                $query->select('id', 'name');
            },
            'candidates',
        ])->get();

        return datatables($municipalities)
            ->editColumn('candidates.name', function ($municipalities) {
                if (!empty($municipalities->candidates[0])) {
                    return $municipalities->candidates[0]->name;
                }
                return 'Sin Candidato';
            })
            ->addColumn('actions', function ($municipalities) {
                $candidate_id = 0;
                $depto = $municipalities->department->id;
                $muni = $municipalities->id;
                if (!empty($municipalities->candidates[0])) {
                    $candidate_id = $municipalities->candidates[0]->id;
                }
                return view('mayors.partials.actions', compact('candidate_id', 'depto', 'muni'));
            })
            // ->addColumn('actions', 'candidates.partials.mayors-action')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
