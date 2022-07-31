<?php

/*
 * @author Ibtisam alhitteh
 * @Description: This is resource class for return level data
 */

namespace drafeef\categories\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property string $model_type
 * @property int $sort
 * @property int $status
 */

class LevelResource extends JsonResource
{
    public function toArray($request)
    {
            $data = [
                'id' => $this->id,
                'title' => $this->title,
                'model_type' => $this->model_type,
                'sort' => $this->sort,
                'status' => $this->status
			];

        return $data;
    }
}
