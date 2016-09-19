<?php 
namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AccountMongo extends Eloquent{
		
	public $timestamps = false;
	protected $collection = 'accounts';
	protected $fillable = array('name','feed_url','feed_type','logo');

	public function news(){
		return $this->hasMany('App\NewsMongo','author_id');
	}

	public function latestNews(){
		return $this->hasOne('App\NewsMongo','author_id')->orderBy('created_at','desc');
	}
}