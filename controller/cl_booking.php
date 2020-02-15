<?php
    Class cl_booking{
        function cl_api(){
            global $ml_booking;
                $getData = $ml_booking->ml_api();
                $arr = array("9781408855652","9781408855669","9781408855676", "9781408855683", "9781408855690", "9781408855706", "9781408855713");
                for($x=0;$x<count($getData['books']);++$x){
                    if(in_array($getData['books'][$x]['id'], $arr)){
                        $onlydis = "1";
                    }else{
                        $onlydis = "0";
                    }
                    $ren[] = array(
                        "book_id"=>$getData['books'][$x]['id'],
                        "book_image"=>$getData['books'][$x]['cover'],
                        "book_price"=>$getData['books'][$x]['price'],
                        "book_title"=>str_replace("'", '', $getData['books'][$x]['title']),
                        "book_only"=>$onlydis
                    );
                }
            return $ren;
        }
    }
?>