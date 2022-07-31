<?php

/*
 * @author Ibtisam alhitteh
 * @Description: This is resource class for return home section data
 */

namespace drafeef\categories\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property string $icon
 * @property string $link
 * @property string $description
 * @property string $slug
 * @property int $sort
 * @property int $status
 */

class SectionResource extends JsonResource
{
    public function toArray($request)
    {
            $data = [
                'id' => $this->id,
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'icon' => $this->icon,
                'link' => $this->link,
                'section_path' => $this->section_path,
                'sort' => $this->sort,
                'status' => $this->status
			];

        return $data;
    }
}
