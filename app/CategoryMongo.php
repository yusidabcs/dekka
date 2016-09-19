<?php 
namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CategoryMongo extends Eloquent{
		
	public $timestamps = false;
	protected $collection = 'categories';
	protected $fillable = array('name');
	protected $hidden = array('news_mongo_id');

	public function news(){
		return $this->belongsTo('App\NewsMongo','news_mongo_id');
	}

}