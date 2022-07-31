<?php

namespace drafeef\contacts\Rules;

use drafeef\base\Models\Language;
use drafeef\base\Constants\Status;
use Illuminate\Contracts\Validation\Rule;

class CheckLanguagesCountRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
		
        return (count($value) >=  Language::findWhere(['status' => Status::ACTIVE])->count());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('base::response.languages_not_all_inserted');
    }
}
