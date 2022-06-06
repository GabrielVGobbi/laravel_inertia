<?php

namespace App\Http\Controllers\Painel\ACL;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Permissions\Models\Permission;
use App\Permissions\Models\Role;

class RolesController extends Controller
{
    protected $repository;

    public function __construct(Role $roles)
    {
        $this->repository = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->repository->NotDev()->paginate();

        return view('painel.acl.roles.index', ['roles' => $roles]);
    }

    public function scroll()
    {
        return view('painel.acl.roles.scrollinfinito');
    }

    public function roles()
    {
        $roles = $this->repository->paginate(5);
        return response()->json($roles);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\roles  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()
                ->route('roles.index')
                ->with('message', 'Registro não encontrado!');
        }

        $permissions = Permission::all();

        $permissionsGroup = $permissions->groupBy('groups')->sortBy('name');

        $rolePermissions = $role->permissions()->get()->toArray();
        foreach ($rolePermissions as $rolePerm) {
            $role_permission[] = $rolePerm['name'];
        }

        return view('painel.acl.roles.show', [
            'role' => $role,
            'rolePermissions' => $role_permission ?? [],
            'permissionsGroup' => $permissionsGroup->toArray() ?? []
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $columns = $request->all();

        $permissions = $request->only(['permissions']);

        if (!$role = $this->repository->find($id)) {
            return redirect()
                ->route('roles.index')
                ->with('message', 'Registro não encontrado!');
        }

        //$role->update($columns);

        foreach ($permissions as $permission) {
            $role->permissions()->sync($permission);
        }

        return redirect()
            ->back()
            ->with('message', 'Atualizado com sucesso');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $columns = $request->all();

        $role = $this->repository->create($columns);

        return redirect()
            ->route('roles.show', $role->id)
            ->with('message', 'Criado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()
                ->route('roles.index')
                ->with('message', 'Registro não encontrado!');
        }

        if (Role::get()->count() == 1) {
            return redirect()
                ->route('roles.show', $role->id)
                ->with('warning', 'Não é possivel excluir o unico registro!');
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('message', 'Deletado com sucesso!');
    }
}
