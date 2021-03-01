<?php

namespace Ivanradojevic\Urldesk\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RedirectResource extends JsonResource
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
            'redirect_from' => $this->redirect_from,  
            'redirect_to' => $this->redirect_to,
            'status_code' => $this->status_code
        ];
    }
}
