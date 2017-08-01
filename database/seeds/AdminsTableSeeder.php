<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();

        factory('App\Models\Admin', 1)->create([
            'name'     => 'admin',
            'password' => bcrypt('admin'),
        ]);
    }
}
