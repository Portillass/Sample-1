<?php

namespace App\Console\Commands;

use Bican\Roles\Models\Role;
use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sistem için gerekli tabloları ekler, kullanıcı rollerini oluşturur ve örnek veri girer.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        $this->info('+---------------------------+');
        $this->info('| Çukurova Üniversitesi     |');
        $this->info('| ÖBS Öğrenci Bilgi Sistemi |');
        $this->info('+---------------------------+');
        $this->info('');

        $this->info('Bu işlem yeni bir kurulum yapacak, eski veriler varsa tamamen silinecek!');

        if ($this->confirm('Emin misiniz?')) {

            $this->info('Tablolar kuruluyor (Autobots, roll out!)');

            $this->call('migrate:refresh');

            $this->info('Tablolar kuruldu. Roller oluşturuluyor...');

            $admin = new Role();
            $admin->name = 'Admin';
            $admin->slug = 'admin';
            $admin->description = 'Süper Admin yetkileri dışında tüm yetkilere sahip yönetici';
            $admin->save();

            $secretary = new Role();
            $secretary->name = 'Sekreter';
            $secretary->slug = 'secretary';
            $secretary->description = 'Kısıtlı yetkilere sahip denetçi';
            $secretary->save();

            $lecturer = new Role();
            $lecturer->name = 'Öğretim Görevlisi';
            $lecturer->slug = 'lecturer';
            $lecturer->description = 'Öğretim Görevlisi';
            $lecturer->save();

            $student = new Role();
            $student->name = 'Öğrenci';
            $student->slug = 'student';
            $student->description = 'Öğrenci';
            $student->save();

            $this->info('Roller oluşturuldu. Son olarak hazır veriler işleniyor...');

            $this->call('db:seed');

            $this->info('Kurulum tamamlandı.');

        } else {

            $this->warn('İşlem iptal edildi.');

        }
    }
}
