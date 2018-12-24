<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entities\User;
use App\Entities\Role;
use App\Entities\Template;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', [
            'employees' => User::employee()->get(),
            'admins' => User::admin()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', [
            'user' => new User(),
            'roles' => Role::pluck('name', 'id'),
            'templates' => Template::pluck('name', 'id'),            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $post = $request->all();
        $user = new User;
        $user->fill($post);        
        $user->password = bcrypt($post['password']);
        if ($user->save()) {
            $role = Role::where('id', $post['role_id'])->firstOrFail();
            $user->attachRole($role);
            $user->createOrUpdateNote($post['note'] ?? null);
            
            return redirect()->route('admin.users.index')->with('flash_success', _i('Data saved successfully!'));
        }
        
        return redirect()->back()->withInput()->with('flash_danger', _i('We received an error while saving data!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name', 'id'),
            'templates' => Template::pluck('name', 'id'),           
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $post = $request->all();
        $user->fill($post);
        if (!empty($post['password'])) {
            $user->password = bcrypt($post['password']);
        }
        
        if ($user->save()){
            $user->createOrUpdateNote($post['note'] ?? null);
            
            return redirect()->route('admin.users.index')->with('flash_success', _i('Data successfully updated!'));
        }
        
        return redirect()->back()->withInput()->with('flash_danger', _i('We received an error while updating data!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('flash_success', _i('Data successfully deleted!'));
    }
}
