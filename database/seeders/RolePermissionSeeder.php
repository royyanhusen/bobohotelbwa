<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage countries',
            'manage cities',
            'manage hotel bookings',
            'manage hotels',
            'check hotels',
            'view hotel bookings',
        ];

        foreach($permissions as $perm) {
            Permission::firsOrCreate([
                'name' => $perm
            ]);
        }

        $customerRole = Role::firsOrCreate([
            'name' => 'customer',
        ]);

        $customerPermissions = [
            'check hotels',
            'view hotel bookings',
        ];

        $customerRole->syncPermissions($customerPermissions);

        $superAdminRole = Role::firsOrCreate([
            'name' => 'super_admin',
        ]);

        $user = User::create([
            'name' => 'super_admin',
            'email' => 'super@admin.com',
            'avatar' => 'images/dummyavatar.png',
            'password' => bcrypt('123qwe123'),
        ]);

        $user->assignRole($superAdminRole);
    }
}
