<?php

namespace drafeef\contacts\Models;

use drafeef\users\Models\User;
use drafeef\contacts\Observers\ContactUsObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property int $user_id
 * @property int $action_by
 * @property string $result_description
 * @property boolean $is_done
 */

class ContactUs extends BaseModel
{
    use HasFactory   , SoftDeletes ;

    public static function boot()
    {
        parent::boot();

        self::observe(ContactUsObserver::class);
    }

    protected $fillable = [
          'name' ,
          'email' ,
          'phone' ,
          'message' ,
          'user_id' ,
          'action_by' ,
          'is_done',
          'result_description'
    ];

    protected $table = 'contact_us';
    /*
        Belong to relation.
    */

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function actionby(){
        return $this->belongsTo(User::class,'action_by');
    }
}
