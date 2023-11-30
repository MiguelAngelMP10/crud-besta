<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeopleSeeder extends Seeder
{
    public function run(): void
    {
        $genderData = [
            [
                'name' => 'Male',
            ],
            [
                'name' => 'Female',
            ],
        ];

       // $genders = $this->db->table('gender')->insertBatch($genderData);

        $data = [
            [
                'name' => 'John',
                'last_name' => 'Doe',
                'middle_name' => 'M',
                'age' => 30,
                'gender_id' => 1,
            ],
            [
                'name' => 'Miguel Angel',
                'last_name' => 'Muñoz',
                'middle_name' => 'Pozos',
                'age' => 30,
                'gender_id' => 1,
            ],
        ];

        $this->db->table('people')->insertBatch($data);
    }
}
