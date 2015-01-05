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

    public function testOfferName() {
        $this->assertEquals(
                0,
                $this->object->offerName("testName")
        );
    }
    

    public function testOfferNameInvalid() {
        $this->assertEquals(
                -1,
                $this->object->offerName("!@#$%^")
        );
    }
    

    public function testOfferNameEmpty() {
        $this->assertEquals(
                -2,
                $this->object->offerName("")
        );
    }


    public function testOfferDescr() {
        $this->assertEquals(
                0,
                $this->object->offerDescr("testDescr")
        );
    }
    

    public function testOfferDescrInvalid() {
        $this->assertEquals(
                -3,
                $this->object->offerDescr("!#$%^&*")
        );
    }


    public function testStartDate() {
        $this->assertEquals(
                0,
                $this->object->startDate("2014-12-3")
        );
    }
    

    public function testStartDateEmpty() {
        $this->assertEquals(
                -4,
                $this->object->startDate("")
        );
    }


    public function testEndDate() {
        $this->assertEquals(
                0,
                $this->object->endDate("2014-12-5")
        );
    }
    

    public function testEndDateEmpty() {
        $this->assertEquals(
                -5,
                $this->object->endDate("")
        );
    }


    public function testDiscount() {
        $this->assertEquals(
                0,
                $this->object->discount("5")
        );
    }
    

    public function testDiscountInvalid() {
        $this->assertEquals(
                -6,
                $this->object->discount("something")
        );
    }
    

    public function testDiscountMoreThan100() {
        $this->assertEquals(
                -7,
                $this->object->discount("105")
        );
    }
    

    public function testDiscountLessThan0() {
        $this->assertEquals(
                -6,
                $this->object->discount("-10")
        );
    }
    

    public function testDiscountEmpty() {
        $this->assertEquals(
                -8,
                $this->object->discount("")
        );
    }


    public function testPrice() {
        $this->assertEquals(
                0,
                $this->object->price("3")
        );
    }
    

    public function testPriceInvalid() {
        $this->assertEquals(
                -9,
                $this->object->price("something")
        );
    }
    

    public function testPriceLessThan0() {
        $this->assertEquals(
                -9,
                $this->object->price("-10")
        );
    }
    

    public function testPriceEmpty() {
        $this->assertEquals(
                -10,
                $this->object->price("")
        );
    }

}
