<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Forget cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Admin role
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin']);

        // Create permissions
        $permissions = [
            'acessar_clientes',
            'acessar_fornecedores',
            'acessar_insumos',
            'acessar_movimentacoes',
            'acessar_pedidos',
            'acessar_produtos',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole->syncPermissions($permissions);

        // Retrieve or create the admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
            ]
        );

        // Assign the Admin role
        $adminUser->assignRole($adminRole);
    }
}
