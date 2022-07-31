<?php

namespace drafeef\base\Observers;


use drafeef\base\Models\Label;
use drafeef\base\Constants\Status;

class LabelObserver
{


    public function updated(Label $model)
    {
    }

    public function updating(Label $model)
    {
    }


    public function created(Label $model)
    {

    }


    public function creating(Label $model)
    {
        $model->status = Status::ACTIVE;
    }


    public function deleted(Label $model)
    {
    }


    public function deleting(Label $model)
    {
    }

    function restored(Label $model)
    {
    }


    public function restoring(Label $model)
    {
    }
}
