<?php


/***************************************************************
 *
 * @Original_Author: ibtisam.alhitteh
 * @Description: to check data home section request validation
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Requests\Section;

use Illuminate\Support\Str;
use drafeef\categories\Http\Requests\BaseRequest;
use drafeef\categories\Rules\CheckIconFileExistRule;
use drafeef\categories\Rules\CheckLanguagesCountRule;
use drafeef\categories\Rules\CheckLanguageIdKeyExistRule;
use drafeef\categories\Rules\Section\CheckSlugOldDefinedRule;

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
        $rules['description'] = ['required'];
        $rules['slug'] = ['required'];
        $rules['icon'] = ['nullable','image' , 'mimes:jpeg,jpg,png'];

        if(count($this->title) > 0){ 
            $rules['title'] = ['required' , new CheckLanguagesCountRule()];
            $rules['description'] = ['required' , new CheckLanguagesCountRule()];
            $rules['slug'] = ['required' , new CheckLanguagesCountRule()];
        }else{
            $rules['title.*'] = ['required'];
            $rules['slug.*'] = ['required'];
            $rules['description.*'] = ['required'];
        }

        foreach($this->title as $key => $val){
            $rules['title.'.$key] = [new CheckLanguageIdKeyExistRule()];
            $rules['slug.'.$key] = [new CheckLanguageIdKeyExistRule() , new CheckSlugOldDefinedRule()];
            $rules['description.'.$key] = [new CheckLanguageIdKeyExistRule()];
        }

        if (($this->has('icon')) && ($this->icon) ) {
            $rules['icon'] = [new CheckIconFileExistRule()];
        }

        return $rules;
    }

    public function prepareForValidation()
    {
        $input = $this->except('page','limit');
        
        if ($this->slug){
            foreach($this->slug as $key => $val){
                $input['slug.'.$key] = Str::slug($this->val , "-");
            }
        }
        $this->replace($input);
    }

}
