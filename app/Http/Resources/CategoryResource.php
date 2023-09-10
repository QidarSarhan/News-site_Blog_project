<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id'=>$this->id,
            'image'=>asset($this->image),
            'parent'=>$this->parent,
            'created_at'=>$this->created_at->format('Y-m-d'),
            // 'updated_at'=>$this->updated_at,
            // 'deleted_at'=>$this->deleted_at,
            'title'=>$this->title,
            'content'=>$this->content,
            'children'=>CategoryCollection::make($this->whenLoaded('children')),
            /* 'posts'=>$this->whenLoaded('posts'), */
            'posts'=>PostResource::collection($this->whenLoaded('posts')),              

        ];
    }
}
