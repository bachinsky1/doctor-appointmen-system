<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Bouncer;
use App\Models\MediaFile;
use App\Models\Agenda;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('admin')->everything();
        Bouncer::allow('patient')->to('edit-profile', User::class);
        Bouncer::allow('healthcare')->toOwn(MediaFile::class)->to(['list', 'view', 'create', 'edit', 'delete']);
        Bouncer::allow('healthcare')->toOwn(Agenda::class)->to(['list', 'view', 'create', 'edit', 'delete']);
    }
}