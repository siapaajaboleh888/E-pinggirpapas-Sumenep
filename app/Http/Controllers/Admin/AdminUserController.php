<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // List users with simple search and pagination
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->get('filter') === 'trashed') {
            $query = User::onlyTrashed();
        }

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        $filter = $request->get('filter');
        return view('admin.users.index', compact('users', 'search', 'filter'));
    }

    // Delete user (hard delete for now). Prevent deleting admin and self.
    public function destroy(Request $request, $id)
    {
        $auth = $request->user();
        $user = User::findOrFail($id);

        if ($auth->id === $user->id) {
            return back()->with('warning', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if ($user->role === 'admin') {
            return back()->with('warning', 'Anda tidak dapat menghapus akun admin.');
        }

        try {
            $user->delete(); // soft delete
            return back()->with('success', 'User berhasil dinonaktifkan (soft delete).');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal menghapus user.');
        }
    }

    // Restore soft-deleted user
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        try {
            $user->restore();
            return back()->with('success', 'User berhasil dipulihkan.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal memulihkan user.');
        }
    }

    // Permanently delete soft-deleted user
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        try {
            $user->forceDelete();
            return back()->with('success', 'User dihapus permanen.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal menghapus permanen user.');
        }
    }
}
