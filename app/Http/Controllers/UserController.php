<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('users.index', [
            'users' => User::with('roles')->get()->each(function (User $user){
                $user->role = $user->getRoleNames()->first();
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return response()->view('users.edit', [
            'roles' => $roles,
            'user' => null,
            'isUpdate' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->except('_token');
        $user = new User();
        $user->fill($data);
        $user->password = Hash::make($data['password']);
        $user->save();
        $user->assignRole($data['role']);
        return response()->json('ok', 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        $user->role = $user->roles->first()->id;
        return response()->view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'isUpdate' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->except('_token'));
        $user->save();
        return response()->json('ok', 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json('ok', 204);
    }
}
