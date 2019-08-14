<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeedRolesAndPermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app(Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // 创建权限
        Permission::create(['name' => 'do_work']);
        Permission::create(['name' => 'manage_staff']);
        Permission::create(['name' => 'manage_managers']);

        // 创建 CEO 角色并赋予权限
        $ceo = Role::create(['name' => 'CEO']);
        $ceo->givePermissionTo('do_work');
        $ceo->givePermissionTo('manage_staff');
        $ceo->givePermissionTo('manage_managers');

        // 创建 Manager 角色并赋予权限
        $manager = Role::create(['name' => 'Manager']);
        $manager->givePermissionTo('manage_staff');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app(Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $tableNames = config('permission.table_names');

        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}
