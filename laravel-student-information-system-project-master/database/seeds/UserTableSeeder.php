<?php

use Bican\Roles\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Admin
        $admin = User::create([
            'username' => 'admin',
            'password' => bcrypt('123456')
        ]);

        // Sekreter
        $secretary = User::create([
            'username' => 'sekreter',
            'password' => bcrypt('123456')
        ]);

        // Öğrenci
        $student1 = User::create([
            'username' => '001',
            'password' => bcrypt('123456')
        ]);
        $student1->student()->create([
            'name'          => 'Reyyan',
            'surname'       => 'Arık',
            'department_id' => 1,
            'grade' => 4
        ]);

        $student2 = User::create([
            'username' => '002',
            'password' => bcrypt('123456')
        ]);
        $student2->student()->create([
            'name'          => 'Mustafa',
            'surname'       => 'Demir',
            'department_id' => 1,
            'grade' => 4
        ]);

        $student3 = User::create([
            'username' => '003',
            'password' => bcrypt('123456')
        ]);
        $student3->student()->create([
            'name'          => 'Elif',
            'surname'       => 'Doğan',
            'department_id' => 1,
            'grade' => 4
        ]);

        $student4 = User::create([
            'username' => '004',
            'password' => bcrypt('123456')
        ]);
        $student4->student()->create([
            'name'          => 'Kiraz',
            'surname'       => 'Bilgiç',
            'department_id' => 1,
            'grade' => 4
        ]);


        // Öğretim Görevlisi
        $lecturer1 = User::create([
            'username' => 'ahmet.ata@cu.edu.tr',
            'password' => bcrypt('123456')
        ]);
        $lecturer1->lecturer()->create([
            'name'          => 'Ahmet',
            'surname'       => 'Ata',
            'department_id' => 1
        ]);

        $lecturer2 = User::create([
            'username' => 'moral@cu.edu.tr',
            'password' => bcrypt('123456')
        ]);
        $lecturer2->lecturer()->create([
            'name'          => 'Mustafa',
            'surname'       => 'Oral',
            'department_id' => 1
        ]);

        $lecturer3 = User::create([
            'username' => 'uorhan@cu.edu.tr',
            'password' => bcrypt('123456')
        ]);
        $lecturer3->lecturer()->create([
            'name'          => 'Umut',
            'surname'       => 'Orhan',
            'department_id' => 1
        ]);

        // Roller
        $adminRole     = Role::find(1);
        $secretaryRole = Role::find(2);
        $lecturerRole  = Role::find(3);
        $studentRole   = Role::find(4);

        // Atamalar
        $admin->attachRole($adminRole);
        $secretary->attachRole($secretaryRole);

        $student1->attachRole($studentRole);
        $student2->attachRole($studentRole);
        $student3->attachRole($studentRole);
        $student4->attachRole($studentRole);

        $lecturer1->attachRole($lecturerRole);
        $lecturer2->attachRole($lecturerRole);
        $lecturer3->attachRole($lecturerRole);

    }
}
