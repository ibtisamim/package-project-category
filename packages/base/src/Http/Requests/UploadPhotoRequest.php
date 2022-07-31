<?php

/***************************************************************
 *
 * @Original_Author: Anas Almasri (anas.almasri@merwas.net)
 * @Description: validation photo
 *
 ***************************************************************
 */

namespace drafeef\base\Http\Requests;

class UploadPhotoRequest extends BaseRequest {

    public function rules(){

        $rules = [];

        $rules['photo'] = ['required' , 'mimes:jpeg,bmp,png,jpg','max:2048'];

        return $rules;

    }

}
