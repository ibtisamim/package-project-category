<?php

/***************************************************************
 *
 * @Original_Author: ibtisam.alhitteh
 * @Description: to check data category request validation by specific id
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Requests\Category;

use drafeef\categories\Http\Requests\BaseRequest;
use drafeef\categories\Rules\Category\CheckCategoryParentExistRule;


class ListCategoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if (($this->has('parent_id')) && ($this->parent_id)){
            foreach($this->parent_id as $key => $val){
                $rules['parent_id.'.$key] = ['required'  , new CheckCategoryParentExistRule()];
            }
        }
        return $rules;
    }

    public function prepareForValidation()
    {
        $input = $this->except('page','limit');
        if (($this->has('parent_id')) && (empty($this->parent_id))) {
            $input['parent_id'] = null; // Modify input here
        }
        $this->replace($input);
    }
}
