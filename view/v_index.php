<?php
    require '../config/callxajax.php';
    $getApi = $cl_booking->cl_api();
    function storebook($par_bookid,$par_number,$par_title,$par_price,$par_bookonly){
      global $fn_function;
      $obrespone = new xajaxResponse();
        $setData = array(
          "bookid"=>$par_bookid,
          "num"=>$par_number,
          "title"=>$par_title,
          "price"=>$par_price,
          "book_only"=>$par_bookonly
        );
        unset($_SESSION["boo"][$par_bookid][$par_title]);
        $_SESSION["boo"][$par_bookid][$par_title][] = $setData;
        $lc_html = "<table class='table'>";
          $sumtotaldis = 0;
          $sumGrantotal = 0;
          foreach($_SESSION["boo"] as $k_level1 => $v_level1){
            foreach($v_level1 as $k_level2 => $v_level2){
              $dissumprice = 0;
              if($v_level2[0]['book_only'] == 0){
                $dissumprice = 0;
              }else {
                if($v_level2[0]['num'] != 1){
                  $dissumprice = $fn_function->fn_calldiscount($v_level2[0]['price'],$v_level2[0]['num']);
                }else{
                  $dissumprice = 0;
                }
              }
              $sumtotaldis += $dissumprice;
              $sumGrantotal += ($v_level2[0]['num']*$v_level2[0]['price']);
              $lc_html .= "<tr>";
              $lc_html .= "<td style='width: 63%;'>".$k_level2."</td>";
              $lc_html .= "<td style='text-align: center;'>x".$v_level2[0]['num']."</td>";
              $lc_html .= "<td style='text-align: right;'>".($v_level2[0]['num']*$v_level2[0]['price'])."</td>";
              $lc_html .= "<td><i class='far fa-trash-alt' style='color:red;cursor: pointer;' onclick='removeItem(".$v_level2[0]['bookid'].",&#39;".$v_level2[0]['title']."&#39;);'></i></td>";
              $lc_html .= "</tr>";
            }
          }
            if($sumtotaldis != 0){
              $lc_html .= "<tr>";
              $lc_html .= "<td colspan='2'>Discount</td>";
              $lc_html .= "<td colspan='2' style='text-align: right;'>".number_format($sumtotaldis)."</td>";
              $lc_html .= "</tr>";
            }
<<<<<<< HEAD
            if($sumGrantotal != 0){
              $lc_html .= "<tr>";
              $lc_html .= "<td colspan='2'>Total</td>";
              $lc_html .= "<td colspan='2' style='text-align: right;'>".number_format($sumGrantotal)."</td>";
              $lc_html .= "</tr>";
              $lc_html .= "<tr>";
              $lc_html .= "<td colspan='2'>Grand Total</td>";
              $lc_html .= "<td colspan='2' style='text-align: right;'>".number_format($sumGrantotal-$sumtotaldis)."</td>";
              $lc_html .= "</tr>";
            }
=======
            $lc_html .= "<tr>";
            $lc_html .= "<td colspan='2'>Total</td>";
            $lc_html .= "<td colspan='2' style='text-align: right;'>".number_format($sumGrantotal)."</td>";
            $lc_html .= "</tr>";
            $lc_html .= "<tr>";
            $lc_html .= "<td colspan='2'>Grand Total</td>";
            $lc_html .= "<td colspan='2' style='text-align: right;'>".number_format($sumGrantotal-$sumtotaldis)."</td>";
            $lc_html .= "</tr>";
>>>>>>> 2291cd3c2ef3f4ef5c7874364da4cf4b525da766
            $lc_html .= "</table>";
        $obrespone->assign("tb_shop","innerHTML",$lc_html);
      return $obrespone;
    }
    function removeItembook($par_bookid,$par_title){
      $obrespone = new xajaxResponse();
        unset($_SESSION["boo"][$par_bookid][$par_title]);
        $obrespone->script("window.location.reload();");
      return $obrespone;
    }
    $xajax->printJavascript();
    // unset($_SESSION);
    // session_destroy();
?>
<html>

<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' href='../assets/css/bootstrap.min.css'>
    <link rel='stylesheet' href='../assets/fontawesome/css/all.css'>
    <title>BOOKING</title>
</head>

