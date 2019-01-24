<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mayor;
use App\Municipality;
use App\Department;

class DashboardController extends Controller
{
    public function index()
    {
        $e = $this->paisStadistics(true);

        return view('admin.dashboard.index', compact('e'));
    }

    public function departmentsLegal()
    {
        $departments = Department::select('id', 'name as drilldown', 'legal as value')->withCount('mayors')->get();
        $departments[12]->drilldown = 'Quezaltenango';
        
        return $departments;
    }

    public function municipalitiesLegal(Department $department)
    {

        return $department->municipalities()->with(['mayor' => function ($query) {
            $query->select('id', 'name', 'municipality_id');
        }])->select(['id', 'name', 'legal as value'])->get();
    }

    public function departmentsPrime()
    {
        $departments = Department::select('id', 'name as drilldown', 'prime as value')->withCount('mayors')->get();
        $departments[12]->drilldown = 'Quezaltenango';

        return $departments;
    }

    public function municipalitiesPrime(Department $department)
    {

        return $department->municipalities()->with(['mayor' => function ($query) {
            $query->select('id', 'name', 'municipality_id');
        }])->select(['id', 'name', 'prime as value'])->get();
    }


    public function paisStadistics($object = false)
    {
        $e = new \stdClass();
        $e->alcaldes = Mayor::count();
        $e->municipios = Municipality::count();
        $e->alcaldes_per = round(($e->alcaldes / max($e->municipios, 1)) * 100, 2);

        $e->municipiosLegales = Municipality::whereLegal(1)->count();
        $e->municipiosLegales_per = round(($e->municipiosLegales / max($e->municipios, 1)) * 100, 2);

        $e->alcaldesLegales = Mayor::whereHas('municipality', function ($query) {
            $query->whereLegal(1);
        })->count();
        $e->alcaldesLegales_per = round(($e->alcaldesLegales / max($e->municipiosLegales, 1)) * 100, 2);

        $e->alcaldesNoLegales = Mayor::whereHas('municipality', function ($query) {
            $query->whereLegal(0);
        })->count();
        $e->municipiosNoLegales = Municipality::whereLegal(0)->count();
        $e->alcaldesNoLegales_per = round(($e->alcaldesNoLegales / max($e->municipiosNoLegales, 1)) * 100, 2);

        if ($object) {
            return $e;
        }
        return response()->json($e, 200);
    }

    public function deptoStadistics(Department $department)
    {
        $e = new \stdClass();
        $e->alcaldes = $department->mayors()->count();
        $e->municipios = $department->municipalities()->count();
        $e->alcaldes_per = round(($e->alcaldes / max($e->municipios, 1)) * 100, 2);

        $e->municipiosLegales = $department->municipalities()->whereLegal(1)->count();
        $e->municipiosLegales_per = round(($e->municipiosLegales / max($e->municipios, 1)) * 100, 2);

        $e->alcaldesLegales = $department->mayors()->whereHas('municipality', function ($query) {
            $query->whereLegal(1);
        })->count();
        $e->alcaldesLegales_per = round(($e->alcaldesLegales / max($e->municipiosLegales, 1)) * 100, 2);

        $e->alcaldesNoLegales = $department->mayors()->whereHas('municipality', function ($query) {
            $query->whereLegal(0);
        })->count();
        $e->municipiosNoLegales = $department->municipalities()->whereLegal(0)->count();
        $e->alcaldesNoLegales_per = round(($e->alcaldesNoLegales / max($e->municipiosNoLegales, 1)) * 100, 2);

        return response()->json($e, 200);
    }
}
