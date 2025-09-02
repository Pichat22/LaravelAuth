<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //liste des permissions
        $permissions=['users.view', 'users.create', 'users.update', 'users.delete','child.create','child.update'];
        //création des permissions par ordre
        foreach($permissions as $perm ){
            Permission::firstOrCreate(['name'=>$perm,'guard_name'=>'web']);
        }
        // créer des roles et assignés des permissions
        $roles=[
            'super_admin'=>$permissions,//Toutes les permissions
            'agent_sante'=>['child.create','child.update'],

        ];
        // enregistrement des roles avec les permissions par ordre
        foreach($roles as $roleName => $perms){
            $role=Role::firstOrCreate(['name'=>$roleName, 'guard_name'=>'web']);
            $role->syncPermissions($perms);
        }
        //créations des deux utilisateurs
        $admin=User::firstOrCreate(['email'=>'superadmin@gmail.com'],
        ['name'=>'uxelle', 'password'=>Hash::make('passer01')]
        
    );
    $admin->assignRole('super_admin');
        //création de l'agent de santé

    $admin=User::firstOrCreate(['email'=>'agentsante@gmail.com'],
        ['name'=>'moussa', 'password'=>Hash::make('passer01')]
        
    );
    $admin->assignRole('agent_sante');

    }

}
