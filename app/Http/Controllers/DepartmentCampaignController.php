<?php

namespace App\Http\Controllers;

use App\DepartmentCampaign;

use Illuminate\Http\Request;
use App\Department;

class DepartmentCampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:campaign.index')->only('index');
        $this->middleware('permission:campaign.create')->only(['create', 'store']);
        $this->middleware('permission:campaign.edit')->only(['edit', 'update']);
        $this->middleware('permission:campaign.show')->only('show');
        $this->middleware('permission:campaign.destroy')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('department_campaign.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('department_campaign.create', compact('departments', 'municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, DepartmentCampaign::rules());

        DepartmentCampaign::create($request->all());

        return redirect()->route('department_campaign.index')->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DepartmentCampaign  $departmentCampaign
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentCampaign $departmentCampaign)
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('department_campaign.show', compact('departmentCampaign', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DepartmentCampaign  $departmentCampaign
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentCampaign $departmentCampaign)
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('department_campaign.edit', compact('departmentCampaign', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DepartmentCampaign  $departmentCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentCampaign $departmentCampaign)
    {
        $this->validate($request, $departmentCampaign->rules());

        $departmentCampaign->update($request->all());

        return redirect()->route('department_campaign.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DepartmentCampaign  $departmentCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentCampaign $departmentCampaign)
    {
        $departmentCampaign->delete();

        return response()->json([
            'status' => 'exito',
            'message' => 'Se elimino correctamente'
        ], 200);
    }

    public function getCampaigns(Department $department)
    {
        $departmentCampaign = $department->departmentCampaigns()->with([
            'department' => function ($query) {
                $query->select('id', 'name');
            }
        ])->get();

        return datatables($departmentCampaign)
            ->addColumn('actions', 'department_campaign.partials.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
