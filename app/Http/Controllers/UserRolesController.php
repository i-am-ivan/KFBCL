<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRolesController extends Controller
{
    /**
     * Create a new user role
     */
    public function createNewUserRole(Request $request): JsonResponse
    {
        try {
            // Validate required fields
            $request->validate([
                'role_name' => 'required|string|max:200',
                'status' => 'required|in:Active,Pending,Suspended',
            ]);

            // Create the user role
            $userRole = UserRole::create([
                'user_role' => $request->role_name,
                'user_role_status' => $request->status,
                'user_role_creator' => Auth::id(),
                'user_role_created_on' => now(),
                'user_role_bodaboda_create' => $request->has('bodaboda_create') ? 1 : 0,
                'user_role_bodaboda_read' => $request->has('bodaboda_read') ? 1 : 0,
                'user_role_bodaboda_update' => $request->has('bodaboda_update') ? 1 : 0,
                'user_role_bodaboda_delete' => $request->has('bodaboda_delete') ? 1 : 0,
                'user_role_loans_create' => $request->has('loans_create') ? 1 : 0,
                'user_role_loans_read' => $request->has('loans_read') ? 1 : 0,
                'user_role_loans_update' => $request->has('loans_update') ? 1 : 0,
                'user_role_loans_delete' => $request->has('loans_delete') ? 1 : 0,
                'user_role_lands_create' => $request->has('lands_create') ? 1 : 0,
                'user_role_lands_read' => $request->has('lands_read') ? 1 : 0,
                'user_role_lands_update' => $request->has('lands_update') ? 1 : 0,
                'user_role_lands_delete' => $request->has('lands_delete') ? 1 : 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User role created successfully',
                'userRole' => $userRole
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating user role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all user roles for Alpine.js
     */
    public function getAllUserRoles(): JsonResponse
    {
        $userRoles = UserRole::all();
        
        return response()->json([
            'userRoles' => $userRoles
        ]);
    }

    /**
     * Get count of all user roles
     */
    public function getAllCountUserRoles(): JsonResponse
    {
        $count = UserRole::count();
        
        return response()->json([
            'total_count' => $count
        ]);
    }

    /**
     * Get count of all user roles where status = Active
     */
    public function getAllCountActiveUserRoles(): JsonResponse
    {
        $count = UserRole::where('user_role_status', 'Active')->count();
        
        return response()->json([
            'active_count' => $count
        ]);
    }

    /**
     * Update an existing user role
     */
    public function updateUserRole(Request $request, $id): JsonResponse
    {
        try {
            // Find the role
            $userRole = UserRole::findOrFail($id);

            // Validate required fields
            $request->validate([
                'user_role' => 'required|string|max:200',
                'status' => 'required|in:Active,Pending,Suspended',
            ]);

            // Update the user role
            $userRole->update([
                'user_role' => $request->user_role,
                'user_role_status' => $request->status,
                'user_role_updated_on' => now(),
                'user_role_bodaboda_create' => $request->has('user_role_bodaboda_create') ? 1 : 0,
                'user_role_bodaboda_read' => $request->has('user_role_bodaboda_read') ? 1 : 0,
                'user_role_bodaboda_update' => $request->has('user_role_bodaboda_update') ? 1 : 0,
                'user_role_bodaboda_delete' => $request->has('user_role_bodaboda_delete') ? 1 : 0,
                'user_role_loans_create' => $request->has('user_role_loans_create') ? 1 : 0,
                'user_role_loans_read' => $request->has('user_role_loans_read') ? 1 : 0,
                'user_role_loans_update' => $request->has('user_role_loans_update') ? 1 : 0,
                'user_role_loans_delete' => $request->has('user_role_loans_delete') ? 1 : 0,
                'user_role_lands_create' => $request->has('user_role_lands_create') ? 1 : 0,
                'user_role_lands_read' => $request->has('user_role_lands_read') ? 1 : 0,
                'user_role_lands_update' => $request->has('user_role_lands_update') ? 1 : 0,
                'user_role_lands_delete' => $request->has('user_role_lands_delete') ? 1 : 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User role updated successfully',
                'userRole' => $userRole
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating user role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a user role
     */
    public function deleteUserRole($id): JsonResponse
    {
        try {
            // Find the role
            $userRole = UserRole::findOrFail($id);

            // Store info for message
            $roleName = $userRole->user_role;
            $roleId = $userRole->user_role_id;

            // Delete the role
            $userRole->delete();

            return response()->json([
                'success' => true,
                'message' => "User role '{$roleName}' (ID: {$roleId}) deleted successfully"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user role: ' . $e->getMessage()
            ], 500);
        }
    }
}