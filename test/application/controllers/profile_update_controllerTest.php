<?php

include_once "/../../../application/controllers/profile_update_controller.php";
session_start();
$_SESSION["id"] = 9;

class ProfileUpdateControllerTest extends PHPUnit_Framework_TestCase {

    protected $object;

    protected function setUp() {
        $this->object = new ProfileUpdateController;
    }


    protected function tearDown() {
        
    }


    public function testProfileUpdateNoChanges() {
        $this->assertEquals(
                array("1"), 
                $this->object->profileUpdate("testName", "testDisplay", "testPassword", "test@test.com", "1212212112", "test", "test 13", "160 33", "39.3854631332584", "22.1632351250000")
        );
    }
    

    public function testProfileUpdateWithChanges() {
        $this->assertEquals(
                array("1"), 
                $this->object->profileUpdate("testName123", "testDisplay123", "testPassword123", "test123@test.com", "1212212112", "test", "test 13", "160 33", "39.3854631332584", "22.1632351250000")
        );
    }
    

    public function testProfileUpdateEmpty() {
        $this->assertEquals(
                array(-2, -4, -6, -9, -12, -14, -15, -16, -17, -18), 
                $this->object->profileUpdate("", "", "", "", "", "", "", "", "", "")
        );
    }
    

    public function testProfileUpdateInvalidInput() {
        $this->assertEquals(
                array(-3, -5, -7, -10, -13, 0, 0, 0, 0, 0), 
                $this->object->profileUpdate("#$%#^&^%&", "#$%#^&^%&", "#$%#^&^%&", "#$%#^&^%&", "#$%#^&^%&", "test", "test 13", "160 33", "39.3854631332584", "22.1632351250000")
        );
    }
    
    public function testProfileUpdateInvalidCompName() {
        $this->assertEquals(
                array(-3, 0, 0, 0, 0, 0, 0, 0, 0, 0), 
                $this->object->profileUpdate("@#$%^&*", "testDisplay", "testPassword", "test@test.com", "1212212112", "test", "test 13", "160 33", "39.3854631332584", "22.1632351250000")
        );
    }
    
    public function testProfileUpdateInvalidDisplayName() {
        $this->assertEquals(
                array(0, -5, 0, 0, 0, 0, 0, 0, 0, 0), 
                $this->object->profileUpdate("testName", "!@#$%^&*", "testPassword", "test@test.com", "1212212112", "test", "test 13", "160 33", "39.3854631332584", "22.1632351250000")
        );
    }
    
    public function testProfileUpdateInvalidPassword() {
        $this->assertEquals(
                array(0, 0, -7, 0, 0, 0, 0, 0, 0, 0), 
                $this->object->profileUpdate("testName", "testDisplay", "@#$%", "test@test.com", "1212212112", "test", "test 13", "160 33", "39.3854631332584", "22.1632351250000")
        );
    }
    
    public function testProfileUpdateInvalidEmail() {
        $this->assertEquals(
                array(0, 0, 0, -10, 0, 0, 0, 0, 0, 0), 
                $this->object->profileUpdate("testName", "testDisplay", "testPassword", "whatever", "1212212112", "test", "test 13", "160 33", "39.3854631332584", "22.1632351250000")
        );
    }
    
    public function testProfileUpdateInvalidPhone() {
        $this->assertEquals(
                array(0, 0, 0, 0, -13, 0, 0, 0, 0, 0), 
                $this->object->profileUpdate("testName", "testDisplay", "testPassword", "test@test.com", "whatever", "test", "test 13", "160 33", "39.3854631332584", "22.1632351250000")
        );
    }
    

    public function testProfileUpdateAlreadyExists() {
        $this->assertEquals(
                array(-1, 0, 0, -8, -11, 0, 0, 0, 0, 0), 
                $this->object->profileUpdate("carrefour", "testDisplay", "testPassword", "carrefour_serres@gmail.com", "2321056230", "test", "test 13", "160 33", "39.3854631332584", "22.1632351250000")
        );
    }
    

