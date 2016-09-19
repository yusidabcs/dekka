<?php 

class News extends Eloquent{

	protected $fillable = array('title','url','content','account_id','image','created_at');

	public function categories(){
		return $this->belongsToMany('Category');
	}
}