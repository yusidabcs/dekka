<?php
namespace App\Http\Controllers\Apiv1;
use App\Http\Controllers\Controller;
use App\DeviceMongo;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
	public function store(Request $request){
		$registration_ids = $request->get('registration_ids');
		$device = new DeviceMongo;
		$device->registration_ids = $registration_ids;
		$device->save();
		return $device;
	}

}