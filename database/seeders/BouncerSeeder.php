<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Bouncer;
use App\Models\MediaFile;
use App\Models\Agenda;
use App\Models\Billing;
use App\Models\Task;
use App\Models\Statistic;
use App\Models\Appointment;

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
        Bouncer::allow('patient')->toOwn(Appointment::class)->to(['appointment']);

        Bouncer::allow('healthcare')->toOwn(MediaFile::class)->to(['list', 'view', 'create', 'edit', 'delete']);
        Bouncer::allow('healthcare')->toOwn(Agenda::class)->to(['agenda']);
        Bouncer::allow('healthcare')->toOwn(Billing::class)->to(['billing']);
        Bouncer::allow('healthcare')->toOwn(Task::class)->to(['task']);
        Bouncer::allow('healthcare')->toOwn(Statistic::class)->to(['statistic']);
    }
}