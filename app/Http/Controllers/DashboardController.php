<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use App\Municipality;
use App\Department;

class DashboardController extends Controller
{
    public function index()
    {
        $e = $this->paisStadistics(true);

        return view('admin.dashboard.index', compact('e'));
    }

    public function municipalitiesLegal(Department $department)
    {
        return $department->municipalities()->select('name', 'legal as value')->withCount('candidates')->get();
    }

    public function departmentsLegal()
    {
        $departments = Department::select('id', 'name as drilldown', 'legal as value')->withCount('candidates')->get();
        $departments[12]->drilldown = 'Quezaltenango';
        
        return $departments;
    }

    public function deptoStadistics(Department $department)
    {
        $e = new \stdClass();
        $e->alcaldes = $department->candidates()->count();
        $e->municipios = $department->municipalities()->count();
        $e->alcaldes_per = round(($e->alcaldes / $e->municipios) * 100, 2);
        $e->municipiosLegales = $department->municipalities()->whereLegal(1)->count();
        $e->municipiosLegales_per = round(($e->municipiosLegales / $e->municipios) * 100, 2);

        return response()->json($e, 200);
    }

    public function paisStadistics($object = false)
    {
        $e = new \stdClass();
        $e->alcaldes = Candidate::count();
        $e->municipios = Municipality::count();
        $e->alcaldes_per = round(($e->alcaldes / $e->municipios) * 100, 2);
        $e->municipiosLegales = Municipality::whereLegal(1)->count();
        $e->municipiosLegales_per = round(($e->municipiosLegales / $e->municipios) * 100, 2);

        if ($object) {
            return $e;
        }
        return response()->json($e, 200);
    }
}
