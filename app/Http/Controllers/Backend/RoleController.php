<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return view('backend.pages.role_setup.add_roles_permission', compact('roles', 'permissions'));
    }//End Method


}