<?php

namespace drafeef\categories\Observers;

use drafeef\base\Constants\Status;
use drafeef\categories\Models\Level;
use drafeef\base\Foundation\Collection;

class LevelObserver
{


    public function updated(Level $model)
    {
    }

    public function updating(Level $model)
    {
    }


    public function created(Level $model)
    {

    }


    public function creating(Level $model)
    {
        $model->status = Status::ACTIVE;
    }


    public function deleted(Level $model)
    {
    }


    public function deleting(Level $model)
    {
    }

    function restored(Level $model)
    {
    }


    public function restoring(Level $model)
    {
    }
}
