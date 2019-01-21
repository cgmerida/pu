<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use App\Department;
use App\Municipality;

class CandidatesTableSeeder extends CsvSeeder
{

    /**
     * Constructor para los estandares.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'candidates';
        $this->filename = base_path() . '/database/seeds/csvs/candidatos.csv';
        $this->csv_delimiter = ';';
        $this->should_trim = true;
        $this->timestamps = true;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recommended when importing larger CSVs
        // DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        // DB::table($this->table)->truncate();

        parent::run();
    }

    public function insert(array $seedData)
    {
        if ($this->timestamps) {
            $new = [];
            foreach ($seedData as $key => $item) {
                $new[$key] = $item;
                $department = Department::where('name', '=', $new[$key]['department_id'])->first();
                if (!$department) {
                    $department = Department::create(['name' => $new[$key]['department_id']]);
                }

                $municipality = Municipality::where('name', '=', $new[$key]['municipality_id'])->first();
                if (!$municipality) {
                    $municipality = Municipality::create(['name' => $new[$key]['municipality_id']]);
                }

                $new[$key]['name'] = ucwords(strtolower($new[$key]['name']));

                $new[$key]['department_id'] = $department->id;
                $new[$key]['municipality_id'] = $municipality->id;
                
                $new[$key]['created_at'] = \Carbon\Carbon::now();
                $new[$key]['updated_at'] = \Carbon\Carbon::now();
            }
            $seedData = $new;
        }
        try {
            DB::table($this->table)->insert($seedData);
        } catch (\Exception $e) {
            Log::error("Fallo la insercion en la base de datos: " . $e->getMessage() . " - CSV " . $this->filename);
            return false;
        }
        return true;
    }
}
