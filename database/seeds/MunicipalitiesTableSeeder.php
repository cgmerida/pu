<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use App\Department;

class MunicipalitiesTableSeeder extends CsvSeeder
{

    /**
     * Constructor para los estandares.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'municipalities';
        $this->filename = base_path() . '/database/seeds/csvs/municipios.csv';
        $this->csv_delimiter = ';';
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
        $new = [];
        foreach ($seedData as $key => $item) {
            $new[$key] = $item;
            $department = Department::whereName($new[$key]['department_id'])->first();
            if (!$department) {
                $department = Department::create(['name' => $new[$key]['department_id']]);
            }
            $new[$key]['department_id'] = $department->id;
        }
        $seedData = $new;
        try {
            DB::table($this->table)->insert($seedData);
        } catch (\Exception $e) {
            Log::error("Fallo la insercion en la base de datos: " . $e->getMessage() . " - CSV " . $this->filename);
            return false;
        }
        return true;
    }
}
