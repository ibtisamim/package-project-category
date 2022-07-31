<?php

namespace drafeef\categories\Rules;

use drafeef\base\Models\Language;
use Illuminate\Contracts\Validation\Rule;

class CheckLanguageIdKeyExistRule implements Rule
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
        $code = explode('.', $attribute);
        $code = last($code);

        return !empty(Language::findWhere(['code' => $code]));
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
