<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'code' => '01',
            'name' => 'Bilgisayar Mühendisliği'
        ]);
    }
}
