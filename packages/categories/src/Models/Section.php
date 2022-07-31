<?php

namespace drafeef\categories\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use drafeef\categories\Observers\SectionObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $title
 * @property string $icon
 * @property string $link
 * @property int    $section_path
 * @property string $description
 * @property string $slug
 * @property int $sort
 * @property int $status
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */
 
class Section extends BaseModel
{
    use HasFactory  , HasTranslations , SoftDeletes ;
    
    public static function boot()
    {
        parent::boot();

        self::observe(SectionObserver::class);
    }
	
    protected $fillable = [
      'title' ,
      'slug' ,
      'description' ,
      'icon'  ,
      'link' ,
      'section_path',
      'sort' ,
      'status' ,
    ];
	
	protected $table = 'sections';
	
	public $translatable = [
		'title' , 
		'slug' , 
		'description' 
	];

}
