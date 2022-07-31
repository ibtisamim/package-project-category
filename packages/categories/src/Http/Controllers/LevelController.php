<?php

/***************************************************************
 *
 * @Original_Author: Ibtisam al-hitteh
 * @Description: This level controller to ( index (list) , add ,edit , view  ) 
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Controllers;

use PHPUnit\Exception;
use Illuminate\Http\Response;
use drafeef\base\Foundation\Log;
use drafeef\categories\Models\Level;
use Illuminate\Support\Facades\Auth;
use drafeef\base\Foundation\Collection;
use drafeef\users\Constants\Roles\Role;
use drafeef\base\Foundation\ResponseTemplate;
use drafeef\categories\Http\Resources\LevelResource;
use drafeef\categories\Http\Requests\Level\ViewRequest;
use drafeef\categories\Http\Requests\Level\ListRequest;
use drafeef\categories\Http\Requests\Level\StoreRequest;
use drafeef\categories\Http\Requests\Level\UpdateRequest;
use drafeef\categories\Http\Requests\Level\DeleteRequest;

class LevelController extends BaseController
{

    /*
     * hint
     * end point to edit level ( admin )
     * end point to view all levels with filter status active or inactive ( admin , mobile  )
     */
	 
    /**
     * @return mixed
     * ||************************* API Reference *********************************||
     * @uses  This API for get all level
     * @author Ibtisam.alhitteh
     * @version V1
     * @endpoint /api/drafeef/levels/v1/index
     * @method GET
     * ||************************* API Reference *********************************||
     */

    public function index(ListRequest $request)
    {
        try {
			$data = [];
            $sort = Collection::getSortByRole(['sort_type'=>'ASC','sort_attr'=>'sort'] , ['sort_type'=>'DESC','sort_attr'=>'id']);
            $status = $this->getStatus();
            $limit = $this->getLimit();

            if($status)
            array_push($data,$status);

            $item = Level::getPaginate($data , $limit , [] , $sort['sort_attr'] , $sort['sort_type'] );

            return ResponseTemplate::pagination(
                Response::HTTP_OK ,
                $limit ,
                $this->getPage() , $item->total() ,
                trans('base::response.data_retrieved_successfully'),
                LevelResource::collection($item)
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
     * @uses  This API for create new level
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/levels/v1/store
     * @method POST
     * ||************************* API Reference *********************************||
     */

    public function store(StoreRequest $request)
    {
        try {

            $data = $request->only(['title','model_type','sort','status']);
            $item = Level::createSelf($data);
           
            if (isset($dataToUpdate['image'])){
                // missing
            }
            return ResponseTemplate::success(
                Response::HTTP_OK ,
                trans('base::response.data_created_successfully'),
                LevelResource::make($item)
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
     * @uses  This API for Display the specified level
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/levels/v1/view
     * @method GET
     * ||************************* API Reference *********************************||
     */
    public function show(ViewRequest $request)
    {
        try {

            $data['id'] = $request->only(['id']);
            $status = $this->getStatus();
            if($status)
                array_push($data,$status);

            $item = Level::findWhere($data);

            return ResponseTemplate::success(
                Response::HTTP_OK ,
                trans('base::response.data_retrieved_successfully'),
                $item?LevelResource::make($item):[]
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
     * @uses  This API for update level
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/levels/v1/update
     * @method POST
     * ||************************* API Reference *********************************||
     */

    public function update(UpdateRequest $request)
    {
        try {

            $dataToUpdate =  $request->only(['title','model_type','sort','status']);
            $dataWhere = $request->only(['id']);
            Level::updateWhere($dataWhere , $dataToUpdate);

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
     * @uses  This API for delete level
     * @author Ibtisam al-hitteh
     * @version V1
     * @endpoint /api/drafeef/levels/v1/destroye
     * @method DELETE
     * ||************************* API Reference *********************************||
     */

    public function destroy(DeleteRequest $request)
    {

        try {
            $data['id'] = $request->only(['id']);
            $item = Level::deleteWhere($data);

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
