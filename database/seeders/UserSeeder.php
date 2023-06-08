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

use App\Models\Role;
use App\Models\User;
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
        $adminRole = Role::where('slug', ROLES::ADMIN)->first();
        $healthProfessionalRole = Role::where('slug', ROLES::HEALTH_PROFESSIONAL)->first();
        $patientRole = Role::where('slug', ROLES::PATIENT)->first();
        
        $manageUsers = Permission::where('slug','manage-users')->first();
        $createAppointments = Permission::where('slug','create-appointments')->first();
        $manageAppointments = Permission::where('slug','manage-appointments')->first();

        $admin = new User();
        $admin->name = 'Clint Eastwood';
        $admin->email = 'clint.eastwood@mail.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($adminRole);
        $admin->permissions()->attach($manageUsers);

        $healthProfessional1 = new User();
        $healthProfessional1->name = 'Lee Van Cliff';
        $healthProfessional1->email = 'lee.van.cliff@mail.com';
        $healthProfessional1->password = bcrypt('secret');
        $healthProfessional1->save();
        $healthProfessional1->roles()->attach($healthProfessionalRole);
        $healthProfessional1->permissions()->attach($createAppointments);
        $healthProfessional1->permissions()->attach($manageAppointments);

        $healthProfessional2 = new User();
        $healthProfessional2->name = 'Jean Maria Volonte';
        $healthProfessional2->email = 'jean.maria.volonte@mail.com';
        $healthProfessional2->password = bcrypt('secret');
        $healthProfessional2->save();
        $healthProfessional2->roles()->attach($healthProfessionalRole); 
        $healthProfessional2->permissions()->attach($manageAppointments);

        $patient = new User();
        $patient->name = 'Elly Wallah';
        $patient->email = 'elly.wallah@mail.com';
        $patient->password = bcrypt('secret');
        $patient->save();
        $patient->roles()->attach($patientRole);
        $patient->permissions()->attach($createAppointments);

        // TODO: Need replace to factory
        for ($i=0; $i < 30; $i++) {
            $patient = new User();
            $faker = Faker::create();
            $patient->name = $faker->name;
            $patient->email = fake()->unique()->safeEmail();
            $patient->password = bcrypt('secret');
            $patient->save();
            $patient->roles()->attach($patientRole);
            $patient->permissions()->attach($createAppointments);
        }
    }
}