<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminDetails = array(
            [
                'name' => 'SuperAdmin',
                'mobile' => '9943308193',
                'email' => 'admin@admin.com',
                'password' => 'password',
               
            ],
        );

        $role = Role::updateOrCreate(
            ['name' => 'administrator'],
            [
                'name' => 'administrator',
                'description' => 'Super User, having access to all sites.'
            ]
        );

        foreach ($adminDetails as $adminDetail) {
            $admin = User::where('mobile', '=', $adminDetail['mobile'])->first();

            if (!$admin) {
                $admin = User::create([
                    'name' => $adminDetail['name'],
                    'mobile' => $adminDetail['mobile'],
                    'email' => $adminDetail['email'],
                    'password' => Hash::make($adminDetail['password'])                  
                ]);

                UserRole::create([
                    'user_id' => $admin->id,
                    'role_id' => $role->id
                ]);
            }
        }
    }
}
