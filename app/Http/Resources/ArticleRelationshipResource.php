<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use function Symfony\Component\Debug\Tests\testHeader;

class ArticleRelationshipResource extends Resource
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
            'author' => [
                'links' => [
                    'self' => route('articles.relationships.author', [
                        'article' => $this->id
                    ]),
                    'related' => route('articles.author', [
                        'article' => $this->id
                    ])
                ],
                'data' => new AuthorIdentifierResource($this->author)
            ],
            'comments' => (new ArticleCommentsRelationshipResource($this->comments))->additional(['article' => $this])
        ];
    }

    /**
     * used to add meta data to our resources
     *      handy to split out non entity based data out from your resource
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'links' => [
                'self' => route('articles.index')
            ]
        ];
    }
}
