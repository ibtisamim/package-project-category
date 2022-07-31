<?php

/*
 * @author Ibtisam alhitteh
 * @Description: This is resource class for return category data
 */

namespace drafeef\categories\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $icon
 * @property int $parent_id
 * @property int $sort
 * @property int $status
 */

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {

            $data = [
                'id' => $this->id,
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'icon' => (string)$this->icon,
                'parent_id' => $this->parent_id,
                'next_level' => $this->childrens()->count(),
                'levels_number' => $this->getLevelNumber(),
              //  'parent' => CategoryResource::make($this->parent) ,
             //   'parents_tree' => CategoryResource::collection($this->parentsTree()->get()) ,
                'sort' => $this->sort,
                'status' => $this->status,
			];

        return $data;
    }
}
