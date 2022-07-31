<?php

/***************************************************************
 *
 * @Original_Author: Ibtisam alhitteh
 * @Description: to check data level request validation by specific id
 *
 ***************************************************************
 */
namespace drafeef\categories\Http\Requests\Level;

use drafeef\categories\Http\Requests\BaseRequest;
use drafeef\categories\Rules\Level\CheckLevelExistRule;

class ViewRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules['id'] = ['required' , new CheckLevelExistRule()];
        return $rules;
    }

    public function validationData()
    {
        // Add the Route parameters to you data under validation
        return array_merge($this->all(),$this->route()->parameters());
    }
}
