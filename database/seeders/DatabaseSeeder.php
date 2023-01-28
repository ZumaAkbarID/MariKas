<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\Room;
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
            'key' => 'app_env',
            'value' => 'development',
        ]);

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
            'value' => '1jawg5-fQ8sbW-ZKNcxS',
        ]);
        WConfig::factory()->create([
            'key' => 'dana_number',
            'value' => '081-225-389-903',
        ]);
        WConfig::factory()->create([
            'key' => 'dana_holder_name',
            'value' => 'Rahmat Wahyuma Akbar',
        ]);
        WConfig::factory()->create([
            'key' => 'qris_url',
            'value' => 'test',
        ]);
        WConfig::factory()->create([
            'key' => 'discord_webhook_otp',
            'value' => 'https://discordapp.com/api/webhooks/1068739988038090772/POYh1zJ3IJeZFglXBNBjmvZWLaYPOnah1sRtX9l1Zg0lJzsVwovSCIrCbdksYrEZDdaL',
        ]);
        WConfig::factory()->create([
            'key' => 'discord_webhook_kas_payment',
            'value' => 'https://discordapp.com/api/webhooks/1068746070605176914/z9rC2JzYqPnaXhA0JsdiYZKjTQmUf0Xj4_R1QGfMQ82qxHq50FJg5dBRrSRfzKyYHhMR',
        ]);
        WConfig::factory()->create([
            'key' => 'discord_webhook_kas_cashout',
            'value' => 'https://discordapp.com/api/webhooks/1068747120858898502/9Yhojkm8s-OLxNxX2_A2cN4u-Oezcw3DhbJoC2Mn2Yt-x5siV6H67w3VnHA5Cifcfmei',
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

        URole::factory()->create([
            'user_id' => 1,
            'role' => 'Developer'
        ]);
        User::factory()->create(
            [
                'name' => 'Aditiya Wahyu Alex S',
                'username' => 'alex20',
                // 'email' => 'rahmatwahyumaakbar@gmail.com',
                'phone_number' => '081367647589',
                'status' => 'Aktif',
                'password' => Hash::make('password')
            ]
        );

        UDetail::factory()->create(
            [
                'user_id' => 2,
                'kyc_document' => 'kyc_doc/default.png',
                'kyc_selfie' => 'kyc_self/default.png',
                'kyc' => 'Lolos',
                'address' => 'Jl. Seroja IV'
            ]
        );

        URole::factory()->create([
            'user_id' => 2,
            'role' => 'Pemilik',
            'room_id' => 1
        ]);
        User::factory()->create(
            [
                'name' => 'Anggota',
                'username' => 'anggota',
                // 'email' => 'rahmatwahyumaakbar@gmail.com',
                'phone_number' => '081225389902',
                'status' => 'Aktif',
                'password' => Hash::make('password')
            ]
        );

        UDetail::factory()->create(
            [
                'user_id' => 3,
                'kyc_document' => 'kyc_doc/default.png',
                'kyc_selfie' => 'kyc_self/default.png',
                'kyc' => 'Lolos',
                'address' => 'Jl. Seroja IV'
            ]
        );

        URole::factory()->create([
            'user_id' => 3,
            'role' => 'Anggota',
            'room_id' => 1
        ]);
        User::factory()->create(
            [
                'name' => 'Pengunjung',
                'username' => 'pengunjung',
                // 'email' => 'rahmatwahyumaakbar@gmail.com',
                'phone_number' => '081225389904',
                'status' => 'Aktif',
                'password' => Hash::make('password')
            ]
        );

        UDetail::factory()->create(
            [
                'user_id' => 4,
                'kyc_document' => 'kyc_doc/default.png',
                'kyc_selfie' => 'kyc_self/default.png',
                'kyc' => 'Lolos',
                'address' => 'Jl. Seroja IV'
            ]
        );

        URole::factory()->create([
            'user_id' => 4,
            'role' => 'Pengunjung'
        ]);

        // Room::factory()->create([
        //     'room_name' => 'Marimas',
        // ]);
    }
}