<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(RoleDataTable $roledatatable)
    {
        $permissions = Permission::all();
        $role = Role::all();
        return $roledatatable->render('Admin.Role.index', compact('permissions', 'role'));
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin'
        ]);
        $role->syncPermissions($request->permissions);

        if ($role) {
            $response['status'] = 'success';
            $response['message'] = 'Role created successfully';
        } else {
            $response['status'] = 'danger';
            $response['message'] = 'Something went wrong! Try again later...';
        }
        return $response;
    }

    public function edit(Request $request, $id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('Admin.Role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(UpdateRoleRequest $request)
    {
        $role = Role::find($request->id);
        $input = $request->all();
        $role->update($input);
        $role->permissions()->sync($request->permissions);

        $role['route'] = "admin.role.index";
        return $role;
    }

    public function delete(Request $request)
    {
        return Role::where('id', $request->id)->delete();
    }
}
