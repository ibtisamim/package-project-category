<?php

namespace drafeef\categories\Rules;

use drafeef\base\Models\Language;
use Illuminate\Contracts\Validation\Rule;

class CheckLanguageIdExistRule implements Rule
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
        return !empty(Language::findWhere(['id' => $value]));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('categories::response.language_not_found');
    }
}
