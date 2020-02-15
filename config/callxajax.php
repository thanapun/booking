<?php
    require '../xajax/xajax_core/xajax.inc.php';
    require '../controller/fn_function.php';
    require '../model/ml_booking.php';
    require '../controller/cl_booking.php';

    //Object
    $xajax = new xajax();
    $fn_function = new fn_function();
    $ml_booking = new ml_booking();
    $cl_booking = new cl_booking();
    // Xajax
    $xajax->configure('javascript URI', '../xajax/');
    $xajax->register(XAJAX_FUNCTION,"storebook");
    $xajax->processRequest();
?>