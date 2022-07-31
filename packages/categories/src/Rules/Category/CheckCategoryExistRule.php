<?php

namespace drafeef\categories\Rules\Category;

use drafeef\categories\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class CheckCategoryExistRule implements Rule
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
       
        return !empty(Category::findWhere(['id' => $value]));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('categories::response.category_not_found');
    }
}
