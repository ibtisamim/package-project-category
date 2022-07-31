<?php

namespace drafeef\categories\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use drafeef\categories\Observers\LevelObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property bigint $id
 * @property string $title
 * @property string $model_type
 * @property int $sort
 * @property int $status
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class Level extends BaseModel
{
    use HasFactory  , HasTranslations , SoftDeletes ;

    public static function boot()
    {
        parent::boot();

        self::observe(LevelObserver::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
      'title' ,
      'model_type' ,
      'sort' ,
      'status' ,
    ];

    protected $table = 'levels';

    /**
     * The attributes that are must translatable.
     *
     * @var array<int, string>
     */
    public $translatable = ['title'];

    protected $guard_name = 'api';


}
