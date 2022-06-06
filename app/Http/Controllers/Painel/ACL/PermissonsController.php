<?php

namespace App\Http\Controllers\Painel\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permissions\Models\Permission;

class PermissonsController extends Controller
{
    protected $repository;

    public function __construct(Permission $permissions)
    {
        $this->repository = $permissions;
        $this->middleware('permission:permissions');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->repository->all();

        return view('painel.acl.permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permissions  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()
                ->route('permissions.index')
                ->with('message', 'Registro não encontrado!');
        }

        return view('painel.acl.permissions.show', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $columns = $request->all();

        $permissions = $request->only(['permissions']);

        if (!$role = $this->repository->find($id)) {
            return redirect()
                ->route('permissions.index')
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

        if (isset($columns['crud'])) {
            $this->createdCrudPermission($columns);

            return redirect()
                ->route('permissions.index')
                ->with('message', 'Crud de Permissão criado com sucesso');
        }

        $role = $this->repository->create($columns);

        return redirect()
            ->route('permissions.show', $role->id)
            ->with('message', 'Criado com sucesso');
    }

    public function createdCrudPermission(array $columns)
    {
        $name = ucfirst($columns['name']);
        $slug = clear($columns['name']);

        $crud = [
            [
                'name' => "Visualizar $name",
                'groups' => $name,
                'description' => "Permissão para VISUALIZAR as $name cadastrados no sistema",
                'slug' => "view-$slug",
            ],
            [
                'name' => "Editar $name",
                'groups' => $name,
                'description' => "Permissão para EDITAR as $name cadastrados no sistema",
                'slug' => "update-$slug",
            ],
            [
                'name' => "Adicionar $name",
                'groups' => $name,
                'description' => "Permissão para ADICIONAR as $name cadastrados no sistema",
                'slug' => "store-$slug",
            ],
            [
                'name' => "Deletar $name",
                'groups' => $name,
                'description' => "Permissão para DELETAR as $name cadastrados no sistema",
                'slug' => "destroy-$slug",
            ],
        ];

        try {
            foreach ($crud as $created) {
                $this->repository->create($created);
            }
        } catch (\Throwable $th) {
            report($th);

            dd($th);
        }

        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()
                ->route('permissions.index')
                ->with('message', 'Registro não encontrado!');
        }

        if (Permission::get()->count() == 1) {
            return redirect()
                ->route('permissions.show', $role->id)
                ->with('warning', 'Não é possivel excluir o unico registro!');
        }

        $role->delete();

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Deletado com sucesso!');
    }
}
