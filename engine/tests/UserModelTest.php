<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserModelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanCreated()
    {
        $user = factory(App\UserMongo::create([
        	'first_name' => 'agus',
        	'last_name' => 'yusida',
        	'email' => 'agusyusida@gmail.com',
        	]));
    	$this->seeInDatabase('users',[
    		'first_name' => 'agus',
        	'last_name' => 'yusida',
        	'email' => 'agusyusida@gmail.com',
    		]);
    }
}
