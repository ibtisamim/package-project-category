<?php

/***************************************************************
 *
 * @Original_Author: ibtisam.alhitteh
 * @Description: to check data contact request validation
 *
 ***************************************************************
 */

namespace drafeef\contacts\Http\Requests;

use drafeef\contacts\Rules\CheckContactUsExistRule;

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
        $rules['id'] = ['required' , new CheckContactUsExistRule()];
        return $rules;
    }

    public function validationData()
    {
        // Add the Route parameters to you data under validation
        return array_merge($this->all(),$this->route()->parameters());
    }
}
