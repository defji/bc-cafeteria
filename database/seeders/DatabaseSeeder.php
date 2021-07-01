<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create(
            [
                'name'              => 'Györkös Balázs',
                'email'             => 'dfj@dfj.hu',
                'password'          => bcrypt('plokplok4'),
                'email_verified_at' => null,
            ]
        );
    }
}
