<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\UDetail;
use App\Models\URole;
use App\Models\User;
use App\Models\WConfig;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        WConfig::factory()->create([
            'key' => 'app_name',
            'value' => 'MariKas',
        ]);

        WConfig::factory()->create([
            'key' => 'app_favicon',
            'value' => 'images/logo.png',
        ]);

        WConfig::factory()->create([
            'key' => 'app_desc',
            'value' => 'MariKas adalah aplikasi pendataan kas secara online dengan integrasi realtime Whatsapp notifikasi, serta Payment Gateway',
        ]);

        WConfig::factory()->create([
            'key' => 'app_banner',
            'value' => 'images/banner.png',
        ]);

        WConfig::factory()->create([
            'key' => 'app_author',
            'value' => 'Github: ZumaAkbarID',
        ]);
        WConfig::factory()->create([
            'key' => 'tripay_api_key',
            'value' => null,
        ]);
        WConfig::factory()->create([
            'key' => 'tripay_private_key',
            'value' => null,
        ]);
        WConfig::factory()->create([
            'key' => 'fastwa_instance_key',
            'value' => 'WSm1sx-ah95jv-YpkN1A',
        ]);

        User::factory()->create(
            [
                'name' => 'Rahmat Wahyuma Akbar',
                'username' => 'zuma',
                // 'email' => 'rahmatwahyumaakbar@gmail.com',
                'phone_number' => '081225389903',
                'status' => 'Aktif',
                'password' => Hash::make('password')
            ]
        );

        UDetail::factory()->create(
            [
                'user_id' => 1,
                'kyc_document' => 'kyc_doc/default.png',
                'kyc_selfie' => 'kyc_self/default.png',
                'kyc' => 'Lolos',
                'address' => 'Jl. Seroja IV'
            ]
        );

        Role::factory()->create(
            [
                'r_name' => 'Developer',
                'r_desc' => 'Pengembang'
            ]
        );
        Role::factory()->create(
            [
                'r_name' => 'Pemilik',
                'r_desc' => 'Pemilik room kas '
            ]
        );
        Role::factory()->create(
            [
                'r_name' => 'Anggota',
                'r_desc' => 'Anggota dari room kas '
            ]
        );
        Role::factory()->create(
            [
                'r_name' => 'Pengunjung',
                'r_desc' => 'Tidak bergabung room manapun'
            ]
        );

        URole::factory()->create([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }
}
