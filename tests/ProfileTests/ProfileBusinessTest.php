<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Profile;
use App\Business\ProfileBusiness;

class ProfileBusinessTest extends TestCase
{
    /**
     * Test profile creation.
     *
     * @return void
     */
    public function testCreate()
    {
        $name="TestProfile";
        
        $profileExpected = new Profile;
        $profileExpected->id=4;
        $profileExpected->name=$name;

        $business = new ProfileBusiness;

        $this->assertEquals($profileExpected->name, $business->create($name)->name);
        $this->assertNotNull($business->create($name)->id);

    }
}