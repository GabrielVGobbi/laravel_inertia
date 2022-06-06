<?php

namespace App\Http\Controllers\Painel\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Permissions\Models\Role;

class UsersController extends Controller
{
    protected $repository;

    public function __construct(User $users)
    {
        $this->repository = $users;

        $this->middleware('permission:users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('painel.acl.users.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$roles = Role::get()->toArray();
        //
        //return view('admin.users.create', [
        //    'roles' => $roles
        //]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        $columns = $request->all();

        $user = $this->repository->create($columns);

        if (isset($columns['roles']) && $request->user()->hasRole('dev')) {
            $roles = $columns['roles'];
            if (!empty($roles)) {
                $user->roles()->sync($roles);
            }
        }

        return redirect()
            ->route('users.index')
            ->with('message', 'Criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Users  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        if (!$user = $this->repository->where('uuid', $uuid)->first()) {
            return redirect()
                ->route('users.index')
                ->with('message', 'Registro não encontrado!');
        }

        $rolesUser = $user->roles()->get(['name'])->toArray();

        foreach ($rolesUser as $roleUser) {
            $roles_user[] = $roleUser['name'];
        }

        $roles = Role::get()->toArray();

        return view('painel.acl.users.show', [
            'user' => $user,
            'roles_user' => $roles_user ?? [],
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $uuid)
    {
        if ($request->user()->hasRole('dev') || $request->user()->uuid == $uuid) {

            if (!$users = $this->repository->where('id', $uuid)->first()) {
                return redirect()
                    ->route('users.index')
                    ->with('message', 'Registro não encontrado!');
            }

            $columns = $request->all();

            $roles = $columns['roles'] ?? '';

            if (!isset($request->is_active)) {
                $columns['is_active'] = '1';
            }

            if (!empty($roles)) {
                $users->roles()->sync($roles);
            }

            $users->update($columns);

            return redirect()
                ->back()
                ->with('message', 'Atualizado com sucesso');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        if (!$user = $this->repository->where('id', $uuid)->first()) {
            return redirect()
                ->route('users.index')
                ->with('message', 'Registro não encontrado!');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('message', 'Deletado com sucesso!');
    }

    public function settings(Request $request)
    {
        $layout = $request->input('layout');
        $type = $request->input('type');

        $user = auth()->user();

        $settingsUser = $user->settings;

        if ($type == 'data_layout') {
            $columns = [
                "layout_mode" => $settingsUser["layout_mode"],
                "data_layout" => $layout
            ];
        } else {
            $columns = [
                "layout_mode" => $layout,
                "data_layout" => $settingsUser["data_layout"]
            ];
        }

        $user->settings = $columns;
        $user->save();
        $user->update();
    }
}
