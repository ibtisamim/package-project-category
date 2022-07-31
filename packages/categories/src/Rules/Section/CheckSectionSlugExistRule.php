<?php

namespace drafeef\categories\Rules\Section;

use drafeef\categories\Models\Section;
use Illuminate\Contracts\Validation\Rule;

class CheckSectionSlugExistRule implements Rule
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
        $current_local = app()->getLocale();
        return !empty(Section::findWhere(['slug->'.$current_local => $value]));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('categories::response.slug_found');
    }
}
