<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->load('roles', 'registration');
        return view('users.show', compact('user'));
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        
        return redirect()->route('users.index')
            ->with('status', 'User deleted successfully.');
    }

    /**
     * Toggle user role between regular user and admin.
     */
    public function toggleRole(User $user, Request $request)
    {
        $request->validate([
            'role' => 'required|string|in:register,admin,super_admin'
        ]);

        // Remove all existing roles
        $user->syncRoles([]);
        
        // Assign new role
        $user->assignRole($request->role);

        return redirect()->route('users.index')
            ->with('status', 'User role updated successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index')
            ->with('status', 'User updated successfully.');
    }
}
