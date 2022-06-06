<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message' => isset($this->data) ? $this->data['message'] : '',
            'description' => isset($this->data) ? $this->data['description'] : '',
            'icon' => isset($this->data) ? $this->data['icon'] : '',
            'link' => isset($this->data) ? $this->data['link'] : '',
            'type' => isset($this->data) ? $this->data['type'] : '',
            'dateForHumans' => dateTournamentForHumans($this->created_at),
            'route' => route('notifications.read', $this->id),
        ];
    }
}
