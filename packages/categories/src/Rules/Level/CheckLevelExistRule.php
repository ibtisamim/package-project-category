<?php

namespace drafeef\categories\Rules\Level;

use drafeef\categories\Models\Level;
use Illuminate\Contracts\Validation\Rule;

class CheckLevelExistRule implements Rule
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
       
        return !empty(Level::findWhere(['id' => $value]));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('categories::response.level_not_found');
    }
}
