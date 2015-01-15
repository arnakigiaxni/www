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
    

    public function testValidateCompName() {
        $this->assertEquals(
                0, 
                $this->object->validateCompName("testName")
        );
    }
    
    public function testValidateCompNameExists() {
        $this->assertEquals(
                -1,
                $this->object->validateCompName("carrefour")
        );
    }
    

    public function testValidateCompNameEmpty() {
        $this->assertEquals(
                -2,
                $this->object->validateCompName("")
        );
    }
    
    public function testValidateCompNameInvalid(){
        $this->assertEquals(
                -3,
                $this->object->validateCompName("@#$%^")
        );
    }
    

    public function testValidateDisplayName() {
        $this->assertEquals(
                0, 
                $this->object->validateDisplayName("testName")
        );
    }
    
    public function testValidateDisplayNameEmpty(){
        $this->assertEquals(
                -4,
                $this->object->validateDisplayName("")
        );
    }
    
    public function testValidateDisplayNameInvalid(){
        $this->assertEquals(
                -5,
                $this->object->validateDisplayName("@#$%^")
        );
    }


    public function testValidatePassword() {
        $this->assertEquals(
                0, 
                $this->object->validatePassword("123456789")
        );
    }
    
    public function testValidatePasswordEmpty() {
        $this->assertEquals(
                -6, 
                $this->object->validatePassword("")
        );
    }
    
    public function testValidatePasswordInvalid(){
        $this->assertEquals(
                -7,
                $this->object->validatePassword("@#$%^&")
        );
    }


    public function testValidateEmail() {
        $this->assertEquals(
                0, 
                $this->object->validateEmail("testEmail@gmail.com")
        );
    }
    
    public function testValidateEmailExists() {
        $this->assertEquals(
                -8,
                $this->object->validateEmail("carrefour_serres@gmail.com")
        );
    }
    
    public function testValidateEmailEmpty() {
        $this->assertEquals(
                -9, 
                $this->object->validateEmail("")
        );
    }
    
    public function testValidateEmailInvalid() {
        $this->assertEquals(
                -10, 
                $this->object->validateEmail("whatever")
        );
    }


    public function testValidatePhone() {
        $this->assertEquals(
                0, 
                $this->object->validatePhone("2310790790")
        );
    }
    
    public function testValidatePhoneExists() {
        $this->assertEquals(
                -11,
                $this->object->validatePhone("2321056230")
        );
    }
    
    public function testValidatePhoneEmpty() {
        $this->assertEquals(
                -12, 
                $this->object->validatePhone("")
        );
    }
    
    public function testValidatePhoneInvalid() {
        $this->assertEquals(
                -13, 
                $this->object->validatePhone("whatever")
        );
    }
    
    public function testValidatePhoneLessThan10() {
        $this->assertEquals(
                -13, 
                $this->object->validatePhone("2345")
        );
    }


    public function testValidateCity() {
        $this->assertEquals(
                0, 
                $this->object->validateCity("thessaloniki")
        );
    }
    
    public function testValidateCityEmpty() {
        $this->assertEquals(
                -14, 
                $this->object->validateCity("")
        );
    }


    public function testValidateAddress() {
        $this->assertEquals(
                0, 
                $this->object->validateAddress("emporiou 10")
        );
    }
    
    public function testValidateAddressEmpty() {
        $this->assertEquals(
                -15, 
                $this->object->validateAddress("")
        );
    }


    public function testValidatePostalCode() {
        $this->assertEquals(
                0, 
                $this->object->validatePostalCode("57100")
        );
    }
    
    public function testValidatePostalCodeEmpty() {
        $this->assertEquals(
                -16, 
                $this->object->validatePostalCode("")
        );
    }


    public function testValidateLatitude() {
        $this->assertEquals(
                0, 
                $this->object->validateLatitude("40.401000")
        );
    }
    
    public function testValidateLatitudeEmpty() {
        $this->assertEquals(
                -17, 
                $this->object->validateLatitude("")
        );
    }


    public function testValidateLongitude() {
        $this->assertEquals(
                0, 
                $this->object->validateLongitude("40.401000")
        );
    }
    
    public function testValidateLongitudeEmpty() {
        $this->assertEquals(
                -18, 
                $this->object->validateLongitude("")
        );
    }

}
