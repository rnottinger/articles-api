<?php

namespace App\Http\Resources;

use App\Comment;
use App\People;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class ArticlesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'data' => ArticleResource::collection($this->collection)
        ];
        // $this->collection represents the collection
        //      that was passed from the controller
        //      to this resource collection --> Article::with(['author', 'comment.author'])->paginate()

    }
    public function with($request)
    {
        $comments = $this->collection->flatMap(
          function ($article) {
              return $article->comments;
          }
        );
        $authors = $this->collection->map(
            function ($article) {
                return $article->author;
            }
        );
        $included = $authors->merge($comments)->unique();
        return [
            'links' => [
                'self' => route('articles.index')
            ],
            'included' => $this->withIncluded($included)
        ];
    }

    public function withIncluded(Collection $included)
    {
        return $included->map(
            function ($include) {
                if ($include instanceof People) {
                    return new PeopleResource($include);
                }
                if ($include instanceof Comment) {
                    return new CommentResource($include);
                }
            }
        );
    }

}
