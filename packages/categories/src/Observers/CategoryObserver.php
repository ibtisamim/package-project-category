<?php

namespace drafeef\categories\Observers;


use drafeef\categories\Models\Category;
use drafeef\base\Constants\Status;
use drafeef\base\Foundation\Collection;

class CategoryObserver
{


    public function updated(Category $model)
    {
    }

    public function updating(Category $model)
    {
    }


    public function created(Category $model)
    {

    }


    public function creating(Category $model)
    {
        $model->status = Status::INACTIVE;
            
        if ($model->icon){ 
            // transfer file to folder places
            $moved = Collection::moveFile($model->icon,'categories\\'.$model->icon); 
        }
    }


    public function deleted(Category $model)
    {
    }


    public function deleting(Category $model)
    {
    }

    function restored(Category $model)
    {
    }


    public function restoring(Category $model)
    {
    }
}
