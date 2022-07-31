<?php

/***************************************************************
 *
 * @Original_Author: Ibtisam al-hitteh
 * @Description: This section controller to ( index (list) , add ,edit , view , del ) 
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Controllers;

use PHPUnit\Exception;
use Illuminate\Http\Response;
use drafeef\base\Foundation\Log;
use Illuminate\Support\Facades\Auth;
use drafeef\categories\Models\Section;
use drafeef\base\Foundation\Collection;
use drafeef\users\Constants\Roles\Role;
use drafeef\base\Foundation\ResponseTemplate;
use drafeef\categories\Http\Resources\SectionResource;
use drafeef\categories\Http\Requests\Section\ListRequest;
use drafeef\categories\Http\Requests\Section\ViewRequest;
use drafeef\categories\Http\Requests\Section\StoreRequest;
use drafeef\categories\Http\Requests\Section\UpdateRequest;
use drafeef\categories\Http\Requests\Section\DeleteRequest;

class SectionController extends BaseController
{

    /**
     * @return mixed
     * ||************************* API Reference *********************************||
     * @uses  This API for get all section
     * @author Ibtisam.alhitteh
     * @version V1
     * @endpoint /api/drafeef/sections/v1/index
     * @method GET
     * ||************************* API Reference *********************************||
     */

    public function index(ListRequest $request)
    {
        try {
            $data = array();
            $sort = Collection::getSortByRole(['sort_type'=>'ASC','sort_attr'=>'sort'] , ['sort_type'=>'DESC','sort_attr'=>'id']);
            
            $status = $this->getStatus();
            $limit = $this->getLimit();

            if($status)
            array_push($data,$status);

            $item = Section::getPaginate($data , $limit , [] , $sort['sort_attr'] , $sort['sort_type'] );

            return ResponseTemplate::pagination(
                Response::HTTP_OK ,
                $limit ,
                $this->getPage() , $item->total() ,
                trans('base::response.data_retrieved_successfully'),
                SectionResource::collection($item)
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
     * @uses  This API for create new section
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/sections/v1/store
     * @method POST
     * ||************************* API Reference *********************************||
     */

    public function store(StoreRequest $request)
    {
        try {

            $data = $request->only(['title','description','slug' , 'section_path' , 'link' ,'icon','sort','status']);
            $item = Section::createSelf($data);
           
            if (isset($dataToUpdate['image'])){
                // missing
            }
            return ResponseTemplate::success(
                Response::HTTP_OK ,
                trans('base::response.data_created_successfully'),
                SectionResource::make($item)
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
     * @uses  This API for Display the specified section
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/sections/v1/view
     * @method GET
     * ||************************* API Reference *********************************||
     */
    public function show(ViewRequest $request)
    {
        try {

            $data = array();
            $id = $request->only(['id']);
            $slug = $request->only(['slug']);
            $status = $this->getStatus();
            if($status)
                array_push($data,$status);

            $item = Section::findbyidorslug($id,$slug , app()->getLocale() , $data);


            return ResponseTemplate::success(
                Response::HTTP_OK ,
                trans('base::response.data_retrieved_successfully'),
                $item?SectionResource::make($item):[]
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
     * @uses  This API for update section
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/sections/v1/update
     * @method POST
     * ||************************* API Reference *********************************||
     */

    public function update(UpdateRequest $request)
    {
        try {

            $dataToUpdate =  $request->only(['title','description','slug' , 'section_path' , 'link' ,'icon','sort','status']);
            $dataWhere = $request->only(['id']);
            Section::updateWhere($dataWhere , $dataToUpdate);
            if (isset($dataToUpdate['icon'])){
                // missing
            }

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
     * @uses  This API for delete section
     * @author Ibtisam al-hitteh
     * @version V1
     * @endpoint /api/drafeef/sections/v1/destroye
     * @method DELETE
     * ||************************* API Reference *********************************||
     */

    public function destroy(DeleteRequest $request)
    {

        try {
            
            $id = $request->only(['id']);
            $slug = $request->only(['slug']);
            $item = Section::deleteWhereIdorSlug($id,$slug , app()->getLocale());

            return ResponseTemplate::success(
                Response::HTTP_OK ,
                trans('base::response.data_deleted_successfully'),
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

}
