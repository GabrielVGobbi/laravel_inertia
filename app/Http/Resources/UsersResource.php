<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $el = [
            'id' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($request->filled('permissions')) {
            $permissions = $this->permissions ?? $this->permissions()->get();
            $el['permissions'] = PermissionsResource::collection($permissions);
        }

        return $el;
    }
}
