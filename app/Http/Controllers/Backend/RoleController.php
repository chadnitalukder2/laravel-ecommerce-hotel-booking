<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission(){
        $permission = Permission::latest()->get();
        return view('backend.pages.permission.all_permission', compact('permission'));
    }//End Method

    public function AddPermission(){
        return view('backend.pages.permission.add_permission');
    }//End Method

    public function StorePermission(Request $request){
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' => 'Permission Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification); 
    }//End Method

    public function EditPermission($id){
        $permission = Permission::find($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    }//End Method

    public function UpdatePermission(Request $request){
        $per_id = $request->id;

        Permission::find($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification); 
    }//End Method


    public function DeletePermission($id){

        Permission::find($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }//end  Method


//==================================all Roles==============================================================

    public function AllRoles(){
        $roles = Role::latest()->get();
        return view('backend.pages.roles.all_roles', compact('roles'));
    }//End Method

    public function AddRoles(Request $request){
        return view('backend.pages.roles.add_roles');
    } //End Method

    public function StoreRoles(Request $request)
    {

        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }// End Method

    public function EditRoles($id){
        $roles = Role::find($id);
        return view('backend.pages.roles.edit_roles', compact('roles'));

    } // End Method

    public function UpdateRoles(Request $request)
    {

        $role_id = $request->id;

        Role::find($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    } // End Method

    public function DeleteRoles($id)
    {

        Role::find($id)->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method



//================================== Roles And Permission==============================================================

    public function AddRolesPermission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getsPermissionGroups();
        return view('backend.pages.role_setup.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    }//End Method

    public function StoreRolesPermission(Request $request){
        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        } //End Foreach
        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }//End Method

    public function AllRolesPermission(){
        $roles = Role::all();
        return view('backend.pages.role_setup.all_roles_permission', compact('roles'));
    }//End method

    public function AdminEditRoles($id){
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = User::getsPermissionGroups();
        return view('backend.pages.role_setup.edit_roles_permission', compact('role', 'permissions', 'permission_groups'));
    }//End Method











}
