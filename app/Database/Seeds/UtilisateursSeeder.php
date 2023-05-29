<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UtilisateursSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom' => 'John Doe',
                'email' => 'johndoe@example.com',
                'motdepass' => password_hash('password', PASSWORD_DEFAULT),
            ],
            // Add more users here...
        ];

        // Uncomment the following line if you want to delete existing data
        // $this->db->table('utilisateurs')->truncate();

        $this->db->table('utilisateurs')->insertBatch($data);
    }
}