<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Location;
use App\Models\Vehicle;
use App\Models\Driver;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $approverRole = Role::firstOrCreate(['name' => 'approver']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);

        // Create permissions
        $permissions = [
            'view bookings',
            'create bookings',
            'edit bookings',
            'delete bookings',
            'approve bookings',
            'view vehicles',
            'create vehicles',
            'edit vehicles',
            'delete vehicles',
            'view drivers',
            'create drivers',
            'edit drivers',
            'delete drivers',
            'view reports',
            'export reports',
            'view activity logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->givePermissionTo($permissions);
        $approverRole->givePermissionTo(['view bookings', 'approve bookings', 'view reports']);
        $employeeRole->givePermissionTo(['view bookings']);

        // Users
        $users = [
            [
                'name' => 'Admin Pool',
                'email' => 'admin@tambang.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'role_name' => 'admin',
            ],
            [
                'name' => 'Approver 1',
                'email' => 'approver1@tambang.com',
                'password' => Hash::make('approver123'),
                'role' => 'approver',
                'role_name' => 'approver',
            ],
            [
                'name' => 'Approver 2',
                'email' => 'approver2@tambang.com',
                'password' => Hash::make('approver123'),
                'role' => 'approver',
                'role_name' => 'approver',
            ],
            [
                'name' => 'Pegawai 1',
                'email' => 'pegawai1@tambang.com',
                'password' => Hash::make('pegawai123'),
                'role' => 'employee',
                'role_name' => 'employee',
            ],
        ];

        foreach ($users as $userData) {
            $roleName = $userData['role_name'];
            unset($userData['role_name']);
            
            $user = User::updateOrCreate(['email' => $userData['email']], $userData);
            $user->assignRole($roleName);
        }

        // Locations
        $locations = [
            ['name' => 'Kantor Pusat', 'type' => 'head_office'],
            ['name' => 'Kantor Cabang', 'type' => 'branch_office'],
            ['name' => 'Tambang 1', 'type' => 'mining_site'],
            ['name' => 'Tambang 2', 'type' => 'mining_site'],
            ['name' => 'Tambang 3', 'type' => 'mining_site'],
            ['name' => 'Tambang 4', 'type' => 'mining_site'],
            ['name' => 'Tambang 5', 'type' => 'mining_site'],
            ['name' => 'Tambang 6', 'type' => 'mining_site'],
        ];
        foreach ($locations as $loc) {
            Location::updateOrCreate(['name' => $loc['name']], $loc);
        }

        // Vehicles
        $vehicleTypes = ['passenger', 'goods'];
        $ownerships = ['owned', 'rented'];
        foreach (Location::all() as $loc) {
            foreach ($vehicleTypes as $type) {
                foreach ($ownerships as $own) {
                    Vehicle::updateOrCreate([
                        'name' => $type.'-'.$own.'-'.$loc->id,
                        'plate_number' => strtoupper(substr($type,0,1)).rand(1000,9999),
                    ], [
                        'type' => $type,
                        'ownership' => $own,
                        'location_id' => $loc->id,
                    ]);
                }
            }
        }

        // Drivers
        foreach (Location::all() as $loc) {
            for ($i=1; $i<=2; $i++) {
                Driver::updateOrCreate([
                    'name' => 'Driver '.$i.' '.$loc->name,
                    'location_id' => $loc->id,
                ], [
                    'phone' => '0812'.rand(100000,999999),
        ]);
            }
        }
    }
}
