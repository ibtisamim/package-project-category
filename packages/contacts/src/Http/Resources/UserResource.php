<?php

/*
 * @author Ibtisam alhitteh
 * @Description: This is resource class for return user send contact form data
 */

namespace drafeef\contacts\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $id
 * @property string $name
 * @property string $flag
 * @property string $result_description
 */

class UserResource extends JsonResource
{
    public function toArray($request)
    {
            $data = [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
			];

        return $data;
    }
}
