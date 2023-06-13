<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialities = [
            'Cardiology',
            'Surgery',
            'Dermatology',
            'Endocrinology',
            'Gastroenterology',
            'Geriatrics',
            'Gynecology',
            'Hematology',
            'Hepatology',
            'Infectiology',
            'General medicine',
            'Internal Medicine',
            'Nephrology',
            'Neurology',
            'Oncology',
            'Ophthalmology',
            'Orthopedics',
            'Otorhinolaryngology',
            'Pediatrics',
            'Psychiatry',
            'Pulmonology',
            'Rheumatology',
            'Urology',
            'Vascular medicine',
            'Anesthesiology',
            'Emergency medicine',
            'Family medicine',
            'Intensive care medicine',
            'Neonatology',
            'Nuclear medicine',
            'Occupational medicine',
            'Palliative medicine',
            'Physical medicine and rehabilitation',
            'Preventive medicine',
            'Sports medicine',
            'Allergology',
            'Angiology',
            'Andrology',
            'Aviation medicine',
            'Clinical immunology',
            'Clinical pharmacology',
            'Clinical neurophysiology',
            'Cosmetic surgery',
            'Diving medicine',
            'Forensic medicine',
            'General practice',
            'Hospital medicine',
            'Medical genetics',
            'Medical toxicology',
            'Military medicine',
            'Pain management',
            'Phlebology',
            'Sleep medicine',
            'Travel medicine',
            'Tropical medicine',
            'Virology',
            'Dermatovenereology',
            'Neurosurgery',
        ];


        foreach ($specialities as $speciality) {
            $sp = new Speciality();
            $sp->name = $speciality;
            $sp->save();
        }
    }
}
