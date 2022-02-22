<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\AdminDataTable;
use App\Models\Admin;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class AdminController extends Controller
{
    public function index(AdminDataTable $AdminDataTable)
    {
        $data = Role::all();
        return $AdminDataTable->render('Admin.AdminUser.index', compact('data'));
    }
    public function store(AdminRequest $request)
    {
        $role = Role::where('id', $request->role)->first();
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->assign_role = $role->name;
        $admin->password = Hash::make($request->password);
        $admin->save();

        $admin->assignRole($request->role);

        if ($admin) {
            $response['status'] = 'success';
            $response['message'] = 'Admin User created successfully';
        } else {
            $response['status'] = 'danger';
            $response['message'] = 'Something went wrong! Try again later...';
        }
        return $response;
    }
    public function edit(Request $request)
    {
        $admin = Admin::find($request->id);
        $roles = Role::all();
        $data['adminRole'] = $admin->roles->first();
        $data['admin'] = $admin;
        $data['roles'] = $roles;
        return $data;
    }
    public function update(Request $request)
    {
        $roles = Role::where('id', $request->roles)->first();
        $admin = Admin::find($request->id);
        $admin->assign_role = $roles->name;
        $input = $request->all();
        $admin->update($input);
        DB::table('model_has_roles')->where('model_id', $request->id)->delete();
        $admin->assignRole($request->input('roles'));
    }
    public function delete(Request $request)
    {
        return Admin::where('id', $request->id)->delete();
    }
}
