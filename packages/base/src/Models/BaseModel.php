<?php


namespace drafeef\base\Models;

use drafeef\base\Constants\Request;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{

    protected $primaryKey = 'id';

    public $incrementing = true;


    /**
     * @param $data array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for create self
     */

    final static public function createSelf(array $data)
    {

        return self::create($data);
    }

    /**
     * @param object $obj
     * @param string $relation
     * @param array $data
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for create by relation
     */

    final static public function createByRelation(object $obj , string $relation,array $data)
    {
        return $obj->$relation()->create($data);
    }


    /**
     * @param $data array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for get data by custom query
     */

    final static public function getWhere(array $data){

        return self::where($data)->get();

    }

    /**
     * @param $data array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for get data by custom query With relation is optional
     */

    final static public function getWhereHas(array $data, String $relation_name, array $relation_condition){

        return self::where($data)
            ->whereHas($relation_name, function ($query) use ($relation_condition) {
                $query->where($relation_condition);
            })->get();
    }

    /**
     * @param $data array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for find row by custom query With relation is optional
     */

    final static public function findWhereHas(array $data, String $relation_name, array $relation_condition){

        return self::where($data)
            ->whereHas($relation_name, function ($query) use ($relation_condition) {
                $query->where($relation_condition);
            })->first();
    }
    /**
     * @param $column string
     * @param $data array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for find max value for specific column
     */

    final static public function whereMax(array $data ,string $column){

        return self::where($data)->max($column);

    }

    /**
     * @param $data array
     * @param $dataIn array
     * @param $key string
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for get data by custom query
     */

    final static public function getWhereIn(string $key,array $dataIn , array $data = []){

        return self::whereIn($key,$dataIn)->where($data)->get();

    }

    /**
     * @param $data array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for find row by custom query
     */

    final static public function findWhere(array $data){

        return self::where($data)->first();

    }

    /**
     * @param $data array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for sum specific column for specific query data
     */

    final static public function sumWhere(array $data , string $column){

        return self::where($data)->sum($column);
    }

    /**
     * @param $data array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for sum specific column for specific query data
     */

    final static public function countWhere(array $data ){

        return self::where($data)->count();
    }


    /**
     * @param $data array
     * @param $limit int
     * @param $with array
     * @param $order_by string
     * @param $order_by string
     * @param $data_in array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for get data by custom query - pagination
     */

    final static public function getPaginate(array $data , $limit , $with = [] , $order_by = "id" , $sort = "ASC",$data_in=[]){

        return self::where($data)->with($with)->when($data_in, function ($q) use ($data_in) {
           foreach ($data_in as $key=> $val)
            $q->whereIn($key,$val);
        })->orderBy($order_by , $sort)->paginate($limit);

    }


    /**
     * @param $data array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for get data by custom query - pagination
     */

     static public function updateWhere(array $dataWhere , array $dataToUpdate){

        return self::where($dataWhere)->update($dataToUpdate);
    }

    /**
     * @param $data array
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for delete custom query
     */

    final static public function deleteWhere(array $data){

        return self::where($data)->delete();

    }

    /**
     * @param $id int
     * @return self
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This function for delete by id ( useful observer  fired )
     */

    final static public function deleteById(int $id){
        return self::find($id)->delete();
    }


    /****************************************************************
     * @author anas.almasri@merwas.net
     * @Description use this scope function shared between all models
     * Scope function
     ***************************************************************/

    public function scopeYear($query,$year)
    {
        return $query->whereYear('created_at', $year);
    }

    public function scopeMonth($query,$month)
    {
        return $query->whereMonth('created_at', $month);
    }
    public function scopeBetweenMonth($query,$from_month,$to_month)
    {
        return $query->whereMonth('created_at','>=' ,$from_month)->whereMonth('created_at','<=',$to_month);
    }



    /**
     * @param $id
     * @param $slug
     * @param $local
     * @param $data array
     * @return self
     * @author Ibtisam al-hitteh
     * @Description This function for find row by custom query
     */

    final static public function findByIdOrSlug($id, $slug , $local , array $data){

        return self::where($data)
        ->where('id',$id)
        ->orWhere('slug->'.$local ,$slug)
        ->first();
    }

    /**
     * @param $id
     * @param $slug
     * @param $local
     * @return self
     * @author Ibtisam al-hitteh
     * @Description This function for delete custom query
     */

    final static public function deleteWhereIdorSlug($id, $slug , $local){

        return self::where('id',$id)
        ->orWhere('slug->'.$local ,$slug)
        ->delete();
    }

}