    public function testCompName() {
        $this->assertEquals(
                0, 
                $this->object->CompName("testName")
        );
    }
    
    public function testCompNameExists() {
        $this->assertEquals(
                -1,
                $this->object->compName("carrefour")
        );
    }
    

    public function testCompNameEmpty() {
        $this->assertEquals(
                -2,
                $this->object->compName("")
        );
    }
    
    public function testCompNameInvalid(){
        $this->assertEquals(
                -3,
                $this->object->compName("@#$%^")
        );
    }
    

    public function testDisplayName() {
        $this->assertEquals(
                0, 
                $this->object->DisplayName("testName")
        );
    }
    
    public function testDisplayNameEmpty(){
        $this->assertEquals(
                -4,
                $this->object->displayName("")
        );
    }
    
    public function testDisplayNameInvalid(){
        $this->assertEquals(
                -5,
                $this->object->displayName("@#$%^")
        );
    }


    public function testPassword() {
        $this->assertEquals(
                0, 
                $this->object->password("123456789")
        );
    }
    
    public function testPasswordEmpty() {
        $this->assertEquals(
                -6, 
                $this->object->password("")
        );
    }
    
    public function testPasswordInvalid(){
        $this->assertEquals(
                -7,
                $this->object->password("@#$%^&")
        );
    }


    public function testEmail() {
        $this->assertEquals(
                0, 
                $this->object->email("testEmail@gmail.com")
        );
    }
    
    public function testEmailExists() {
        $this->assertEquals(
                -8,
                $this->object->email("carrefour_serres@gmail.com")
        );
    }
    
    public function testEmailEmpty() {
        $this->assertEquals(
                -9, 
                $this->object->email("")
        );
    }
    
    public function testEmailInvalid() {
        $this->assertEquals(
                -10, 
                $this->object->email("whatever")
        );
    }


    public function testPhone() {
        $this->assertEquals(
                0, 
                $this->object->phone("2310790790")
        );
    }
    
    public function testPhoneExists() {
        $this->assertEquals(
                -11,
                $this->object->phone("2321056230")
        );
    }
    
    public function testPhoneEmpty() {
        $this->assertEquals(
                -12, 
                $this->object->phone("")
        );
    }
    
    public function testPhoneInvalid() {
        $this->assertEquals(
                -13, 
                $this->object->phone("whatever")
        );
    }
    
    public function testPhoneLessThan10() {
        $this->assertEquals(
                -13, 
                $this->object->phone("2345")
        );
    }


    public function testCity() {
        $this->assertEquals(
                0, 
                $this->object->city("thessaloniki")
        );
    }
    
    public function testCityEmpty() {
        $this->assertEquals(
                -14, 
                $this->object->city("")
        );
    }


    public function testAddress() {
        $this->assertEquals(
                0, 
                $this->object->address("emporiou 10")
        );
    }
    
    public function testAddressEmpty() {
        $this->assertEquals(
                -15, 
                $this->object->address("")
        );
    }


    public function testPostalCode() {
        $this->assertEquals(
                0, 
                $this->object->postalCode("57100")
        );
    }
    
    public function testPostalCodeEmpty() {
        $this->assertEquals(
                -16, 
                $this->object->postalCode("")
        );
    }


    public function testLatitude() {
        $this->assertEquals(
                0, 
                $this->object->latitude("40.401000")
        );
    }
    
    public function testLatitudeEmpty() {
        $this->assertEquals(
                -17, 
                $this->object->latitude("")
        );
    }


    public function testLongitude() {
        $this->assertEquals(
                0, 
                $this->object->longitude("40.401000")
        );
    }
    
    public function testLongitudeEmpty() {
        $this->assertEquals(
                -18, 
                $this->object->longitude("")
        );
    }

}
