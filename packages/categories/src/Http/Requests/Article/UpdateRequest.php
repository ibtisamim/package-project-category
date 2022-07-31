<?php

/***************************************************************
 *
 * @Original_Author: ibtisam.alhitteh
 * @Description: to check data article request validation
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Requests\Article;

use Illuminate\Support\Str;
use drafeef\categories\Http\Requests\BaseRequest;
use drafeef\categories\Rules\CheckIconFileExistRule;
use drafeef\categories\Rules\CheckLanguagesCountRule;
use drafeef\categories\Rules\CheckLanguageIdKeyExistRule;
use drafeef\categories\Rules\Article\CheckArticleExistRule;

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
        $rules['id'] = ['required' , new CheckArticleExistRule()];
        $rules['title'] = ['required'];
        $rules['description'] = ['required'];
        $rules['brief'] = ['required'];
        $rules['slug'] = ['required'];
        $rules['image'] = ['nullable','image' , 'mimes:jpeg,jpg,png'];

        //must grater than or equal active languages
        if(count($rules['title']) > 0){
            $rules['title'] = ['required' , new CheckLanguagesCountRule()];
            $rules['brief'] = ['required' , new CheckLanguagesCountRule()];
            $rules['description'] = ['required' , new CheckLanguagesCountRule()];
            $rules['slug'] = ['required' , new CheckLanguagesCountRule()];

        }else{
            $rules['title.*'] = ['required'];
            $rules['brief.*'] = ['required'];
            $rules['description.*'] = ['required'];
            $rules['slug.*'] = ['required'];
        }

        foreach($this->title as $key => $val){
            $rules['title.'.$key] = [new CheckLanguageIdKeyExistRule()];
            $rules['brief.'.$key] = [new CheckLanguageIdKeyExistRule()];
            $rules['slug.'.$key] = [new CheckLanguageIdKeyExistRule()];
            $rules['description.'.$key] = [new CheckLanguageIdKeyExistRule()];
        }
		
		
        if (($this->has('image')) && ($this->image) ) {
            $rules['image'] = [new CheckIconFileExistRule()];
        }

        return $rules;

    }

}
