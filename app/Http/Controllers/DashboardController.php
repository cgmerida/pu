<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mayor;
use App\Municipality;
use App\Department;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tipo = ($request->tipo ?? 'legals');

        return view('admin.dashboard.index', compact('tipo'));
    }

    public function departmentsLegals()
    {
        $departments = Department::select('id', 'name as drilldown', 'legal as value')->withCount('mayors')->get();

        return $departments;
    }

    public function municipalitiesLegals(Department $department)
    {

        return $department->municipalities()->with(['mayor' => function ($query) {
            $query->select('id', 'name', 'municipality_id');
        }])->select(['id', 'name', 'legal as value'])->get();
    }

    public function departmentsPrimes()
    {
        $departments = Department::select('id', 'name as drilldown', 'prime as value')->withCount('mayors')->get();

        return $departments;
    }

    public function municipalitiesPrimes(Department $department)
    {

        return $department->municipalities()->with(['mayor' => function ($query) {
            $query->select('id', 'name', 'municipality_id');
        }])->select(['id', 'name', 'prime as value'])->get();
    }


    public function departmentsMayors()
    {
        $departments = Department::select('id', 'name as drilldown')->withCount('mayors as value')->get();

        return $departments;
    }

    public function municipalitiesMayors(Department $department)
    {

        return $department->municipalities()->with(['mayor' => function ($query) {
            $query->select('id', 'name', 'municipality_id');
        }])->select(['id', 'name'])->withCount('mayor as value')->selectRaw('"muni"')->get();
    }

    public function departmentsDeputies()
    {
        $departments = Department::select('id', 'name as drilldown')->withCount('deputies as value')->get();

        return $departments;
    }

    public function municipalitiesDeputies(Department $department)
    {
        $count = $department->whereName($department->name)
            ->withCount('deputies as value')->first();
        return $department->municipalities()->select(['id', 'name'])
            ->selectRaw($count->value . ' as value')->get();
    }

    public function departmentsTours()
    {
        $departments = Department::select("id", "name as drilldown")->selectRaw('0 as value')->get();

        return $departments;
    }

    public function municipalitiesTours(Department $department)
    {

        return $department->municipalities()->with(['mayor' => function ($query) {
            $query->select('id', 'name', 'municipality_id');
        }])->select('id', 'name', 'prime as value')->selectRaw('0 as value')->get();
    }

    public function paisStadisticsLegals($object = false)
    {
        $e = new \stdClass();
        $e->alcaldes = Mayor::count();
        $e->municipios = Municipality::count();
        $e->alcaldes_per = round(($e->alcaldes / max($e->municipios, 1)) * 100, 2);

        $e->municipiosLegales = Municipality::whereLegal(1)->count();
        $e->municipiosLegales_per = round(($e->municipiosLegales / max($e->municipios, 1)) * 100, 2);

        // $e->alcaldesLegales = Mayor::whereHas('municipality', function ($query) {
        //     $query->whereLegal(1);
        // })->count();
        // $e->alcaldesLegales_per = round(($e->alcaldesLegales / max($e->municipiosLegales, 1)) * 100, 2);

        // $e->alcaldesNoLegales = Mayor::whereHas('municipality', function ($query) {
        //     $query->whereLegal(0);
        // })->count();
        // $e->municipiosNoLegales = Municipality::whereLegal(0)->count();
        // $e->alcaldesNoLegales_per = round(($e->alcaldesNoLegales / max($e->municipiosNoLegales, 1)) * 100, 2);

        // if ($object) {
        //     return $e;
        // }
        return response()->json($e, 200);
    }

    public function deptoStadisticsLegals(Department $department)
    {
        $e = new \stdClass();
        $e->alcaldes = $department->mayors()->count();
        $e->municipios = $department->municipalities()->count();
        $e->alcaldes_per = round(($e->alcaldes / max($e->municipios, 1)) * 100, 2);

        $e->municipiosLegales = $department->municipalities()->whereLegal(1)->count();
        $e->municipiosLegales_per = round(($e->municipiosLegales / max($e->municipios, 1)) * 100, 2);

        // $e->alcaldesLegales = $department->mayors()->whereHas('municipality', function ($query) {
        //     $query->whereLegal(1);
        // })->count();
        // $e->alcaldesLegales_per = round(($e->alcaldesLegales / max($e->municipiosLegales, 1)) * 100, 2);

        // $e->alcaldesNoLegales = $department->mayors()->whereHas('municipality', function ($query) {
        //     $query->whereLegal(0);
        // })->count();
        // $e->municipiosNoLegales = $department->municipalities()->whereLegal(0)->count();
        // $e->alcaldesNoLegales_per = round(($e->alcaldesNoLegales / max($e->municipiosNoLegales, 1)) * 100, 2);

        return response()->json($e, 200);
    }

    public function paisStadisticsPrimes($object = false)
    {
        $e = new \stdClass();

        $e->municipios = Department::count();

        $e->municipiosPrimes = Department::wherePrime(1)->count();
        $e->municipiosPrimes_per = round(($e->municipiosPrimes / max($e->municipios, 1)) * 100, 2);

        return response()->json($e, 200);
    }

    public function deptoStadisticsPrimes(Department $department)
    {
        $e = new \stdClass();

        $e->municipios = $department->municipalities()->count();

        $e->municipiosPrimes = $department->municipalities()->wherePrime(1)->count();
        $e->municipiosPrimes_per = round(($e->municipiosPrimes / max($e->municipios, 1)) * 100, 2);

        return response()->json($e, 200);
    }

    public function paisStadisticsDeputies($object = false)
    {
        $e = new \stdClass();

        // $e->diputados = National::all();
        // $e->diputadosTotal = National::count();

        return response()->json($e, 200);
    }

    public function deptoStadisticsDeputies(Department $department)
    {
        $e = new \stdClass();

        $e->diputados = $department->deputies();
        $e->diputadosTotal = $department->deputies()->count();

        return response()->json($e, 200);
    }
}
