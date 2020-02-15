<?php
    Class fn_function{
        function fn_calldiscount($par_price,$par_num){
                switch($par_num){
                    case '2':
                        //10%
                        $sumdiscount = ( ($par_price*$par_num)*0.10 );
                    break;
                    case '3':
                        //11%
                        $sumdiscount = ( ($par_price*$par_num)*0.11 );
                    break;
                    case '4':
                        //12%
                        $sumdiscount = ( ($par_price*$par_num)*0.12 );
                    break;
                    case '5':
                        //13%
                        $sumdiscount = ( ($par_price*$par_num)*0.13 );
                    break;
                    case '6':
                        //14%
                        $sumdiscount = ( ($par_price*$par_num)*0.14 );
                    break;
                    case '7':
                        //15%
                        $sumdiscount = ( ($par_price*$par_num)*0.15 );
                    break;
                    default:
                        // 15%
                        $sumdiscount = ( ($par_price*$par_num)*0.15 );
                }
            return $sumdiscount;
        }
    }
?>