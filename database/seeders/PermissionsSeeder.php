<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Post Category permissions
        Permission::create(['guard_name' => 'api', 'name' => 'create post category']);
        Permission::create(['guard_name' => 'api', 'name' => 'edit post category']);
        Permission::create(['guard_name' => 'api', 'name' => 'delete post category']);
        Permission::create(['guard_name' => 'api', 'name' => 'update post category']);
        Permission::create(['guard_name' => 'api', 'name' => 'unpublished post category']);

        // Post permissions
        Permission::create(['guard_name' => 'api', 'name' => 'create post']);
        Permission::create(['guard_name' => 'api', 'name' => 'edit post']);
        Permission::create(['guard_name' => 'api', 'name' => 'delete post']);
        Permission::create(['guard_name' => 'api', 'name' => 'publish post']);
        Permission::create(['guard_name' => 'api', 'name' => 'unpublished post']);



        $role2 = Role::create(['guard_name' => 'api', 'name' => 'admin']);
        $role2->givePermissionTo('publish post');
        $role2->givePermissionTo('unpublished post');


        $superadminrole = Role::create(['guard_name' => 'api', 'name' => 'super-admin']);
        $superadminrole->givePermissionTo('create post category');
        $superadminrole->givePermissionTo('edit post category');
        $superadminrole->givePermissionTo('delete post category');
        $superadminrole->givePermissionTo('update post category');
        $superadminrole->givePermissionTo('unpublished post category');

        $superadminrole->givePermissionTo('create post');
        $superadminrole->givePermissionTo('edit post');
        $superadminrole->givePermissionTo('delete post');
        $superadminrole->givePermissionTo('publish post');
        $superadminrole->givePermissionTo('unpublished post');





        // Role for Suspended User
        $userrole = Role::create(['guard_name' => 'api', 'name' => 'registered-user']);


        //create super admin
        $user = \App\Models\User::factory()->create([


            "first_name" => "super",
            "last_name" => "admin",
            "email" => "super@admin.com",
            "email_verified_at" => Carbon::now(),
            "mobile_verified_at" => Carbon::now(),
            "password" => bcrypt("supersuper"),
            "active" => true,
            "activation_token" => "",
            "mobile_token" => "",
            "mobile_number" => "0912",
            "created_at" => Carbon::now()
        ]);
        $user->assignRole($superadminrole);


        // create demo users
        $user = \App\Models\User::factory()->create([

            "first_name" => "user",
            "last_name" => "example",
            "email" => "user@example.com",
            "email_verified_at" => Carbon::now(),
            "mobile_verified_at" => Carbon::now(),
            "password" => bcrypt("useruser"),
            "active" => true,
            "activation_token" => "",
            "mobile_token" => "",
            "mobile_number" => "090509",
            "created_at" => Carbon::now()
        ]);
        $user->assignRole($userrole);
    }
}
