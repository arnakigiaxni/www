<?php
include_once "/../../../application/controllers/login_controller.php";
include_once "/../../../application/models/company.php";


class loginControllerTest extends PHPUnit_Framework_TestCase {


    protected $object;


    protected function setUp() {
        $this->object = new loginController;
    }


    protected function tearDown() {
        
    }


    public function testLogin() {
        $this->assertEquals(
                -1,
                $this->object->login("carrefour", "12345")
        );
    }
    

    public function testEmptyLogin() {
        $this->assertEquals(
                -2,
                $this->object->login("", "")
        );
    }
    

    public function testLoginWithOnlyUsername() {
        $this->assertEquals(
                -2,
                $this->object->login("carrefour", "")
        );
    }
    

    public function testLoginWithOnlyPassword() {
        $this->assertEquals(
                -2,
                $this->object->login("", "12345")
        );
    }
    

    public function testLoginInvalid() {
        $this->assertEquals(
                -2,
                $this->object->login("!@#$%^", "!@#$%^")
        );
    }
    
}
