<?php


/***************************************************************
 *
 * @Original_Author: ibtisam.alhitteh
 * @Description: to check data category request validation
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Requests\Category;

use Illuminate\Support\Str;
use drafeef\categories\Http\Requests\BaseRequest;
use drafeef\categories\Rules\CheckIconFileExistRule;
use drafeef\categories\Rules\CheckLanguagesCountRule;
use drafeef\categories\Rules\Category\CheckSlugExistRule;
use drafeef\categories\Rules\CheckLanguageIdKeyExistRule;
use drafeef\categories\Rules\Category\CheckSlugOldDefinedRule;
use drafeef\categories\Rules\Category\CheckCategoryParentExistRule;

class StoreCategoryRequest extends BaseRequest
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
        $rules['slug'] = ['required'];
        $rules['description'] = ['required'];
        $rules['icon'] = ['nullable','image' , 'mimes:jpeg,jpg,png'];

        //must grater than or equal active languages
        if(count($this->title) > 0){ 
            $rules['title'] = ['required' , new CheckLanguagesCountRule()];
            $rules['slug'] = ['required' , new CheckLanguagesCountRule()];
            $rules['description'] = ['required' , new CheckLanguagesCountRule()];
        }else{
            $rules['title.*'] = ['required'];
            $rules['slug.*'] = ['required'];
            $rules['description.*'] = ['required'];
        }

        foreach($this->title as $key => $val){
            $rules['title.'.$key] = [new CheckLanguageIdKeyExistRule()];
            $rules['slug.'.$key] = [new CheckLanguageIdKeyExistRule() , new CheckSlugExistRule() , new CheckSlugOldDefinedRule()];
            $rules['description.'.$key] = [new CheckLanguageIdKeyExistRule()];
        }

        if (($this->has('icon')) && ($this->icon )) {
             $rules['icon'] = [ new CheckIconFileExistRule()];
        }

        if (($this->has('parent_id')) && ($this->parent_id)) {
            $rules['parent_id'] = [ new CheckCategoryParentExistRule()];
        }else{
             $rules['parent_id'] = ['sometimes'];
        }

        return $rules;
    }

    public function prepareForValidation()
    {
        $input = $this->except('page','limit');
        if (($this->has('parent_id')) && ($this->parent_id  == 0)) {
            $input['parent_id'] = null; // Modify input here
        }

        if ($this->slug){
            foreach($this->slug as $key => $val){
                $input['slug.'.$key] = Str::slug($this->val , "-");
            }
        }
        $this->replace($input);
    }
}
