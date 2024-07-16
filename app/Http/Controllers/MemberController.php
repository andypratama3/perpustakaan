<?php

namespace App\Http\Controllers;

use Rules\Password;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\RegisteredUserController;

class MemberController extends Controller
{

    public function index()
    {
        $limit = 10;
        $members = Member::orderBy('name', 'asc')->paginate($limit);
        if(request()->has('search')) {
            $members = Member::where('name', 'like', '%' . request('search') . '%')->orderBy('name', 'asc')->paginate($limit);
        }
        $count = $members->count();
        $no = $limit * ($members->currentPage() - 1);

        return view('dashboard.member.index', compact('members', 'no', 'limit', 'count'));
    }

    public function create()
    {
        return view('dashboard.member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // add new member when register user
        $member = Member::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'image' => 'default.png',
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return redirect()->route('dashboard.member.index')->with('success', 'Member has been created');
    }

    public function edit(Member $member)
    {
        return view('dashboard.member.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($member->user->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        $member->update([
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $member->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $member->user->password,
        ]);

        return redirect()->route('dashboard.member.index')->with('success', 'Member has been updated');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('dashboard.member.index')->with('success', 'Member has been deleted');
    }

}
