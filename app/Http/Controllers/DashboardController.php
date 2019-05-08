<?php

namespace App\Http\Controllers;

use App\Central;
use App\Department;
use App\Mayor;
use App\Municipality;
use App\National;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:dashboard.map');
    }

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
        $departments = Department::select('id', 'name as drilldown')
            ->withCount('mayors', 'municipalities')->get()
            ->each(function ($depto) {
                $depto->value = round(($depto->mayors_count / $depto->municipalities_count) * 100);
            });

        return $departments;
    }

    public function municipalitiesMayors(Department $department)
    {

        return $department->municipalities()->with(['mayor' => function ($query) {
            $query->select('id', 'name', 'municipality_id');
        }])->select(['id', 'name'])->withCount([
            'mayor as a',
            'mayor as b' => function ($query) {
                $query->where('nominated', true);
            },
            'mayor as c' => function ($query) {
                $query->where('signed_up', true);
            }
        ])
            ->selectRaw('"muni"')->get()->each(function ($muni) {
                $muni->value = $muni->a + $muni->b + $muni->c;
            });
    }

    public function departmentsDeputies()
    {
        $departments = Department::select('id', 'name as drilldown')->withCount('deputies')->get();

        $departments->each(function ($item) {
            $deputy = $item->deputies->first();

            $a = ($deputy) ? 1 : 0;
            $b = $c = 0;

            if ($deputy) {
                $b = ($deputy->nominated == "Si") ? 1 : 0;
                $c = ($deputy->signed_up == "Si") ? 1 : 0;
            }

            $item->value = $a + $b + $c;
        });

        return $departments;
    }

    public function municipalitiesDeputies(Department $department)
    {
        $deputy = $department->deputies()->first();

        $a = ($deputy) ? 1 : 0;
        $count = $b = $c = 0;

        if ($deputy) {
            $b = ($deputy->nominated == 'Si') ? 1 : 0;
            $c = ($deputy->signed_up == 'Si') ? 1 : 0;
        }

        $count = $a + $b + $c;

        return $department->municipalities()->where('name', '!=', 'Guatemala')->select(['id', 'name'])
            ->selectRaw($count . ' as value')
            ->selectRaw($department->deputies->count() . ' as deputies_count')
            ->get();
    }

    public function departmentsTours()
    {
        $departments = \DB::table('departments')
            ->leftJoin('tours', 'departments.id', '=', 'tours.department_id')
            ->select('departments.id', 'name as drilldown')->selectRaw('COUNT(DISTINCT WEEK(date, 1)) as value')
            ->groupBy('departments.id', 'name')
            ->get();

        return $departments;
    }

    public function municipalitiesTours(Department $department)
    {
        $munis = $department->municipalities()->select('id', 'name')
            ->with(['tours' => function ($query) {
                $query->select('status', 'municipality_id');
            }])->withCount(['tours'])->get();


        $munis->each(function ($item) {
            $tour = $item->tours->first();

            $value = ($tour) ? 1 : 0;

            if ($tour) {
                $value = ($tour->status == "Pendiente") ? 2 : 3;
            }

            $item->value = $value;
        });

        return $munis;
    }

    public function departmentsCampaign()
    {
        $departments = \DB::table('departments')
            ->leftJoin('campaigns', function ($join) {
                $join->on('departments.id', '=', 'campaigns.department_id');
                $join->on('campaigns.number', '=', \DB::raw(1));
            })
            ->select('departments.id', 'name as drilldown')
            ->selectRaw('COUNT(DISTINCT WEEK(date, 1)) as value')
            ->groupBy('departments.id', 'name')
            ->get();

        return $departments;
    }

    public function municipalitiesCampaign(Department $department)
    {
        $munis = $department->municipalities()->select('id', 'name')
            ->with(['campaigns' => function ($query) {
                $query->select('status', 'municipality_id')->where('number', 1);
            }])->withCount(['campaigns as tours_count'])->get();


        $munis->each(function ($item) {
            $campaign = $item->campaigns->first();

            $value = ($campaign) ? 1 : 0;

            if ($campaign) {
                $value = ($campaign->status == "Pendiente") ? 2 : 3;
            }

            $item->value = $value;
        });

        return $munis;
    }

    public function departmentsDepartmentCampaign()
    {
        // $departments = \DB::table('departments')
        //     ->leftJoin('department_campaigns', 'departments.id', '=', 'department_campaigns.department_id')
        //     ->select('departments.id', 'name')->selectRaw('COUNT(DISTINCT WEEK(date, 1)) as value')
        //     ->groupBy('departments.id', 'name')
        //     ->get();

        $departments = Department::select('id', 'name')->withCount('departmentCampaigns as value')->get();

        return $departments;
    }


    public function paisStadisticsLegals()
    {
        $e = new \stdClass();
        $e->departamentos = Department::count();
        $e->departamentosLegales = Department::whereLegal(1)->count();
        $e->departamentosLegales_per = round(($e->departamentosLegales / max($e->departamentos, 1)) * 100, 2);

        $e->municipios = Municipality::count();
        $e->municipiosLegales = Municipality::whereLegal(1)->count();
        $e->municipiosLegales_per = round(($e->municipiosLegales / max($e->municipios, 1)) * 100, 2);

        return response()->json($e, 200);
    }

    public function deptoStadisticsLegals(Department $department)
    {
        $e = new \stdClass();
        $e->municipios = $department->municipalities()->count();

        $e->municipiosLegales = $department->municipalities()->whereLegal(1)->count();
        $e->municipiosLegales_per = round(($e->municipiosLegales / max($e->municipios, 1)) * 100, 2);

        return response()->json($e, 200);
    }

    public function paisStadisticsPrimes()
    {
        $e = new \stdClass();
        $e->departamentos = Department::count();
        $e->departamentosPrimes = Department::wherePrime(1)->count();
        $e->departamentosPrimes_per = round(($e->departamentosPrimes / max($e->departamentos, 1)) * 100, 2);

        $e->municipios = Municipality::count();
        $e->municipiosPrimes = Municipality::wherePrime(1)->count();
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

    public function paisStadisticsDeputies()
    {
        $e = new \stdClass();

        $e->diputados = National::all();
        $e->diputadosTotal = National::count();

        return response()->json($e, 200);
    }

    public function deptoStadisticsDeputies(Department $department)
    {
        $e = new \stdClass();

        $e->diputados = $department->deputies;
        $e->diputadosTotal = $department->deputies->count();

        if ($department->name == "Guatemala") {
            $e->diputadosCentral = Central::all();
            $e->diputadosCentralTotal = Central::count();
        }

        return response()->json($e, 200);
    }

    public function paisStadisticsMayors()
    {
        $e = new \stdClass();
        $e->municipios = Municipality::count();
        $e->municipiosLegales = Municipality::whereLegal(1)->count();
        $e->municipiosNoLegales = Municipality::whereLegal(0)->count();

        // GRAFICAS DE CANDIDATOS
        $e->alcaldesLegales = Mayor::whereHas('municipality', function ($query) {
            $query->whereLegal(1);
        })->count();
        $e->alcaldesLegales_per = round(($e->alcaldesLegales / max($e->municipiosLegales, 1)) * 100, 2);

        $e->alcaldesNoLegales = Mayor::whereHas('municipality', function ($query) {
            $query->whereLegal(0);
        })->count();
        $e->alcaldesNoLegales_per = round(($e->alcaldesNoLegales / max($e->municipiosNoLegales, 1)) * 100, 2);

        $e->alcaldes = Mayor::count();
        $e->alcaldes_per = round(($e->alcaldes / max($e->municipios, 1)) * 100, 2);

        // GRAFICAS DE NOMINADOS
        $e->nominadosLegales = Mayor::whereNominated(1)->whereHas('municipality', function ($query) {
            $query->whereLegal(1);
        })->count();

        $e->nominadosLegales_per = round(($e->nominadosLegales / max($e->municipiosLegales, 1)) * 100, 2);

        $e->nominadosNoLegales = Mayor::whereNominated(1)->whereHas('municipality', function ($query) {
            $query->whereLegal(0);
        })->count();
        $e->nominadosNoLegales_per = round(($e->nominadosNoLegales / max($e->municipiosNoLegales, 1)) * 100, 2);

        $e->nominados = Mayor::whereNominated(1)->count();
        $e->nominados_per = round(($e->nominados / max($e->municipios, 1)) * 100, 2);

        // GRAFICAS DE INSCRITOS
        $e->inscritosLegales = Mayor::whereSignedUp(1)->whereHas('municipality', function ($query) {
            $query->whereLegal(1);
        })->count();

        $e->inscritosLegales_per = round(($e->inscritosLegales / max($e->municipiosLegales, 1)) * 100, 2);

        $e->inscritosNoLegales = Mayor::whereSignedUp(1)->whereHas('municipality', function ($query) {
            $query->whereLegal(0);
        })->count();
        $e->inscritosNoLegales_per = round(($e->inscritosNoLegales / max($e->municipiosNoLegales, 1)) * 100, 2);

        $e->inscritos = Mayor::whereSignedUp(1)->count();
        $e->inscritos_per = round(($e->inscritos / max($e->municipios, 1)) * 100, 2);

        return response()->json($e, 200);
    }

    public function deptoStadisticsMayors(Department $department)
    {
        $e = new \stdClass();
        $e->municipiosLegales = $department->municipalities()->whereLegal(1)->count();
        $e->municipiosNoLegales = $department->municipalities()->whereLegal(0)->count();
        $e->municipios = $department->municipalities()->count();

        // GRAFICAS DE CANDIDATOS
        $e->alcaldesLegales = $department->mayors()->whereHas('municipality', function ($query) {
            $query->whereLegal(1);
        })->count();
        $e->alcaldesLegales_per = round(($e->alcaldesLegales / max($e->municipiosLegales, 1)) * 100, 2);

        $e->alcaldesNoLegales = $department->mayors()->whereHas('municipality', function ($query) {
            $query->whereLegal(0);
        })->count();
        $e->alcaldesNoLegales_per = round(($e->alcaldesNoLegales / max($e->municipiosNoLegales, 1)) * 100, 2);

        $e->alcaldes = $department->mayors()->count();
        $e->alcaldes_per = round(($e->alcaldes / max($e->municipios, 1)) * 100, 2);

        // GRAFICAS DE NOMINADOS
        $e->nominadosLegales = $department->mayors()->whereNominated(1)->whereHas('municipality', function ($query) {
            $query->whereLegal(1);
        })->count();
        $e->nominadosLegales_per = round(($e->nominadosLegales / max($e->municipiosLegales, 1)) * 100, 2);

        $e->nominadosNoLegales = $department->mayors()->whereNominated(1)->whereHas('municipality', function ($query) {
            $query->whereLegal(0);
        })->count();
        $e->nominadosNoLegales_per = round(($e->nominadosNoLegales / max($e->municipiosNoLegales, 1)) * 100, 2);

        $e->nominados = $department->mayors()->whereNominated(1)->count();
        $e->nominados_per = round(($e->nominados / max($e->municipios, 1)) * 100, 2);

        // GRAFICAS DE INSCRITOS
        $e->inscritosLegales = $department->mayors()->whereSignedUp(1)->whereHas('municipality', function ($query) {
            $query->whereLegal(1);
        })->count();

        $e->inscritosLegales_per = round(($e->inscritosLegales / max($e->municipiosLegales, 1)) * 100, 2);

        $e->inscritosNoLegales = $department->mayors()->whereSignedUp(1)->whereHas('municipality', function ($query) {
            $query->whereLegal(0);
        })->count();
        $e->inscritosNoLegales_per = round(($e->inscritosNoLegales / max($e->municipiosNoLegales, 1)) * 100, 2);

        $e->inscritos = $department->mayors()->whereSignedUp(1)->count();
        $e->inscritos_per = round(($e->inscritos / max($e->municipios, 1)) * 100, 2);

        return response()->json($e, 200);
    }


    public function paisStadisticsTours()
    {

        $e = new \stdClass();
        $e->municipios = Municipality::count();

        // Municipiios con Gira
        $e->municipiosGira = Municipality::has('tours')->count();
        $e->municipiosGira_per = round(($e->municipiosGira / max($e->municipios, 1)) * 100, 2);

        // Municipios con gira Pendiente
        $e->municipiosGiraPendiente = Municipality::whereHas('tours', function ($query) {
            $query->whereStatus('Pendiente');
        })->count();
        $e->municipiosGiraPendiente_per = round(($e->municipiosGiraPendiente / max($e->municipios, 1)) * 100, 2);

        // Municipios con gira Realizada
        $e->municipiosGiraRealizada = Municipality::whereHas('tours', function ($query) {
            $query->whereStatus('Realizada');
        })->count();
        $e->municipiosGiraRealizada_per = round(($e->municipiosGiraRealizada / max($e->municipios, 1)) * 100, 2);

        return response()->json($e, 200);
    }


    public function deptoStadisticsTours(Department $department)
    {

        $e = new \stdClass();
        $e->municipios = $department->municipalities()->count();

        // Municipiios con Gira
        $e->municipiosGira = $department->municipalities()->has('tours')->count();
        $e->municipiosGira_per = round(($e->municipiosGira / max($e->municipios, 1)) * 100, 2);

        // Municipios con gira Pendiente
        $e->municipiosGiraPendiente = $department->municipalities()->whereHas('tours', function ($query) {
            $query->whereStatus('Pendiente');
        })->count();
        $e->municipiosGiraPendiente_per = round(($e->municipiosGiraPendiente / max($e->municipios, 1)) * 100, 2);

        // Municipios con gira Realizada
        $e->municipiosGiraRealizada = $department->municipalities()->whereHas('tours', function ($query) {
            $query->whereStatus('Realizada');
        })->count();
        $e->municipiosGiraRealizada_per = round(($e->municipiosGiraRealizada / max($e->municipios, 1)) * 100, 2);


        return response()->json($e, 200);
    }

    public function paisStadisticsDepartmentCampaign()
    {
        $e = new \stdClass();
        // $e->dates = $department->departmentCampaigns()->select('id', 'department_id', 'date as name');

        return response()->json($e, 200);
    }

    public function deptoStadisticsDepartmentCampaign(Department $department)
    {
        date_default_timezone_set('America/Guatemala');
        // Unix
        setlocale(LC_TIME, 'es_ES.UTF-8');
        
        // setlocale(LC_TIME, 'spanish');

        $e = new \stdClass();
        // $e->name = $department->departmentCampaigns->select('date');
        $e->dates = $department->departmentCampaigns()->select('date as name')->get()
        ->each(function ($depto) {
            // \Carbon\Carbon::setLocale('es');
            $depto->name = strftime("%A, %d de %B", strtotime($depto->name));
            // \Carbon\Carbon::parse($depto->name)->formatLocalized('%A, %d. %B %Y');
        });;

        

        return response()->json($e, 200);
    }
}
