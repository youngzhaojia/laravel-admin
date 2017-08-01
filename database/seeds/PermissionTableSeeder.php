<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_permissions')->truncate();
        DB::table('admin_permissions')->insert([
            ['name'=> 'admin.permission', 'label' => '权限管理', 'cid' => 0, 'icon' => 'fa-slideshare'],

            ['name'=> 'admin.permission.list',   'label' => '权限列表', 'cid' => 1, 'icon' => ''],
            ['name'=> 'admin.permission.create', 'label' => '权限添加', 'cid' => 1, 'icon' => ''],
            ['name'=> 'admin.permission.update', 'label' => '权限修改', 'cid' => 1, 'icon' => ''],
            ['name'=> 'admin.permission.delete', 'label' => '权限删除', 'cid' => 1, 'icon' => ''],

            ['name'=> 'admin.role.list',   'label' => '角色列表', 'cid' => 1, 'icon' => ''],
            ['name'=> 'admin.role.create', 'label' => '角色添加', 'cid' => 1, 'icon' => ''],
            ['name'=> 'admin.role.update', 'label' => '角色修改', 'cid' => 1, 'icon' => ''],
            ['name'=> 'admin.role.delete', 'label' => '角色删除', 'cid' => 1, 'icon' => ''],

            ['name'=> 'admin.admin.list',   'label' => '管理员列表', 'cid' => 1, 'icon' => ''],
            ['name'=> 'admin.admin.create', 'label' => '管理员添加', 'cid' => 1, 'icon' => ''],
            ['name'=> 'admin.admin.update', 'label' => '管理员修改', 'cid' => 1, 'icon' => ''],
            ['name'=> 'admin.admin.delete', 'label' => '管理员删除', 'cid' => 1, 'icon' => ''],
        ]);
    }
}
