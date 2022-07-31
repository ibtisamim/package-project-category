<?php

namespace drafeef\categories\Rules\Article;

use drafeef\categories\Models\Article;
use Illuminate\Contracts\Validation\Rule;


class CheckSlugOldDefinedRule implements Rule
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
        
        $lang_key = explode('.', $attribute);
        $lang_key = last($lang_key);
        return empty(Article::findWhere(['slug->'.$lang_key => $value]));
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
