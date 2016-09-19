<?php 

class Category extends Eloquent{
		
	public $timestamps = false;

	protected $fillable = array('name');

	public function news(){
		return $this->belongsToMany('News');
	}
}