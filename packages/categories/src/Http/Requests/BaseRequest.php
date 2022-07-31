<?php

/***************************************************************
 *
 * @Original_Author: anas almasri (anas.almasri@merwas.net)
 * @Description: This Base Request from base
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Requests;

use drafeef\base\Http\Requests\BaseRequest as BaseRequestHelper;

class BaseRequest extends BaseRequestHelper {


    public function authorize(){

        return true;
    }


}
