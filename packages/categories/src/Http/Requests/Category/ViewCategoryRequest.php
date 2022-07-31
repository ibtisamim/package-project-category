<?php

/***************************************************************
 *
 * @Original_Author: ibtisam.alhitteh
 * @Description: to check data Category request validation by specific id
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Requests\Category;

use drafeef\base\Constants\Status;
use drafeef\categories\Http\Requests\BaseRequest;
use drafeef\categories\Rules\Category\CheckSlugExistRule;
use drafeef\categories\Rules\Category\CheckCategoryExistRule;

class ViewCategoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules['id'] = ['required_without:slug' , new CheckCategoryExistRule()];
        $rules['slug'] = ['required_without:id' , new CheckSlugExistRule()];
        return $rules;
    }

    public function validationData()
    {
        // Add the Route parameters to you data under validation
        return array_merge($this->all(),$this->route()->parameters());
    }


}
