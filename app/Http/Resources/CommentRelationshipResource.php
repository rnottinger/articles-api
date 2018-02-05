<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CommentRelationshipResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'author'   => [
                'data'  => new AuthorIdentifierResource($this->author),
            ],
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('comments.index'),
            ],
        ];
    }
}
