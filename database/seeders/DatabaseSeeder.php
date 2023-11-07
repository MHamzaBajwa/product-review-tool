<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user=\App\Models\User::create([
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$j80I6lv5lvMzq37GH5SeY.prpcNuqI8i7NFz5KVTbi5FdQwAIaOk2', // admin123
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::create([
            'name' => 'User',
            'role' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$j80I6lv5lvMzq37GH5SeY.prpcNuqI8i7NFz5KVTbi5FdQwAIaOk2', // admin123
            'remember_token' => Str::random(10),
        ]);

        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'feedback-list',
            'feedback-create',
            'feedback-edit',
            'feedback-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
        ];
    
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $role = Role::create(['name' => 'admin']);
    
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        // Category Seeder for Testing
        Category::create(['name' => 'Bug Report']);
        Category::create(['name' => 'Feature Request']);
        Category::create(['name' => 'Improvement']);
        Category::create(['name' => 'Other']);

    }
}