<body>
    <?php require 'inc_header.php'; ?>
    <div class="container" style="margin-top: 15px;">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">รายชื่อหนังสือ</div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="row">
            <?php for($x=0;$x<count($getApi);++$x){ ?>
            <div class="col-sm-12 col-md-3 col-lg-3" style="margin-bottom: 30px;">
                <div class="card">
                    <img style="height: 220px;" src="<?php echo $getApi[$x]['book_image']; ?>" class="card-img-top" alt="<?php echo $getApi[$x]['book_title']; ?>">
                    <div class="card-body">
                        <div style="text-align: right;font-weight: bold;color:green;"><?php echo $getApi[$x]['book_price']; ?> THB</div>
                        <hr/>
                        <div style="font-size: 13px;"><?php echo $getApi[$x]['book_title']; ?></div>
                        <hr/>
                        <div style='text-align: left;'>
                          <select name='txt_numb[]' id='txt_<?php echo $getApi[$x]['book_id']; ?>'>
                            <?php for($n=1;$n<=7;++$n){ ?>
                              <option value='<?php echo $n; ?>'><?php echo $n; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div style='text-align: right;margin-top: -24px;'>
                          <i class="fas fa-shopping-cart" style="color:green;font-size: 20px;cursor: pointer;" onclick="xajax_storebook('<?php echo $getApi[$x]['book_id']; ?>',txt_<?php echo $getApi[$x]['book_id']; ?>.value,'<?php echo $getApi[$x]['book_title']; ?>','<?php echo $getApi[$x]['book_price']; ?>','<?php echo $getApi[$x]['book_only']; ?>');"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">สรุปรายการ</div>
                </div>
                <div class="row">
                  <div id="tb_shop">
                      <?php
                        if($_SESSION["boo"]){
                          $lc_html = "<table class='table'>";
                          $sumtotaldis = 0;
                          $sumGrantotal = 0;
                          foreach($_SESSION["boo"] as $k_level1 => $v_level1){
                            foreach($v_level1 as $k_level2 => $v_level2){
                              $dissumprice = 0;
                              if($v_level2[0]['book_only'] == 0){
                                $dissumprice = 0;
                              }else {
                                if($v_level2[0]['num'] != 1){
                                  $dissumprice = $fn_function->fn_calldiscount($v_level2[0]['price'],$v_level2[0]['num']);
                                }else{
                                  $dissumprice = 0;
                                }
                              }
                              $sumtotaldis += $dissumprice;
                              $sumGrantotal += ($v_level2[0]['num']*$v_level2[0]['price']);
                              $lc_html .= "<tr>";
                              $lc_html .= "<td style='width: 63%;'>".$k_level2."</td>";
                              $lc_html .= "<td style='text-align: center;'>x".$v_level2[0]['num']."</td>";
                              $lc_html .= "<td style='text-align: right;'>".($v_level2[0]['num']*$v_level2[0]['price'])."</td>";
                              $lc_html .= "<td><i class='far fa-trash-alt' style='color:red;cursor: pointer;' onclick='removeItem(&#39;".$v_level2[0]['bookid']."&#39;,&#39;".$v_level2[0]['title']."&#39;);'></i></td>";
                              $lc_html .= "</tr>";
                            }
                          }
                            if($sumtotaldis != 0){
                              $lc_html .= "<tr>";
                              $lc_html .= "<td colspan='2'>Discount</td>";
                              $lc_html .= "<td colspan='2' style='text-align: right;'>".number_format($sumtotaldis)."</td>";
                              $lc_html .= "</tr>";
                            }
<<<<<<< HEAD
                            if($sumGrantotal != 0){
                                $lc_html .= "<tr>";
                                $lc_html .= "<td colspan='2'>Total</td>";
                                $lc_html .= "<td colspan='2' style='text-align: right;'>".number_format($sumGrantotal)."</td>";
                                $lc_html .= "</tr>";
                                $lc_html .= "<tr>";
                                $lc_html .= "<td colspan='2'>Grand Total</td>";
                                $lc_html .= "<td colspan='2' style='text-align: right;'>".number_format($sumGrantotal-$sumtotaldis)."</td>";
                                $lc_html .= "</tr>";
                            }
=======
                            $lc_html .= "<tr>";
                            $lc_html .= "<td colspan='2'>Total</td>";
                            $lc_html .= "<td colspan='2' style='text-align: right;'>".number_format($sumGrantotal)."</td>";
                            $lc_html .= "</tr>";
                            $lc_html .= "<tr>";
                            $lc_html .= "<td colspan='2'>Grand Total</td>";
                            $lc_html .= "<td colspan='2' style='text-align: right;'>".number_format($sumGrantotal-$sumtotaldis)."</td>";
                            $lc_html .= "</tr>";
>>>>>>> 2291cd3c2ef3f4ef5c7874364da4cf4b525da766
                          $lc_html .= "</table>";
                          echo $lc_html;
                        }else{
                          echo "<div>ไม่พบรายการ</div>";
                        }
                      ?>
                  </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script>
      function removeItem(par_bookid,par_title){
        var r = confirm("คุณต้องการลบรายการนี้!");
        if (r == true) {
          xajax_removeItembook(par_bookid,par_title);
        } else {
        }
      }
    </script>
</footer>

</html>