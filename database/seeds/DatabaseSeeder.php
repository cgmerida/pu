<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);

        $this->call(DepartmentsTableSeeder::class);

        $this->call(MunicipalitiesTableSeeder::class);

        $this->call(MayorsTableSeeder::class);

        $this->call(DeputiesTableSeeder::class);

        $this->call(NationalsTableSeeder::class);
    }
}
