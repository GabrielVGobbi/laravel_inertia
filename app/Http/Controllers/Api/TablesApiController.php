<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionsResource;
use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Permissions\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TablesApiController extends Controller
{
    protected $limit, $offset, $order;

    public function __construct(Request $request)
    {

        $this->limit    = $request->input('pageSize') ?? '10';
        $this->order    = $request->input('order') ?? 'asc';
        $this->offset   = $request->input('offset') ?? 0;
        $this->search   = $request->input('search') ?? '';
        $this->sort     = $request->input('sort') ?? 'id';
        $this->filter   = $request->input('filter') ?? [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $users = new User();

        $users = $this->get($users);

        return UsersResource::collection($users);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions()
    {
        $permissions = new Permission();

        $permissions = $this->get($permissions);

        return PermissionsResource::collection($permissions);
    }

    /**
     * Display query for DB.
     * @param  \Illuminate\Http\Model  $model
     * @param  array  $searchColumns colunas que podem ser pesquisadas
     * @param  array  $withCount
     * @return \Illuminate\Http\Response
     */
    private function get(Model $model, $with = [])
    {
        $filters = $this->filter;

        $searchColumns = method_exists($model, 'getSearchColumns')
            ? $model->getSearchColumns()
            : $model->getFillable();

        $model = $model
            ->where(function ($query) use ($searchColumns) {
                $search = $this->search;
                if ($search != '' && !is_null($searchColumns)) {
                    foreach ($searchColumns as $searchColumn) {
                        $query->Orwhere($searchColumn, 'LIKE', "%$search%");
                    }
                }
            })
            ->where(function ($query) use ($filters) {
                if ($filters) {
                    foreach ($filters as $column => $filter) {
                        $query->Orwhere($column, 'LIKE', "%$filter%");
                    }
                }
            })
            ->orderBy($this->sort, $this->order);

        if (!empty($with)) {
            $model->with($with);
        }

        #dd([$model->toSql(), $model->getBindings()]);

        return $this->limit == 'all' ? $model->get() : $model->paginate($this->limit);
    }
}
