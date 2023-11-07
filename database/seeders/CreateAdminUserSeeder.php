<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user = User::create([
        //     'name' => 'Super Admin', 
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('admin123')
        // ]);
    
        $role = Role::create(['name' => 'admin']);
    
        $permissions = Permission::pluck('id','id')->all();
        Log::info('User Permissions: ' . implode(', ', $permissions->toArray()));
        Log::info('Allowed Roles: ' . $role);
        Log::debug("Test Log");
        // Log::channel('single')->info('Allowed Roles: ' . $role);
        // Log::channel('single')->info('User Permissions: ' . implode(', ', $permissions->toArray()));
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
