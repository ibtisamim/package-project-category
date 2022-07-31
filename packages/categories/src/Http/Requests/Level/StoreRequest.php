<?php


/***************************************************************
 *
 * @Original_Author: Ibtisam alhitteh
 * @Description: to check data Level request validation
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Requests\Level;

use drafeef\categories\Http\Requests\BaseRequest;
use drafeef\categories\Rules\CheckLanguagesCountRule;
use drafeef\categories\Rules\CheckLanguageIdKeyExistRule;

class StoreRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules['title'] = ['required'];
        $rules['model_type'] = ['required'];

        if(count($this->title) > 0){ 
            $rules['title'] = ['required' , new CheckLanguagesCountRule()];
        }else{
            $rules['title.*'] = ['required'];
        }

        foreach($this->title as $key => $val){
            $rules['title.'.$key] = [new CheckLanguageIdKeyExistRule()];
        }

        return $rules;
    }

}
