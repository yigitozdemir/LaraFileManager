<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Permission controller grants and revokes permission to a user on an object
 * permission ro can display metadata only
 * permission rd can download file
 */
class PermissionController extends Controller
{
    
    public function create(Request $request): JsonResponse{
        $fileId = $request->input('file_id');
        $userId = $request->input('user_id');
        $permissionString = $request->input('permission');

        $permission = Permission::create([
            'file_id' => $fileId,
            'user_id' => $userId,
            'permission' => $permissionString,
        ]);

        $permission->save();
        return response()->json($permission);
    }
}
