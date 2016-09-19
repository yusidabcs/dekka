<?php 
namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DeviceMongo extends Eloquent{
		
	public $timestamps = false;
	protected $collection = 'devices';
	protected $fillable = array('registration_token');

}