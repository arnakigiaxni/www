<?php

include_once "/../../../application/controllers/register_controller.php";


class RegisterControllerTest extends PHPUnit_Framework_TestCase {


    protected $object;


    protected function setUp() {
        $this->object = new RegisterController;
    }


    protected function tearDown() {
    }


    public function testAddCompany() {
        $this->assertEquals(
                array("1"), 
                $this->object->addCompany("testName", "testDisplay", "testPassword", "test@test.com", "1212212112", "test", "test 13", "160 33", "39.3854631332584", "22.1632351250000")
        );
    }
    
    public function testAddCompanyAllEmpty() {
        $this->assertEquals(
                array(-1, -4, -6, -8, -11, -14, -15, 0, -16, -17), 
                $this->object->addCompany("", "", "", "", "", "", "", "", "", "")
        );
    }    
    
    public function testAddCompanyDuplicates() {
        $this->assertEquals(
                array(-3, 0, 0, -10, -13, 0, 0, 0, 0, 0), 
                $this->object->addCompany("carrefour", "carrefour", "1234512345", "carrefour_serres@gmail.com", "2321056230", "Kolasi", "Kato kosmou 666", "666 66", "66.666", "13.371337")
        );
    }   
    
    public function testAddCompanyPostalCodeEmpty() {
        $this->assertEquals(
                array("1"), 
                $this->object->addCompany("galopoula", "galopoulos", "glouglou", "galo@poula.gr", "1212122112", "kotetsi", "proto dentro deksia", "", "23.32234234234", "43.3423423234")
        );
    }     
    
    public function testAddCompanyInvalidInputs() {
        $this->assertEquals(
                array(-2, -5, -7, -9, -12, 0, 0, 0, 0, 0), 
                $this->object->addCompany("%^$%$%&%", "^^^^^^", "*&*&*&*&", "alampournezika", "ki_edo", "Kolasi", "Kato kosmou 666", "666 66", "66.666", "13.371337")
        );       
    }     
    
    public function testAddCompanyUnderscore() {
        $this->assertEquals(
                array("1"), 
                $this->object->addCompany("carre_four", "carrefour", "1_2_3_4_5", "carre_four_serres@gmail.com", "2321156230", "Kolasi", "Kato kosmou 666", "666 66", "66.666", "13.371337")
        );
    }    
    
    public function testAddCompanyGreekCharacters() {
        $this->assertEquals(
                array("1"), 
                $this->object->addCompany("Χαράλαμπος", "Ο Μπάμπης", "μπουμπούκος1821", "mpampis@hotmail.com", "2105567213", "Καλαμάτα", "Κολοκοτρώνη 40", "431 20", "65.234234324", "23.2343242")
        );
    }     
    
    public function testAddCompanyAllMitsos() {
        $this->assertEquals(
                array(-2, 0, -7, -9, -12, 0, 0, 0, 0, 0), 
                $this->object->addCompany("mitsos", "mitsos", "mitsos", "mitsos", "mitsos", "mitsos", "mitsos", "mitsos", "mitsos", "mitsos")
        );
        mysql_query("DELETE FROM company ORDER BY id DESC LIMIT 4");
    }     
    
}
