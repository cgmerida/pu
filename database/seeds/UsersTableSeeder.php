<?php

use Illuminate\Database\Seeder;

use App\User;
use Caffeinated\Shinobi\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Gerardo';
        $user->lastname = 'Mérida';
        $user->email = 'cgemerida@gmail.com';
        $user->username = 'gmerida';
        $user->password = '123456';
        $user->save();

        Role::create([
            'name' => 'Administrador del sistema',
            'slug' => 'admin',
            'description' => 'Usuario administrador',
            'special' => 'all-access'
        ]);

        $user->roles()->attach(1);
    }
}
