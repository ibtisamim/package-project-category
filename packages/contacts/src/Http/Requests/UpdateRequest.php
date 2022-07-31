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

class UpdateRequest extends BaseRequest
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
        $rules['is_done'] = ['required'];
        $rules['result_description'] = ['required']; 

        return $rules;

    }

    
}
