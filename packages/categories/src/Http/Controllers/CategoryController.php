<?php

/***************************************************************
 *
 * @Original_Author: anas almasri (anas.almasri@merwas.net)
 * @Description: This category controller  ( index (list) , add ,edit , view , del )
 *
 ***************************************************************
 */

namespace drafeef\categories\Http\Controllers;

use PHPUnit\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use drafeef\base\Foundation\Log;
use Illuminate\Support\Facades\Auth;
use drafeef\base\Foundation\Collection;
use drafeef\users\Constants\Roles\Role;
use drafeef\categories\Models\Category;
use drafeef\base\Foundation\ResponseTemplate;
use drafeef\categories\Http\Resources\CategoryResource;
use drafeef\categories\Http\Requests\Category\ViewCategoryRequest;
use drafeef\categories\Http\Requests\Category\ListCategoryRequest;
use drafeef\categories\Http\Requests\Category\StoreCategoryRequest;
use drafeef\categories\Http\Requests\Category\UpdateCategoryRequest;
use drafeef\categories\Http\Requests\Category\DeleteCategoryRequest;


class CategoryController extends BaseController
{



    /**
     * @return mixed
     * ||************************* API Reference *********************************||
     * @uses  This API for get all categories
     * @author Ibtisam.alhitteh
     * @version V1
     * @endpoint /api/drafeef/categories/v1/index
     * @method GET
     * ||************************* API Reference *********************************||
     */

    public function index(ListCategoryRequest $request)
    {
        try {

            $data = array();
            
            $sort = Collection::getSortByRole(['sort_type'=>'ASC','sort_attr'=>'sort'] , ['sort_type'=>'DESC','sort_attr'=>'id']);

            $data = $request->only(['parent_id']);
            $status = $this->getStatus();
            $limit = $this->getLimit();
            $with = ['parent' , 'childrens'];

            if($status)
                array_push($data,$status);
            
            $whereIn = [];
            if($data['parent_id'])
                $whereIn = ['parent_id'=>$data['parent_id']];

            $categories = Category::getPaginate($data  , $limit , $with , $sort['sort_attr'] , $sort['sort_type'] ,$whereIn);

            return ResponseTemplate::pagination(
                Response::HTTP_OK ,
                $limit ,
                $this->getPage() , $categories->total() ,
                trans('base::response.data_retrieved_successfully'),
                CategoryResource::collection($categories)
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
     * @uses  This API for create new Category
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/categories/v1/store
     * @method POST
     * ||************************* API Reference *********************************||
     */

    public function store(StoreCategoryRequest $request)
    {
        try {

            $data = $request->only(['title','slug','description' ,'icon' ,'parent_id','status' , 'sort' ]);

            $category = Category::createSelf($data);
            if (isset($dataToUpdate['icon'])){
                // move icon to categories folder
            }

            return ResponseTemplate::success(
                Response::HTTP_OK ,
                trans('base::response.data_created_successfully'),
                CategoryResource::make($category)
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
     * @uses  This API for Display the specified Category
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/categories/v1/view
     * @method GET
     * ||************************* API Reference *********************************||
     */
    public function show(ViewCategoryRequest $request)
    {
        try {

            $data = array();
            $id = $request->only(['id']);
            $slug = $request->only(['slug']);

            $status = $this->getStatus();
            if($status)
                array_push($data,$status);


            $category = Category::findbyidorslug($id,$slug , app()->getLocale() , $data);

            return ResponseTemplate::success(
                Response::HTTP_OK ,
                trans('base::response.data_retrieved_successfully'),
                $category?CategoryResource::make($category):[]
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
     * @uses  This API for update category
     * @author ibtisam alhitteh
     * @version V1
     * @endpoint /api/drafeef/categories/v1/update
     * @method POST
     * ||************************* API Reference *********************************||
     */

    public function update(UpdateCategoryRequest $request)
    {
        try {

            $dataToUpdate =  $request->only(['title','slug','description' ,'icon' ,'parent_id','status' , 'sort' ]);
            $dataWhere = $request->only(['id']);

            Category::updateWhere($dataWhere , $dataToUpdate);
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
     * @uses  This API for delete category
     * @author Ibtisam al-hitteh
     * @version V1
     * @endpoint /api/drafeef/categories/v1/destroye
     * @method DELETE
     * ||************************* API Reference *********************************||
     */

    public function destroy(DeleteCategoryRequest $request)
    {

        try {

            $id = $request->only(['id']);
            $slug = $request->only(['slug']);

            $category = Category::deleteWhereIdorSlug($id,$slug , app()->getLocale());

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
