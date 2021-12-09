<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    private $menuId = null;
    private $dropdownId = array();
    private $dropdown = false;
    private $sequence = 1;
    private $joinData = array();
    private $adminRole = null;
    private $userRole = null;
    private $subFolder = '';

    public function join($roles, $menusId)
    {
        $roles = explode(',', $roles);
        foreach ($roles as $role) {
            array_push($this->joinData, array('role_name' => $role, 'menus_id' => $menusId));
        }
    }

    /*
        Function assigns menu elements to roles
        Must by use on end of this seeder
    */
    public function joinAllByTransaction()
    {
        DB::beginTransaction();
        foreach ($this->joinData as $data) {
            DB::table('menu_role')->insert([
                'role_name' => $data['role_name'],
                'menus_id' => $data['menus_id'],
            ]);
        }
        DB::commit();
    }

    public function insertLink($roles, $name, $href, $icon = null, $function_href = null)
    {
        $href = $this->subFolder . $href;
        if ($this->dropdown === false) {
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'sequence' => $this->sequence,
                'function_href' => $function_href,
            ]);
        } else {
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'parent_id' => $this->dropdownId[count($this->dropdownId) - 1],
                'sequence' => $this->sequence,
                'function_href' => $function_href,
            ]);
        }
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        $permission = Permission::where('name', '=', $name)->get();
        if (empty($permission)) {
            $permission = Permission::create(['name' => 'visit ' . $name]);
        }
        $roles = explode(',', $roles);
        if (in_array('user', $roles)) {
            $this->userRole->givePermissionTo($permission);
        }
        if (in_array('admin', $roles)) {
            $this->adminRole->givePermissionTo($permission);
        }
        return $lastId;
    }

    public function insertTitle($roles, $name)
    {
        DB::table('menus')->insert([
            'slug' => 'title',
            'name' => $name,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence
        ]);
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function beginDropdown($roles, $name, $icon = '', $function_href = '')
    {
        if (count($this->dropdownId)) {
            $parentId = $this->dropdownId[count($this->dropdownId) - 1];
        } else {
            $parentId = null;
        }
        DB::table('menus')->insert([
            'slug' => 'dropdown',
            'name' => $name,
            'icon' => $icon,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence,
            'parent_id' => $parentId,
            'function_href' => $function_href,
        ]);
        $lastId = DB::getPdo()->lastInsertId();
        array_push($this->dropdownId, $lastId);
        $this->dropdown = true;
        $this->sequence++;
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function endDropdown()
    {
        $this->dropdown = false;
        array_pop($this->dropdownId);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Get roles */
        $this->adminRole = Role::where('name', '=', 'admin')->first();
        $this->userRole = Role::where('name', '=', 'user')->first();
        /* Create Sidebar menu */
        DB::table('menulist')->insert([
            'name' => 'sidebar menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->insertLink('guest,user,admin', 'dashboard', '/admin/', 'icon-dashboard', 'dashboard.index');
        $this->insertLink('user,admin', 'recruitment', '/admin/job', 'icon-recruitment', 'job.index,job.create,job.show,job.edit');
        $this->insertLink('admin', 'company', '/admin/companies', 'icon-company', 'companies.index,companies.create,companies.show');
        $this->insertLink('user,admin', 'employee_manager', '/admin/executive-board', 'icon-employee', 'executive-board.index');
        $this->insertLink('admin', 'wine', '/admin/wines', 'icon-wine', 'wines.index');
        $this->insertLink('admin', 'news', '/admin/news', 'icon-news', 'news.index,news.create,news.show');
        $this->beginDropdown('admin', 'setting', 'icon-setting', '');
            $this->insertLink('admin', 'user', '/admin/users', '', 'users.index');
            $this->insertLink('user,admin', 'branch', '/admin/branch&hotline', '', 'branch.index,branch.create,branch.show');
//            $this->insertLink('admin', 'hotline', '/admin/hotlines', '', 'hotlines.index');
            $this->insertLink('user,admin', 'job_category', '/admin/job-category', 'icon-category', 'job-category.index');
        $this->endDropdown();
        $this->insertLink('user,admin', 'logout', '/logout','icon-logout', 'icon-logout');


        /* Create top menu */
        DB::table('menulist')->insert([
            'name' => 'top menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
//        $this->beginDropdown('guest,user,admin', 'Pages');
//        $id = $this->insertLink('guest,user,admin', 'Dashboard', '/');
//        $id = $this->insertLink('user,admin', 'Notes', '/notes');
//        $id = $this->insertLink('admin', 'Users', '/users');
//        $this->endDropdown();
//        $id = $this->beginDropdown('admin', 'Settings');
//
//        $id = $this->insertLink('admin', 'Edit menu', '/menu/menu');
//        $id = $this->insertLink('admin', 'Edit menu elements', '/menu/element');
//        $id = $this->insertLink('admin', 'Edit roles', '/roles');
//        $id = $this->insertLink('admin', 'Media', '/media');
//        $id = $this->insertLink('admin', 'BREAD', '/bread');
//        $this->endDropdown();

        $this->joinAllByTransaction(); ///   <===== Must by use on end of this seeder
    }
}
