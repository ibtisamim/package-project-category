<?php

/***************************************************************
 *
 * @Original_Author: anas almasri (anas.almasri@merwas.net) , completed by ibtisam alhitteh
 * @Description: This contact us controller to add any contact from user and view to admin ( index (list) , add ,edit , view , del )
 *
 ***************************************************************
 */

namespace drafeef\contacts\Http\Controllers;

use PHPUnit\Exception;
use Illuminate\Http\Response;
use drafeef\base\Foundation\Log;
use Illuminate\Support\Facades\Auth;
use drafeef\contacts\Models\ContactUs;
use drafeef\base\Foundation\Collection;
use drafeef\users\Constants\Roles\Role;
use drafeef\base\Foundation\ResponseTemplate;
use drafeef\contacts\Http\Requests\ListRequest;
use drafeef\contacts\Http\Requests\ViewRequest;
use drafeef\contacts\Http\Requests\StoreRequest;
use drafeef\contacts\Http\Requests\UpdateRequest;
use drafeef\contacts\Http\Requests\DeleteRequest;
use drafeef\contacts\Http\Resources\ContactUsResource;


class ContactUsController extends BaseController
{

    /*
     * hint
     * end point to add new contact meesage from student ( mobile )
     * end point to view all (by admin)
     * end point to view specific contact message by id
     * endpoint to update status of contact ( is_done , and maybe add description ) , don't forget add ( action by =>admin id )
     */


    /**
     * @return mixed
     * ||************************* API Reference *********************************||
     * @uses  This API for get all contact us
     * @author Ibtisam.alhitteh
     * @version V1
     * @endpoint /api/drafeef/v1/index
     * @method GET
     * ||************************* API Reference *********************************||
     */

    public function index(ListRequest $request)
    {
        try {

            $sort = Collection::getSortByRole(['sort_type'=>'DESC','sort_attr'=>'created_at']);
            $data = array();            
            $status = $this->getStatus();
            $limit = $this->getLimit();


            $item = ContactUs::getPaginate($data , $limit , [] ,  $sort['sort_attr'] , $sort['sort_type'] );

            return ResponseTemplate::pagination(
                Response::HTTP_OK ,
                $limit ,
                $this->getPage() , $item->total() ,
                trans('base::response.data_retrieved_successfully'),
                ContactUsResource::collection($item)
            );

        }catch (Exception $exception) {

            log::errorLog(
                FALSE,
                $exception->getFile() ,
                $exception->getLine() ,
                $exception->getMessage() ,
                __CLASS__ . '--' . __FUNCTION__
            );

            return ResponseTemplate::exceptionError(
                trans('base::response.process_failed'),
            );
        }
    }


    /**
     * @return mixed
     * ||************************* API Reference *********************************||
     * @uses  This API for create new contact us
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/v1/store
     * @method POST
     * ||************************* API Reference *********************************||
     */

    public function store(StoreRequest $request)
    {
        try {
            
            $data = $request->only(['name','email','phone','message']);    
            $user = Auth::guard('api')->user(); 
            if ($user) {
                if ($user->hasRole(Role::STUDENT)){
                    $data['user_id'] = $user->id;
                }
            }

            $item = ContactUs::createSelf($data);

            return ResponseTemplate::success(
                Response::HTTP_OK ,
                trans('base::response.data_created_successfully'),
                ContactUsResource::make($item)
            );

        }catch (Exception $exception) {

            log::errorLog(
                FALSE,
                $exception->getFile() ,
                $exception->getLine() ,
                $exception->getMessage() ,
                __CLASS__ . '--' . __FUNCTION__
            );

            return ResponseTemplate::exceptionError(
                trans('base::response.process_failed'),
            );

        }

    }

    /**
     * @return mixed
     * ||************************* API Reference *********************************||
     * @uses  This API for Display the specified contact us
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/v1/view
     * @method GET
     * ||************************* API Reference *********************************||
     */
    public function show(ViewRequest $request)
    {
        try {

            $data = $request->only(['id']);
            
            $status = $this->getStatus();
            if($status)
                array_push($data,$status);

            $item = ContactUs::findWhere($data);

            return ResponseTemplate::success(
                Response::HTTP_OK ,
                trans('base::response.data_retrieved_successfully'),
                $item?ContactUsResource::make($item):[]
            );

        }catch (Exception $exception) {

            log::errorLog(
                FALSE,
                $exception->getFile() ,
                $exception->getLine() ,
                $exception->getMessage() ,
                __CLASS__ . '--' . __FUNCTION__
            );

            return ResponseTemplate::exceptionError(
                trans('base::response.process_failed'),
            );

        }
    }

    /**
     * @return mixed
     * ||************************* API Reference *********************************||
     * @uses  This API for update contact us
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/v1/update
     * @method POST
     * ||************************* API Reference *********************************||
     */

    public function update(UpdateRequest $request)
    {
        try {

            $dataToUpdate =  $request->only(['is_done','action_by','result_description']);
            $user = Auth::guard('api')->user();
            if ($user) {
                if ($user->hasRole(Role::ADMIN)){
                    $dataToUpdate['action_by'] = $user->id;
                }
            }

            $dataWhere = $request->only(['id']);
            ContactUs::updateWhere($dataWhere , $dataToUpdate);
            

            return ResponseTemplate::success(
                Response::HTTP_OK ,
                trans('base::response.data_updated_successfully'),
              []
            );

        }catch (Exception $exception) {

            log::errorLog(
                FALSE,
                $exception->getFile() ,
                $exception->getLine() ,
                $exception->getMessage() ,
                __CLASS__ . '--' . __FUNCTION__
            );

            return ResponseTemplate::exceptionError(
                trans('base::response.process_failed'),
            );

        }

    }

    /**
     * @return mixed
     * ||************************* API Reference *********************************||
     * @uses  This API for delete contact us
     * @author Ibtisam al-hitteh
     * @version V1
     * @endpoint /api/drafeef/v1/destroye
     * @method DELETE
     * ||************************* API Reference *********************************||
     */

    public function destroy(DeleteRequest $request)
    {

        try {

            $user = Auth::guard('api')->user();
            if (($user) && (!$user->hasRole(Role::ADMIN))) {

                $data = $request->only(['id']);
                $contact_us = ContactUs::deleteWhere($data);

                return ResponseTemplate::success(
                    Response::HTTP_OK ,
                    trans('base::response.data_deleted_successfully'),
                    []
                );

            }else{

                return ResponseTemplate::success(
                    Response::ERROR ,
                    trans('base::response.process_failed'),
                    []
                );

            }

        }catch (Exception $exception) {

            log::errorLog(
                FALSE,
                $exception->getFile() ,
                $exception->getLine() ,
                $exception->getMessage() ,
                __CLASS__ . '--' . __FUNCTION__
            );

            return ResponseTemplate::exceptionError(
                trans('base::response.process_failed'),
            );

        }

    }

}
