<?php

/***************************************************************
 *
 * @Original_Author: ibtisam alhitteh
 * @Description: to check data level request validation
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Requests\Level;

use drafeef\categories\Http\Requests\BaseRequest;
use drafeef\categories\Rules\CheckLanguagesCountRule;
use drafeef\categories\Rules\Level\CheckLevelExistRule;
use drafeef\categories\Rules\CheckLanguageIdKeyExistRule;

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
        $rules['id'] = ['required' , new CheckSectionExistRule()];
        $rules['title'] = ['required'];
        $rules['model_type'] = ['required'];
       
        //must grater than or equal active languages
        if(count($rules['title']) > 0){
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
