<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminEditRoleController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('dashboard.user', compact('users'));
    }

    // Method untuk update role
    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);

        // Validate the data
        $validatedData = $request->validate([
            'role' => 'required|string|max:255',
        ]);

        // Update the produk with the validated data
        $users->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil diperbarui.'
        ]);
    }
}
