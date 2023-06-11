<?php
/**
 * This code creates users, roles and permissions in the database. 
 * It creates an administrator user with the email 'clint.eastwood@mail.com', 
 * two health professional users with emails 'lee.van.cliff@mail.com' and 'jean.maria.volonte@mail.com', 
 * and 30 patient users with randomly generated names and unique email addresses.
 * The code also creates three roles: 'administrator', 'health-professional' and 'patient', 
 * and three permissions: 'manage-users', 'create-appointments' and 'manage-appointments'. 
 * The administrator role has the 'manage-users' permission, 
 * while the health professional role has the 'manage-appointments'
 * and 'create-appointments' permissions. 
 * The patient role only has the 'create-appointments' permission.
 * The code uses the Faker library to generate random names and email addresses for the patient users.
 */
namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\ROLES;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $adminRole = Role::where('slug', Roles::ADMIN)->first();
        $healthProfessionalRole = Role::where('slug', Roles::HEALTH_PROFESSIONAL)->first();
        $patientRole = Role::where('slug', Roles::PATIENT)->first();
        
        $manageUsers = Permission::where('slug','manage-users')->first();
        $createAppointments = Permission::where('slug','create-appointments')->first();
        $manageAppointments = Permission::where('slug','manage-appointments')->first();

        // Create fixed admin user
        $admin = new User();
        $admin->firstname = 'Clint';
        $admin->lastname = 'Eastwood';
        $admin->birthdate = $faker->dateTimeInInterval('-70 years', '-20 years', null)->format('Y-m-d');
        $admin->gender = 'M';
        $admin->phone1 = $faker->phoneNumber;
        $admin->phone2 = $faker->phoneNumber;
        $admin->fax = $faker->phoneNumber;
        $admin->email = 'clint.eastwood@mail.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($adminRole);
        $admin->permissions()->attach($manageUsers);

        // Create fixed health professional 1
        $healthProfessional1 = new User();
        $healthProfessional1->firstname = 'Lee';
        $healthProfessional1->lastname = 'Van Cliff';
        $healthProfessional1->birthdate = $faker->dateTimeInInterval('-70 years', '-20 years', null)->format('Y-m-d');
        $healthProfessional1->gender = 'M';
        $healthProfessional1->phone1 = $faker->phoneNumber; 
        $healthProfessional1->email = 'lee.van.cliff@mail.com';
        $healthProfessional1->password = bcrypt('secret');
        $healthProfessional1->save();
        $healthProfessional1->roles()->attach($healthProfessionalRole);
        $healthProfessional1->permissions()->attach($createAppointments);
        $healthProfessional1->permissions()->attach($manageAppointments);

        // Create fixed health professional 2
        $healthProfessional2 = new User();
        $healthProfessional2->firstname = 'Jean Maria';
        $healthProfessional2->lastname = 'Volonte';
        $healthProfessional2->birthdate = $faker->dateTimeInInterval('-70 years', '-20 years', null)->format('Y-m-d');
        $healthProfessional2->gender = 'M';
        $healthProfessional2->phone1 = $faker->phoneNumber;
        $healthProfessional2->email = 'jean.maria.volonte@mail.com';
        $healthProfessional2->password = bcrypt('secret');
        $healthProfessional2->save();
        $healthProfessional2->roles()->attach($healthProfessionalRole); 
        $healthProfessional2->permissions()->attach($manageAppointments);

        // Create fixed patient
        $patient = new User();
        $patient->firstname = 'Elly';
        $patient->lastname = 'Wallah';
        $patient->birthdate = $faker->dateTimeInInterval('-70 years', '-20 years', null)->format('Y-m-d');
        $patient->gender = 'M';
        $patient->phone1 = $faker->phoneNumber;
        $patient->email = 'elly.wallah@mail.com';
        $patient->password = bcrypt('secret');
        $patient->save();
        $patient->roles()->attach($patientRole);
        $patient->permissions()->attach($createAppointments);

        // Create random patients
        // TODO: Need replace to factory
        for ($i=0; $i < 30; $i++) {
            $patient = new User();
            $patient->firstname = $faker->firstNameMale;
            $patient->lastname = $faker->lastName;
            $patient->birthdate = $faker->dateTimeInInterval('-70 years', '-20 years', null)->format('Y-m-d');
            $patient->gender = $faker->randomElement(['M', 'F']);
            $patient->phone1 = $faker->phoneNumber;
            $patient->email = fake()->unique()->safeEmail;
            $patient->password = bcrypt('secret');
            $patient->save();
            $patient->roles()->attach($patientRole);
            $patient->permissions()->attach($createAppointments);
        }
    }
}