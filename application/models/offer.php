<?php
        
        function AddOffer($offer_name, $offer_descr, $cat_id, $start_date, 
                $end_date, $discount, $price, $userId){
            $query = mysql_query(
                    "INSERT INTO
                        offer
                    SET
                        comp_id = '$userId',
                        cat_id = '$cat_id',
                        offer_name = '$offer_name',
                        offer_descr = '$offer_descr',
                        start_date = '$start_date',
                        end_date = '$end_date',
                        discount = '$discount',
                        price = '$price'"
            );
            if (mysql_affected_rows()==1){
                return $query;
            }
            else{
                return false;
            }
        }
        
    

