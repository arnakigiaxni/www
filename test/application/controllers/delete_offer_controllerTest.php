<?php
include_once "/../../../application/controllers/delete_offer_controller.php";

class DeleteOfferControllerTest extends PHPUnit_Framework_TestCase {


    protected $object;


    protected function setUp() {
        $this->object = new DeleteOfferController;
    }


    protected function tearDown() {
        
    }


    public function testDeleteOffer() {
        mysql_query(
                    "INSERT INTO
                        offer
                    SET
                        id = '-1',
                        comp_id = '1',
                        cat_id = '1',
                        offer_name = 'T-Shirts',
                        offer_descr = '20% fthinotera',
                        start_date = '2014-12-01',
                        end_date = '2014-05-01',
                        discount = '20',
                        price = '15'"
            ); 
        $this->assertEquals(
                "T-Shirts", 
                $this->object->DeleteOffer(-1)
        );
    }
        

    public function testDeleteOfferInvaild() {
        $this->assertEquals(
                false, 
                $this->object->DeleteOffer(-5)
        );
    }
}
