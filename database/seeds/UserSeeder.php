<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name' => 'Admin', 
            'email' => 'admin@admin.com', 
            'password' => bcrypt('123qwe123'), 
            'role' => \App\Enum\RolesEnum::ADMIN,
            'email_verified_at' => now(),
        ];

        $adminModel = \App\User::create($admin);

        factory(App\User::class, 10)->create();
    }

}
