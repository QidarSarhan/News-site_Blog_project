<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        // dd($request);

        return [
            'logo' => asset($this->logo),
            'favicoin' => asset($this->favicoin),
            'created' => $this->created_at->format('Y-m-D'),
            'instagram' => $this->instagram,
            'phone' => $this->phone,
            'email' => $this->email,
            'title' => $this->title,
            'content' => $this->content,
            'address' => $this->address,
        ];
          
        // return $this->resource->logo;


        // return $data;
    }
}
