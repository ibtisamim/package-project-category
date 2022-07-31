<?php

namespace drafeef\base\Models;


use Spatie\Translatable\HasTranslations;
use drafeef\base\Observers\LabelObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $label
 * @property string $background_color
 * @property string $text_color
 * @property string $status
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class Label extends BaseModel
{
    use HasFactory  , HasTranslations , SoftDeletes ;

    public static function boot()
    {
        parent::boot();

        self::observe(LabelObserver::class);
    }

    protected $fillable = [
      'label' ,
      'background_color' ,
      'text_color' ,
      'status' ,
    ];

    protected $table = 'labels';
    public $translatable = ['label'];

   /* public function ebook(){
        return $this->hasMany(Ebook::class);
    }

    public function course(){
        return $this->hasMany(Course::class);
    }

    public function package(){
        return $this->hasMany(Package::class);
    }*/

}
