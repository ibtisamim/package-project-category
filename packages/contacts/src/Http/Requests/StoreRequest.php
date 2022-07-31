<?php


/***************************************************************
 *
 * @Original_Author: ibtisam.alhitteh
 * @Description: to check data contact request validation
 *
 ***************************************************************
 */

namespace drafeef\contacts\Http\Requests;

class StoreRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules['name'] = ['required'];
        $rules['phone'] = ['required'];
        $rules['email'] = ['required'];
        $rules['message'] = ['required'];

        return $rules;
    }

}
