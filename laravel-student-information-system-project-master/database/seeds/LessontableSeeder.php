<?php

use App\Lesson;
use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::create([
            'name'        => 'Mikroişlemciler',
            'code'        => 'BIL 336',
            'credit'      => 6,
            'lecturer_id' => 1,
            'grade'       => 4,
            'semester'    => 1
        ]);

        Lesson::create([
            'name'        => 'Sayısal Görüntü İşleme',
            'code'        => 'BIL 405',
            'credit'      => 6,
            'lecturer_id' => 2,
            'grade'       => 4,
            'semester'    => 1
        ]);

        Lesson::create([
            'name'        => 'Otomata Teorileri',
            'code'        => 'BIL 415',
            'credit'      => 6,
            'lecturer_id' => 3,
            'grade'       => 4,
            'semester'    => 1
        ]);

    }
}
