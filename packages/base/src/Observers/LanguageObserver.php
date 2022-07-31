<?php

namespace drafeef\base\Observers;


use drafeef\base\Models\Language;
use drafeef\base\Constants\Status;

class LanguageObserver
{


    public function updated(Language $model)
    {
    }

    public function updating(Language $model)
    {
    }


    public function created(Language $model)
    {

    }


    public function creating(Language $model)
    {
        $model->status = Status::ACTIVE;
    }


    public function deleted(Language $model)
    {
    }


    public function deleting(Language $model)
    {
    }

    function restored(Language $model)
    {
    }


    public function restoring(Language $model)
    {
    }
}
