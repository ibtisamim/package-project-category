<?php

/***************************************************************
 *
 * @Original_Author: ibtisam.alhitteh
 * @Description: to check data article request validation by specific id
 *
 ***************************************************************
 */
namespace drafeef\categories\Http\Requests\Article;

use drafeef\categories\Http\Requests\BaseRequest;
use drafeef\categories\Rules\Article\CheckArticleExistRule;
use drafeef\categories\Rules\Article\CheckArticleSlugExistRule;


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
 
        $rules['id'] = ['required_without:slug' , new CheckArticleExistRule()];
        $rules['slug'] = ['required_without:id' , new CheckArticleSlugExistRule()];
        return $rules;
    }

    public function validationData()
    {
        // Add the Route parameters to you data under validation
        return array_merge($this->all(),$this->route()->parameters());
    }
}
