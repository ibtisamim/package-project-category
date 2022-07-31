<?php

/*
 * @author Ibtisam alhitteh
 * @Description: This is resource class for return contact us form data
 */

namespace drafeef\contacts\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $id
 * @property string $name
 * @property string $flag
 * @property string $result_description
 */

class ContactUsResource extends JsonResource
{
    public function toArray($request)
    {
            $data = [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'message' => $this->message,
                'user' => UserResource::make($this->user) ,
                'is_done' => (bool)$this->is_done,
                'result_description' => $this->result_description,
                'by_admin' => $this->actionby?UserResource::make($this->actionby):null
			];

        return $data;
    }
}
