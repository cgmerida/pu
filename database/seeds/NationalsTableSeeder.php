<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class NationalsTableSeeder extends CsvSeeder
{
    
    /**
     * Constructor para los estandares.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'nationals';
        $this->filename = base_path() . '/database/seeds/csvs/nacional.csv';
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

                $new[$key]['name'] = mb_convert_case($new[$key]['name'], MB_CASE_TITLE, "UTF-8");

                $new[$key]['created_at'] = \Carbon\Carbon::now();
                $new[$key]['updated_at'] = \Carbon\Carbon::now();
            }
            $seedData = $new;
        }
        try {
            DB::table($this->table)->insert($seedData);
        } catch (\Exception $e) {
            Log::error("Fallo la insercion en la base de datos: " . $e->getMessage() . " - CSV " . $this->filename);
            $this->command->error($e->getMessage());
            return false;
        }
        return true;
    }
}
