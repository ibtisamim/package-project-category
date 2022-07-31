<?php

namespace drafeef\categories\Rules\Article;

use drafeef\categories\Models\Article;
use Illuminate\Contracts\Validation\Rule;

class CheckArticleExistRule implements Rule
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
       
        return !empty(Article::findWhere(['id' => $value]));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('categories::response.article_not_found');
    }
}
