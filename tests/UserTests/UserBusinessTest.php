<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Business\UserBusiness;
use App\User;

class UserBusinessTest extends TestCase
{
    /**
     * Test User creation
     *
     * @return void
     */
    public function testCreate(){
        $business = new UserBusiness;
        $user = new User;
        $user->id_profile = 1;
        $user->id_state = 1;
        $user->image_url = "def.png";
        $user->full_name = "Paula Andrea Rueda Gaitán";
        $user->mail = "prueda@globant.com";
        $user->pass = "123456";
        $user->birthday = "2000-02-13";
        $user->address = "Calle 170 n 23-67 Int 2 apt 503";

        $this->assertNotNull($business->create($user)->id);
    }

    /**
     * Test User get by mail
     *
     * @return void
     */
    public function testGetByMail(){
        $business = new UserBusiness;

        $this->assertNotNull($business->getByMail("prueda@globant.com"));
        $this->assertNull($business->getByMail("prueda@globant.co"));
    }
}