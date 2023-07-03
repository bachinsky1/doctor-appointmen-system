<?php

namespace Database\Seeders;

use App\Models\User;
use Bouncer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $user = User::factory(1)->create(
            [
                'first_name' => 'Clint',
                'last_name' => 'Eastwood',
                'birthdate' => $faker->dateTimeInInterval('-70 years', '-20 years', null)->format('Y-m-d'),
                'gender' => 'M',
                'phone1' => $faker->phoneNumber,
                'phone2' => $faker->phoneNumber,
                'email' => 'clint.eastwood@mail.com',
                'email_verified_at' => null,
                'password' => bcrypt('password')
            ]
        );

        Bouncer::assign('admin')->to($user->first());

        $user = User::factory(1)->create(
            [
                'first_name' => 'Lee',
                'last_name' => 'Van Cliff',
                'birthdate' => $faker->dateTimeInInterval('-70 years', '-20 years', null)->format('Y-m-d'),
                'gender' => 'M',
                'phone1' => $faker->phoneNumber,
                'phone2' => $faker->phoneNumber,
                'email' => 'lee.van.cliff@mail.com',
                'email_verified_at' => null,
                'password' => bcrypt('password')
            ]
        );

        Bouncer::assign('healthcare')->to($user->first());

        $user = User::factory(1)->create(
            [
                'first_name' => 'Jean Maria',
                'last_name' => 'Volonte',
                'birthdate' => $faker->dateTimeInInterval('-70 years', '-20 years', null)->format('Y-m-d'),
                'gender' => 'M',
                'phone1' => $faker->phoneNumber,
                'phone2' => $faker->phoneNumber,
                'email' => 'jean.maria.volonte@mail.com',
                'email_verified_at' => null,
                'password' => bcrypt('password')
            ]
        );

        Bouncer::assign('healthcare')->to($user->first());

        $user = User::factory(1)->create(
            [
                'first_name' => 'Eli',
                'last_name' => 'Wallach',
                'birthdate' => $faker->dateTimeInInterval('-70 years', '-20 years', null)->format('Y-m-d'),
                'gender' => 'M',
                'phone1' => $faker->phoneNumber,
                'phone2' => $faker->phoneNumber,
                'email' => 'eli.wallach@mail.com',
                'email_verified_at' => null,
                'password' => bcrypt('password')
            ]
        );

        Bouncer::assign('healthcare')->to($user->first());

        $user = User::factory(1)->create(
            [
                'first_name' => 'Ennio',
                'last_name' => 'Morricone',
                'birthdate' => $faker->dateTimeInInterval('-70 years', '-20 years', null)->format('Y-m-d'),
                'gender' => 'M',
                'phone1' => $faker->phoneNumber,
                'phone2' => $faker->phoneNumber,
                'email' => 'ennio.morricone@mail.com',
                'email_verified_at' => null,
                'password' => bcrypt('password')
            ]
        );

        Bouncer::assign('patient')->to($user->first());

        $others = User::factory(1000)->create();

        foreach ($others as $model) {
            Bouncer::assign('healthcare')->to($model);
        }

        $others = User::factory(3000)->create();

        foreach ($others as $model) {
            Bouncer::assign('patient')->to($model);
        }
    }
}