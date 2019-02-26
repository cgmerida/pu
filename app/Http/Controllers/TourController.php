<?php

namespace App\Http\Controllers;

use App\Tour;
use App\Department;
use Illuminate\Http\Request;


class TourController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tours.index')->only('index');
        $this->middleware('permission:tours.create')->only(['create', 'store']);
        $this->middleware('permission:tours.edit')->only(['edit', 'update']);
        $this->middleware('permission:tours.show')->only('show');
        $this->middleware('permission:tours.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('tours.index', compact('departments'));
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

        $municipalities = ['' => 'Seleccione un departamento antes'];

        return view('tours.create', compact('departments', 'municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Tour::rules());

        Tour::create($request->all());

        return redirect()->route('tours.index')->withSuccess(trans('app.success_store'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('tours.show', compact('tour', 'departments'));
    }


    public function edit(Tour $tour)
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        $municipalities = $tour->municipality->pluck('name', 'id')->prepend('Seleccione un departamento antes');

        return view('tours.edit', compact('tour', 'departments', 'municipalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        $this->validate($request, $tour->rules());

        $tour->update($request->all());

        return redirect()->route('tours.index')->withSuccess(trans('app.success_update'));
    }

    public function close(Request $request, Tour $tour)
    {
        $tour->status = $request->status;

        $tour->save();

        return response()->json([
            'status' => 'exito',
            'message' => 'Se actualizo correctamente',
            'tour' => $tour
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();

        return response()->json([
            'status' => 'exito',
            'message' => 'Se elimino correctamente'
        ], 200);
    }

    public function getTours(Department $department)
    {
        $tours = $department->tours()->with([
            'department' => function ($query) {
                $query->select('id', 'name');
            },
            'municipality' => function ($query) {
                $query->select('id', 'name');
            }
        ])->get();

        return datatables($tours)
            ->addColumn('actions', 'tours.partials.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
