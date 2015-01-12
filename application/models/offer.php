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
                return true;
            } else{
                return false;
            }
        }
        
        function GetOffers ($userId)
        {
            $query = mysql_query(
                    "SELECT
                        *
                    FROM
                        offer
                    WHERE
                        comp_id = '$userId'    
                    ORDER BY 
                        id
                    DESC 
                        limit 5;"                    
            );

            if (mysql_num_rows($query) > 0 ) {
                return $query;
            }
            else {
                return false;
            }
        }
        
        function ShowOffers($userId) {
            $return = mysql_query(
                    "SELECT
                        *
                    FROM
                        offer
                    WHERE
                        comp_id = '$userId'"                
            );
            while ($offers = mysql_fetch_array($return) ) {
                            echo '<option value="' . $offers['id'] . '">' . $offers[ 'offer_name' ] . '</option>';
            }
        }
        
        function deleteOffer($offer_id) {
            mysql_query(
                "DELETE
                FROM
                    offer 
                WHERE 
                    id = $offer_id"                    
            );
            if (mysql_affected_rows()>0){
                return true;
            } 
            else {
                return false;
            }
        }
        
        function GetOfferById ($offer_id)
        {
            $query = mysql_query(
                    "SELECT
                        *
                    FROM
                        offer
                    WHERE 
                        id='$offer_id'"         
            );
            if (mysql_num_rows($query) > 0 ) {
                return $query;
            }
            else {
                return false;
            }
        }
