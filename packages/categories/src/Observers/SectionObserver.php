<?php

namespace drafeef\categories\Observers;

use drafeef\base\Constants\Status;
use drafeef\categories\Models\Section;
use drafeef\base\Foundation\Collection;

class SectionObserver
{


    public function updated(Section $model)
    {
    }

    public function updating(Section $model)
    {
    }


    public function created(Section $model)
    {

    }


    public function creating(Section $model)
    {
        $model->status = Status::INACTIVE;
            
        if ($model->icon){ 
            $moved = Collection::moveFile($model->icon,'sections\\'.$model->icon); 
        }
    }


    public function deleted(Section $model)
    {
    }


    public function deleting(Section $model)
    {
    }

    function restored(Section $model)
    {
    }


    public function restoring(Section $model)
    {
    }
}
