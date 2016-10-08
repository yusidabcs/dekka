<?php 
namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class NewsMongo extends Eloquent{

	protected $fillable = array('title','url','content','account_id','image','created_at','categories','views');

	protected $collection = 'news';

    protected $dates = array('created_at');


	public function author()
    {
        return $this->belongsTo('App\AccountMongo','author_id');
    }

    public function categories()
    {
        return $this->hasMany('App\CategoryMongo');
    }

    public function bookmarks(){
        return $this->hasMany('App\Bookmark','news_id');
    }



}