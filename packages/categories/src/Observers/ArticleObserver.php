<?php

namespace drafeef\categories\Observers;

use drafeef\base\Constants\Status;
use drafeef\categories\Models\Article;
use drafeef\base\Foundation\Collection;

class ArticleObserver
{


    public function updated(Article $model)
    {
    }

    public function updating(Article $model)
    {
    }


    public function created(Article $model)
    {

    }


    public function creating(Article $model)
    {
        $model->status = Status::INACTIVE;
            
        if ($model->image){ 
            $moved = Collection::moveFile($model->image,'articles\\'.$model->image); 
        }
    }


    public function deleted(Article $model)
    {
    }


    public function deleting(Article $model)
    {
    }

    function restored(Article $model)
    {
    }


    public function restoring(Article $model)
    {
    }
}
