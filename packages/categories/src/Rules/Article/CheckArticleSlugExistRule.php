<?php

namespace drafeef\categories\Rules\Article;

use drafeef\categories\Models\Article;
use Illuminate\Contracts\Validation\Rule;

class CheckArticleSlugExistRule implements Rule
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
        return !empty(Article::findWhere(['slug->'.$current_local => $value]));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('categories::response.slug_not_found');
    }
}
