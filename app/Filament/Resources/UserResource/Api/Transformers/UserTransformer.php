<?php
namespace App\Filament\Resources\UserResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTransformer extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'bookmarks' => $this->bookmarks,
        ];
    }
}
