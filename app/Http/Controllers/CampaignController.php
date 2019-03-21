<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Department;
use Illuminate\Http\Request;


class CampaignController extends Controller
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

        return view('campaign.index', compact('departments'));
    }

    public function index2()
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('campaign.index2', compact('departments'));
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

        return view('campaign.create', compact('departments', 'municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Campaign::rules());

        Campaign::create($request->all());

        return redirect()->route('campaign.index')->withSuccess(trans('app.success_store'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        return view('campaign.show', compact('campaign', 'departments'));
    }


    public function edit(Campaign $campaign)
    {
        $departments = Department::pluck('name', 'id')->prepend('Seleccione un departamento');

        $municipalities = $campaign->municipality->pluck('name', 'id')->prepend('Seleccione un departamento antes');

        return view('campaign.edit', compact('campaign', 'departments', 'municipalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $this->validate($request, $campaign->rules());

        $campaign->update($request->all());

        return redirect()->route('campaign.index')->withSuccess(trans('app.success_update'));
    }

    public function close(Request $request, Campaign $campaign)
    {
        $campaign->status = $request->status;

        $campaign->save();

        return response()->json([
            'status' => 'exito',
            'message' => 'Se actualizo correctamente',
            'campaign' => $campaign
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return response()->json([
            'status' => 'exito',
            'message' => 'Se elimino correctamente'
        ], 200);
    }

    public function getCampaigns(Department $department)
    {
        $campaign = $department->campaigns()->with([
            'department' => function ($query) {
                $query->select('id', 'name');
            },
            'municipality' => function ($query) {
                $query->select('id', 'name');
            }
        ])->where('number', 1)->get();

        return datatables($campaign)
            ->addColumn('actions', 'campaign.partials.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function getCampaigns2(Department $department)
    {
        $campaign = $department->campaigns()->with([
            'department' => function ($query) {
                $query->select('id', 'name');
            },
            'municipality' => function ($query) {
                $query->select('id', 'name');
            }
        ])->where('number', 2)->get();

        return datatables($campaign)
            ->addColumn('actions', 'campaign.partials.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
