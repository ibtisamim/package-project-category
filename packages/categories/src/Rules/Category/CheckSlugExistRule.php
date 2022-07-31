<?php

namespace drafeef\categories\Rules\Category;

use drafeef\categories\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class CheckSlugExistRule implements Rule
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
        return !empty(Category::findWhere(['slug->'.$current_local => $value]));
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
