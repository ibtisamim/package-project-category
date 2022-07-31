<?php

namespace drafeef\contacts\Observers;


use drafeef\contacts\Models\ContactUs;

class ContactUsObserver
{


    public function updated(ContactUs $model)
    {
    }

    public function updating(ContactUs $model)
    {
        $model->action_by = request()->action_by;
    }


    public function created(ContactUs $model)
    {

    }


    public function creating(ContactUs $model)
    {
        $model->is_done = False;
    }


    public function deleted(ContactUs $model)
    {
    }


    public function deleting(ContactUs $model)
    {
        $model->action_by = request()->action_by;
    }

    function restored(ContactUs $model)
    {
    }


    public function restoring(ContactUs $model)
    {
    }
}
