<?php

use Illuminate\Database\Seeder;

class OauthClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // one client to rule them (iOS app(s)) all
        DB::table('oauth_clients')
            ->insert([
                'name' => 'iOS app',
                'secret' => '', // this is treated as NULL by laravel
                'redirect' => env('APP_URL'),
                'personal_access_client' => false,
                'password_client' => true,
                'revoked' => false,
            ]);

        // one client to rule them (Android app(s)) all
        DB::table('oauth_clients')
            ->insert([
                'name' => 'Android app',
                'secret' => '', // this is treated as NULL by laravel
                'redirect' => env('APP_URL'),
                'personal_access_client' => false,
                'password_client' => true,
                'revoked' => false,
            ]);
    }
}
