<?php

namespace drafeef\categories\Models;

use drafeef\users\Models\User;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use drafeef\categories\Observers\ArticleObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $brief
 * @property string $description
 * @property string $slug
 * @property int $views_count
 * @property int $sort
 * @property int $status
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */
 
class Article extends BaseModel
{
    use HasFactory  , HasTranslations , SoftDeletes ;
    
    public static function boot()
    {
        parent::boot();

        self::observe(ArticleObserver::class);
    }
	
    protected $fillable = [
          'title' ,
          'image' ,
          'brief' ,
          'description' ,
          'slug' ,
		  'views_count' ,
          'status' ,
          'sort' ,
    ];
	
	protected $table = 'articles';
	
	public $translatable = [
		'title' , 
		'description' , 
		'brief' ,
		'slug' ,
	];


    /*
        Belong to many relation.
    */

    public function userlikes(){
        return $this->belongsToMany(User::class,'user_articles','article_id' ,'user_id');
    }

}
