<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //user roles
        $roles = [
            ['name' => 'admin', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'user', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'author', 'created_at' => now(), 'updated_at' => now(),],
        ];
        DB::table('roles')->insert($roles);

        //users
        User::factory(100)->create();

        //users roles
        User::find(1)->roles()->attach(Role::where('name', 'admin')->first());

        $users = User::where('id', '!=', 1)->get();
        $roles = Role::where('name', '!=', 'admin')->get();

        foreach ($users as $user) {
            $user->roles()->attach($roles->random());
        }
    }
}
