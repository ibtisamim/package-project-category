<?php

/***************************************************************
 *
 * @Original_Author: ibtisam.alhitteh
 * @Description: to check data home section request validation
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Requests\Section;

use drafeef\categories\Http\Requests\BaseRequest;
use drafeef\categories\Rules\Section\CheckSectionExistRule;
use drafeef\categories\Rules\Section\CheckSectionSlugExistRule;

class DeleteRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules['id'] = ['required_without:slug' , new CheckSectionExistRule()];
        $rules['slug'] = ['required_without:id' , new CheckSectionSlugExistRule()];
        return $rules;
    }

    public function validationData()
    {
        // Add the Route parameters to you data under validation
        return array_merge($this->all(),$this->route()->parameters());
    }
}
