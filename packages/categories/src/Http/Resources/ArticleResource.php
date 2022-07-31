<?php

/*
 * @author Ibtisam alhitteh
 * @Description: This is resource class for return article data
 */

namespace drafeef\categories\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $brief
 * @property string $description
 * @property string $slug
 * @property int $views_count
 * @property int $sort
 * @property int $status
 */

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {       
        if(Auth::user())
            $is_liked = $this->userlikes()->where('user_id',Auth::user()->id)->count();
        else
            $is_liked = 0;
        
            $data = [
                'id' => $this->id,
                'title' => $this->title,
                'slug' => $this->slug,
                'brief' => $this->brief,
                'description' => $this->description,
                'image' => $this->image,
                'views_count' => $this->views_count,
                'likes_count' => $this->userlikes()->count(),
                'is_like' => (bool)$is_liked,
                'sort' => $this->sort,
                'status' => $this->status
			];

        return $data;
    }
}
