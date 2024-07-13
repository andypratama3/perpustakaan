<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
class AdminController extends Controller
{
    public function index()
    {
        $limit = 10;
        $users = User::orderBy('name', 'asc')->paginate($limit);
        $count = $users->count();
        $no = $limit * ($users->currentPage() - 1);

        return view('dashboard.admin.index', compact('users', 'no', 'limit', 'count'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('dashboard.admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string'],

        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;
        $user->role = $request->role;
        $user->update();
        return redirect()->route('dashboard.admin.index')->with('success', 'Admin has been updated');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('dashboard.admin.index')->with('success', 'Admin has been deleted');
    }
}
