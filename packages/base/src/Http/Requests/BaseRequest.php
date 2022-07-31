<?php

/***************************************************************
 *
 * @Original_Author: Anas almasri (anas.almasri@merwas.net)
 * @Description: This Base Request
 *
 ***************************************************************
 */

namespace drafeef\base\Http\Requests;


use drafeef\base\Foundation\ResponseTemplate;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest {


    public function authorize(){

        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            ResponseTemplate::error(
                Response::HTTP_BAD_REQUEST,
                'validation error',
                $errors)
        );
    }


}
