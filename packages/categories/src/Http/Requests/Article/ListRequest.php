<?php

/***************************************************************
 *
 * @Original_Author: ibtisam.alhitteh
 * @Description: to check data articles request validation 
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Requests\Article;

use  drafeef\categories\Http\Requests\BaseRequest;

class ListRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [];
        return $rules;

    }

    public function prepareForValidation()
    {
        $input = $this->except('page','limit');
        $this->replace($input);
    }
}
