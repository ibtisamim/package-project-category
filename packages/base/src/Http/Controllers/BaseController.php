<?php

namespace drafeef\base\Http\Controllers;

use drafeef\base\Constants\Status;
use drafeef\base\Constants\Request;
use App\Http\Controllers\Controller;
use drafeef\users\Constants\Roles\Role;
use drafeef\base\Constants\LanguageCode;

class BaseController extends Controller {

    public function __construct(){

        if (request()->hasHeader('Accept-Language') && in_array(request()->header('Accept-Language') , LanguageCode::LIST)) {

            app()->setLocale(request()->header('Accept-Language'));

        }

    }

    final public function getLimit(){

       $limit =  request()->has('limit') && request()->get('limit') != null && is_int((int)request()->get('limit')) ? request()->get('limit') : Request::MAX_LIMIT;

       if ($limit > Request::MAX_LIMIT || $limit < Request::MIN_LIMIT) {

           $limit = Request::MAX_LIMIT;
       }

       return $limit;

    }

    final public function getPage(){

      return  request()->has('page') && request()->get('page') != null && is_int((int)request()->get('page')) ? request()->get('page') : Request::DEFAULT_PAGE;

    }

     public function getStatus(){

      

        if (request()->has('status'))
        {
            if (in_array(request()->get('status'),Status::LIST))
            {
                return ['status','=',request()->get('status')];
            }else{
                return ['status','=',Status::ACTIVE];
            }
        }else{

            return [];
        }

    }


}
