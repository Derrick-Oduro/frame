<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('manage roles')) {
            abort(403, 'Unauthorized action.');
        }
        $users = User::where('tenant_id', auth()->user()->tenant_id)->get();
        $roles = Role::all();
        return view('admin.roles', compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    public function assign(Request $request)
{
    if (!auth()->user()->can('manage roles')) {
        abort(403, 'Unauthorized action.');
    }
    $request->validate([
        'roles' => 'required|array',
        'roles.*' => 'required|in:admin,editor,author,guest',
    ]);

    foreach ($request->roles as $userId => $role) {
        $user = User::where('id', $userId)
            ->where('tenant_id', auth()->user()->tenant_id)
            ->first();

        if ($user) {
            $user->syncRoles([$role]);
        }
    }

    return back()->with('success', 'Roles updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
