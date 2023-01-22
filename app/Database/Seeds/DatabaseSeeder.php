<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    public function run()
    {   
        $role_id_admin = Uuid::uuid4();
        $role_id_petugas = Uuid::uuid4();

        $data_role = [
            [
                'id' => $role_id_admin,
                'role' => 'admin',
            ],
            [
                'id' => $role_id_petugas,
                'role' => 'petugas',
            ],
        ];

        $this->db->table('roles')->insertBatch($data_role);

        /* Data users */
        $data_users = [
            [
                'id' => Uuid::uuid4(),
                'username' => 'admin',
                'name' => 'Vivy Diva',
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'phone' => '085624804713',
                'role_id' => $role_id_admin,
            ],
            [
                'id' => Uuid::uuid4(),
                'username' => 'hotaru',
                'name' => 'Hotaru Ichijou',
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'phone' => '085624804713',
                'role_id' => $role_id_admin,
            ],
            [
                'id' => Uuid::uuid4(),
                'username' => 'petugas',
                'name' => 'Sakamoto',
                'password' => password_hash('petugas', PASSWORD_BCRYPT),
                'phone' => '082155901835',
                'role_id' => $role_id_petugas,
            ],
            [
                'id' => Uuid::uuid4(),
                'username' => 'sensei',
                'name' => 'Sensei',
                'password' => password_hash('petugas', PASSWORD_BCRYPT),
                'phone' => '082155901835',
                'role_id' => $role_id_petugas,
            ],
        ];

        $this->db->table('users')->insertBatch($data_users);

        /* Data Bulan (Statis) Wajib ada */
        $data_bulan = [
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'Januari',
                'no' => 1,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'Februari',
                'no' => 2,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'Maret',
                'no' => 3,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'April',
                'no' => 4,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'Mei',
                'no' => 5,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'Juni',
                'no' => 6,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'Juli',
                'no' => 7,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'Agustus',
                'no' => 8,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'September',
                'no' => 9,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'Oktober',
                'no' => 10,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'November',
                'no' => 11,
            ],
            [
                'id' => Uuid::uuid4(),
                'bulan' => 'Desember',
                'no' => 12,
            ],
        ];

        $this->db->table('bulan_statis')->insertBatch($data_bulan);
    }
}
