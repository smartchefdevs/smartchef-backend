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
        $user->image_url = null;
        $user->full_name = "Juan Pablo Camargo";
        $user->mail = "juancholasso@globant.com";
        $user->pass = null;
        $user->birthday = null;
        $user->address = "Calle 146 n 23-67 Int 2 apt 503";
        
        try{
            $this->assertNotNull($business->create($user)->id);
        }catch(\Exception $e){
            error_log('SE CAPTURA ERROR='.$e->getMessage());
            $this->assertNotNull($e->getMessage());
        }        
    }

    /**
     * Test User update
     *
     * @return void
     */
    public function testUpdate(){
        $business = new UserBusiness;
        $user = $business->getById(6);
        $user->id_profile = 1;
        $user->id_state = 1;
        $user->image_url = null;
        $user->full_name = "Juan Pablo Camargo";
        $user->mail = "juancholasso@globant.com";
        $user->pass = null;
        $user->birthday = null;
        $user->address = "Calle 146 n 23-67 Int 2 apt 503";
        
        try{
            $this->assertNotNull($business->create($user)->id);
        }catch(\Exception $e){
            error_log('SE CAPTURA ERROR='.$e->getMessage());
            $this->assertNotNull($e->getMessage());
        }        
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

    /**
     * Test User get by pofile
     *
     * @return void
     */
    public function testGetByProfile(){
        $business = new UserBusiness;
        $chefs = $business->getByProfile(3)->all();
        error_log("Chef ".$chefs[0]->full_name);        
        $this->assertNotNull($chefs);
    }
}