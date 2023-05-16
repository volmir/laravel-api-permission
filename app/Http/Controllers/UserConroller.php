<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\UserRole;
use App\Models\UserPermission;
use App\Http\Resources\RolesResource;
use App\Http\Resources\PermissionsResource;
use Illuminate\Support\Facades\DB;
use App\Events\UserRoleCreated;

class UserConroller extends Controller
{
    public function roles(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);        
      
        $roles = UserRole::where('user_id', $request->input('user_id'))->get();
        return new RolesResource($roles);
    }

    public function permissions(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);   

        $rolePermissions = DB::table('role_permissions')
            ->select('permission_id')
            ->join('user_roles', 'role_permissions.role_id', '=', 'user_roles.role_id')
            ->where('user_roles.user_id', '=', $request->input('user_id'))
            ->get()
            ->pluck('permission_id');

        $userPermissions = UserPermission::where('user_id', $request->input('user_id'))
            ->get()
            ->pluck('permission_id');

        $allPermissions = array_unique(array_merge((array)$rolePermissions->all(), (array)$userPermissions->all()));
        $permissions = Permission::whereIn('id', $allPermissions)->get();

        return new PermissionsResource($permissions);
    }  

    public function addRole(Request $request) 
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $userRole = UserRole::create($request->all());

        if (!is_null($userRole)) {
            event(new UserRoleCreated($userRole));
        }

        return $userRole;
    }
}
