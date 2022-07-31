<?php

namespace drafeef\categories\Rules\Section;

use drafeef\categories\Models\Section;
use Illuminate\Contracts\Validation\Rule;

class CheckSectionExistRule implements Rule
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
       
        return !empty(Section::findWhere(['id' => $value]));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('categories::response.section_not_found');
    }
}
