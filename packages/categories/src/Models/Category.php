<?php

namespace drafeef\categories\Models;

use drafeef\categories\Models\Level;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use drafeef\categories\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $icon
 * @property int $parent_id
 * @property int $sort
 * @property int $status
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class Category extends BaseModel
{
    use HasFactory , HasTranslations , SoftDeletes ;

    public static function boot()
    {
        parent::boot();

        self::observe(CategoryObserver::class);
    }

    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'parent_id',
        'sort',
        'status',
    ];

    protected $table = 'categories';

    public $translatable = [
        'title' ,
        'slug',
        'description'
        ];

    /*
        Belong to relation.
    */
        
    public function parent(){
        return $this->belongsTo(self::class, "parent_id");
    }

    /*
        Has many relation.
    */
    public function childrens(){
        return $this->hasMany(self::class, "parent_id");
    }


    public function parentsTree()
    {
        return $this->parent()->with('parentsTree');
    }

    public function getLevelNumber()
    {
        return Level::where('status','1')->where('model_type','Category')->count();
    }





}
