<?php

namespace drafeef\base\Models;

use Spatie\Translatable\HasTranslations;
use drafeef\base\Observers\LanguageObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $direction
 * @property string $sort
 * @property string $status
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class Language extends BaseModel
{
    use HasFactory  , HasTranslations , SoftDeletes ;

    public static function boot()
    {
        parent::boot();

        self::observe(LanguageObserver::class);
    }

    protected $fillable = [
        'name' ,
        'code' ,
        'direction' ,
        'sort' ,
        'status' ,
    ];

    public $translatable = ['name'];

    protected $table = 'languages';
}
