<?php

include_once "/../../../application/controllers/register_controller.php";


class RegisterControllerTest extends PHPUnit_Framework_TestCase {


    protected $object;


    protected function setUp() {
        $this->object = new RegisterController;
    }


    protected function tearDown() {
        
    }


    public function testaddCompany() {
        $this->assertEquals(
                array("1"), 
                $this->object->addCompany("testName", "testDisplay", "testPassword", "test@test.com", "1212212112", "test", "test 13", "160 33", 39.3854631332584, 22.1632351250000)
        );
    }
    
    public function testaddCompanyEmpty() {
        $this->assertEquals(
                array(-1, -4, -6, -8, -11, -14, -15, 0, -16, -17), 
                $this->object->addCompany("", "", "", "", "", "", "", "", "", "")
        );
    }    
    
    public function testaddCompanyDuplicates() {
        $this->assertEquals(
                array(-3, 0, 0, -10, -13, 0, 0, 0, 0, 0), 
                $this->object->addCompany("carrefour", "carrefour", "1234512345", "carrefour_serres@gmail.com", "2321056230", "Kolasi", "Diavolou 666", "666 66", "66.666", "13.371337")
        );
    }    
}
