<?php
session_start();
include_once "/../../../application/controllers/add_offer_controller.php";
$_SESSION["id"] = 2;


class AddOfferControllerTest extends PHPUnit_Framework_TestCase {


    protected $object;


    protected function setUp() {
        $this->object = new AddOfferController;
    }


    protected function tearDown() {
        
    }


    public function testAddOffer() {
        $this->assertEquals(
                array("1"), 
                $this->object->addOffer("testName", "testDescr", "1", "2015-4-3", "2015-3-5", "5", "3")
        );
    }
    
    public function testAddOfferInvalidName(){
        $this->assertEquals(
                array("-1", "0", "0", "0", "0", "0"), 
                $this->object->addOffer("@#$%^&*", "testDescr", "1", "2014-12-3", "2014-12-5", "5", "3")
        );
    }
    
    public function testAddOfferNameEmpty(){
        $this->assertEquals(
                array("-2", "0", "0", "0", "0", "0"), 
                $this->object->addOffer("", "testDescr", "1", "2014-12-3", "2014-12-5", "5", "3")
        );
    }
    
    public function testAddOfferInvalidDescr(){
        $this->assertEquals(
                array("0", "-3", "0", "0", "0", "0"), 
                $this->object->addOffer("testName", "$%^&", "1", "2014-12-3", "2014-12-5", "5", "3")
        );
    }
    
    public function testAddOfferStartDateEmpty(){
        $this->assertEquals(
                array("0", "0", "-4", "0", "0", "0"), 
                $this->object->addOffer("testName", "testDescr", "1", "", "2014-12-5", "5", "3")
        );
    }
    
    public function testAddOfferEndDateEmpty(){
        $this->assertEquals(
                array("0", "0", "0", "-5", "0", "0"), 
                $this->object->addOffer("testName", "testDescr", "1", "2014-12-5", "", "5", "3")
        );
    }
    
    public function testAddOfferInvalidDiscount(){
        $this->assertEquals(
                array("0", "0", "0", "0", "-6", "0"), 
                $this->object->addOffer("testName", "testDescr", "1", "2014-12-3", "2014-12-5", "invalid", "3")
        );
    }
    
    public function testAddOfferDiscountOver100(){
        $this->assertEquals(
                array("0", "0", "0", "0", "-7", "0"), 
                $this->object->addOffer("testName", "testDescr", "1", "2014-12-3", "2014-12-5", "300", "3")
        );
    }
    
    public function testAddOfferDiscountEmpty(){
        $this->assertEquals(
                array("0", "0", "0", "0", "-8", "0"), 
                $this->object->addOffer("testName", "testDescr", "1", "2014-12-3", "2014-12-5", "", "3")
        );
    }
    
    public function testAddOfferInvalidPrice(){
        $this->assertEquals(
                array("0", "0", "0", "0", "0", "-9"), 
                $this->object->addOffer("testName", "testDescr", "1", "2014-12-3", "2014-12-5", "5", "invalid")
        );
    }
    
    public function testAddOfferPriceEmpty(){
        $this->assertEquals(
                array("0", "0", "0", "0", "0", "-10"), 
                $this->object->addOffer("testName", "testDescr", "1", "2014-12-3", "2014-12-5", "5", "")
        );
    }
    
    public function testAddOfferInvalidFields(){
        $this->assertEquals(
                array("-2", "0", "0", "0", "-6", "0"), 
                $this->object->addOffer("", "testDescr", "1", "2014-12-3", "2014-12-5", "invalid", "3")
        );
    }

    public function testValidateOfferName() {
        $this->assertEquals(
                0,
                $this->object->validateOfferName("testName")
        );
    }
    

    public function testValidateOfferNameInvalid() {
        $this->assertEquals(
                -1,
                $this->object->validateOfferName("!@#$%^")
        );
    }
    

    public function testValidateOfferNameEmpty() {
        $this->assertEquals(
                -2,
                $this->object->validateOfferName("")
        );
    }


    public function testValidateOfferDescr() {
        $this->assertEquals(
                0,
                $this->object->validateOfferDescr("testDescr")
        );
    }
    

    public function testValidateOfferDescrInvalid() {
        $this->assertEquals(
                -3,
                $this->object->validateOfferDescr("!#$%^&*")
        );
    }


    public function testValidateStartDate() {
        $this->assertEquals(
                0,
                $this->object->validateStartDate("2014-12-3")
        );
    }
    

    public function testValidateStartDateEmpty() {
        $this->assertEquals(
                -4,
                $this->object->validateStartDate("")
        );
    }


    public function testValidateEndDate() {
        $this->assertEquals(
                0,
                $this->object->validateEndDate("2014-12-5")
        );
    }
    

    public function testValidateEndDateEmpty() {
        $this->assertEquals(
                -5,
                $this->object->validateEndDate("")
        );
    }


    public function testValidateDiscount() {
        $this->assertEquals(
                0,
                $this->object->validateDiscount("5")
        );
    }
    

    public function testValidateDiscountInvalid() {
        $this->assertEquals(
                -6,
                $this->object->validateDiscount("something")
        );
    }
    

    public function testValidateDiscountMoreThan100() {
        $this->assertEquals(
                -7,
                $this->object->validateDiscount("105")
        );
    }
    

    public function testValidateDiscountLessThan0() {
        $this->assertEquals(
                -6,
                $this->object->validateDiscount("-10")
        );
    }
    

    public function testValidateDiscountEmpty() {
        $this->assertEquals(
                -8,
                $this->object->validateDiscount("")
        );
    }


    public function testValidatePrice() {
        $this->assertEquals(
                0,
                $this->object->validatePrice("3")
        );
    }
    

    public function testValidatePriceInvalid() {
        $this->assertEquals(
                -9,
                $this->object->validatePrice("something")
        );
    }
    

    public function testValidatePriceLessThan0() {
        $this->assertEquals(
                -9,
                $this->object->validatePrice("-10")
        );
    }
    

    public function testValidatePriceEmpty() {
        $this->assertEquals(
                -10,
                $this->object->validatePrice("")
        );
        mysql_query("DELETE FROM offer ORDER BY id DESC LIMIT 1");
    }

}
