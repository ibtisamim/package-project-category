<?php

namespace drafeef\contacts\Rules;

use drafeef\contacts\Models\ContactUs;
use Illuminate\Contracts\Validation\Rule;

class CheckContactUsExistRule implements Rule
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
        return !empty(ContactUs::findWhere(['id' => $value]));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('contacts::response.contact_not_found');
    }
}
