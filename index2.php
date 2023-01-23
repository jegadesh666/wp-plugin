<?php
header("Refresh:15; url=index3.php");
session_start();
//echo $_SESSION['id'];
//$_SESSION['msg'];







include "dbconnection.php";
// include "checklogin.php";
$workno1 = 'MP-WC-04000';
$workno2 = 'MP-WC-05700';
$time=date("H:i");
// echo $time;
// $sql = "select * from " . '[Micropack New$Plan Actual Production Data]' . "
// where [WC No] = '$workno'";
if($time <"14:00"){
$shift_no='1';
}
elseif($time <"22:00"){
    $shift_no='2';
}
else{

    $shift_no='3';

}



$sql = "select
[timestamp],cast(cast([Shift Start Time] as date)as varchar)[Date],[Shift No_],[PR SNO],[Shift Code],cast(cast([Shift Start Time] as date)as varchar)[Shift Start Time],cast(cast([Shift End Time] as date)as varchar)[Shift End Time],[WC No],[Report Line Head],[Input UOM],[Planned Qty],[Planned Types],[Actual Qty],[Actual Types],[Reject Qty],[Rework Qty],[Hit _],[Extra],[Not Received Types],[DH Name],[FH Name],[PR Group],[Pln Input Child Grid],[Plan WC No],[Schedule No],cast(cast([Act Start Date-Time] as date)as varchar)[Act Start Date-Time],cast(cast([Act End Date-Time] as date)as varchar)[Act End Date-Time],[Open Qty],[Open Types],[Achieved Qty],[Achieved Types],[Out of Plan Qty],[Out of Plan Types],[Hit _ - Opening],[DR-01 Count],[DR-02 Count],[DR-03 Count],[DR-04 Count],[DR-05 Count],[DR-06 Count],[Function],[WC Group],[WC Seq No],[WC Cap Shift 1],[WC Cap Shift 2],[WC Cap Shift 3],[Planned Capacity],[Against Cyc Time Types],[Against Cyc Time Qty],[WC Name],[Wait Types],[Wait Qty],cast(cast([Updated Time] as date)as varchar)[Updated Time],[Current Types],[Current Qty],[On-Hold Types],[On-Hold Qty],[Additions Types],[Additions Qty]

from " . '[Micropack New$Plan Actual Production Data]' . " where [WC No] = '$workno1' and [Shift No_]='$shift_no' ";

// echo $workno1;
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$sql3 = "select [Report Line Head],[DH Name],[FH Name] from " . '[Micropack New$Plan Actual Production Data]' . " where [WC No]='$workno1'";
$stmt3 = sqlsrv_query($conn, $sql3);
if ($stmt3 === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
    $name = $row['Report Line Head'];
    $dh_name = $row['DH Name'];
    $fh_name = $row['FH Name'];
}

$sql2 = "select [Report Line Head],[DH Name],[FH Name] from " . '[Micropack New$Plan Actual Production Data]' . " where [WC No]='$workno2'";
$stmt2 = sqlsrv_query($conn, $sql2);
if ($stmt2 === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
    $name2 = $row['Report Line Head'];
    $dh_name2 = $row['DH Name'];
    $fh_name2 = $row['FH Name'];
}


$sql4 = "select
[timestamp],cast(cast([Shift Start Time] as date)as varchar)[Date],[Shift No_],[PR SNO],[Shift Code],cast(cast([Shift Start Time] as date)as varchar)[Shift Start Time],cast(cast([Shift End Time] as date)as varchar)[Shift End Time],[WC No],[Report Line Head],[Input UOM],[Planned Qty],[Planned Types],[Actual Qty],[Actual Types],[Reject Qty],[Rework Qty],[Hit _],[Extra],[Not Received Types],[DH Name],[FH Name],[PR Group],[Pln Input Child Grid],[Plan WC No],[Schedule No],cast(cast([Act Start Date-Time] as date)as varchar)[Act Start Date-Time],cast(cast([Act End Date-Time] as date)as varchar)[Act End Date-Time],[Open Qty],[Open Types],[Achieved Qty],[Achieved Types],[Out of Plan Qty],[Out of Plan Types],[Hit _ - Opening],[DR-01 Count],[DR-02 Count],[DR-03 Count],[DR-04 Count],[DR-05 Count],[DR-06 Count],[Function],[WC Group],[WC Seq No],[WC Cap Shift 1],[WC Cap Shift 2],[WC Cap Shift 3],[Planned Capacity],[Against Cyc Time Types],[Against Cyc Time Qty],[WC Name],[Wait Types],[Wait Qty],cast(cast([Updated Time] as date)as varchar)[Updated Time],[Current Types],[Current Qty],[On-Hold Types],[On-Hold Qty],[Additions Types],[Additions Qty]

from " . '[Micropack New$Plan Actual Production Data]' . " where [WC No] = '$workno2' and [Shift No_]='$shift_no'";

// echo $workno1;
$stmt4 = sqlsrv_query($conn, $sql4);
if ($stmt4 === false) {
    die(print_r(sqlsrv_errors(), true));
}


?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>CRM | Create  ticket</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />

<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<style>
.tablearea {

  overflow: scroll;
  overflow-x: scroll;
  overflow-y:scroll;
  height: 400px;


}
</style>
</head>
<body class="" style="background-color: white">

<h3 style="color: cadetblue;" class="text-center">Plan Actual Production Data</h3>
<div class="container">
    <div class="row">

                                        <div class="col-md-4 text-left">
                                                <label  style="color: cadetblue;"><b>Work Center status</b></label>
                                        </div>

                                        <div class="col-md-4 text-center">
                                                <label  style="color: cadetblue;"><b><?php echo date("Y-m-d"); ?></b></label>
                                                <?php 
                                            if($time <"14:00")
                                            {
                                            ?>
                                                <label  style="color: cadetblue;"><b>06:00 TO 14:00</b></label>
                                                <?php  }
                                                elseif($time <"22:00"){
                                                ?>
                                                <label  style="color: cadetblue;"><b>14:00 TO 22:00</b></label>
                                                <?php }
                                                    else{
                                                        ?>
                                                         <label  style="color: cadetblue;"><b>22:00 TO 06:00</b></label>
                                                         <?php 
                                                    }?>
                                        </div>

                                        <div class="col-md-4 text-right">
                                            <?php 
                                            if($time <"14:00")
                                            {
                                            ?>
                                                <label  style="color: cadetblue;"><b>SHIFT 1</b></label>
                                                <?php  }
                                                elseif($time <"22:00"){
                                                ?>
                                                    <label  style="color: cadetblue;"><b>SHIFT 2</b></label>
                                                    <?php }
                                                    else{
                                                        ?>
                                                        <label  style="color: cadetblue;"><b>SHIFT 3</b></label>
                                                        <?php 
                                                    }?>
                                                <label  style="color: cadetblue;"><b><?php echo date("H:i"); ?></b></label>
                                        </div>


                                        <div class="col-md-6" style="text-align:center;">
                                           <label ><b><?php echo $name ?></b></label>
                                        </div>
                                        <div class="col-md-6" style="text-align:center;">
                                           <label ><b><?php echo $name2 ?></b></label>
                                        </div>
									 <label class="col-md-3 col-xs-12 control-label">FH Name:</label>
                                       <div class="col-md-3 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"></span>
                                                <input type="text" name="scheduleno" id="scheduleno" value="<?php echo $fh_name ?>" required class="form-control"/>
                                            </div>

                                        </div>
                                         <label class="col-md-2 col-xs-12 control-label">FH Name:</label>
                                       <div class="col-md-3 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"></span>
                                                <input type="text" name="scheduledate" id="scheduledate" value="<?php echo $fh_name2 ?>" required class="form-control"/>
                                            </div>

                                        </div>


                                        <label class="col-md-3 col-xs-12 control-label">DH Name:</label>
                                       <div class="col-md-3 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"></span>
                                                <input type="text" name="scheduletime" id="scheduletime" value="<?php echo $dh_name ?>" required class="form-control"/>
                                            </div>

                                        </div>

										<label class="col-md-2 col-xs-12 control-label">DH Name:</label>
                                       <div class="col-md-3 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"></span>
                                                <input type="text" name="openingloadpanels" id="openingloadpanels" value="<?php echo $dh_name2 ?>" required class="form-control"/>
                                            </div>

                                        </div><br>


<div>&nbsp;</div>
                                       <div class="container">
                                        <div class="row justify-content-center">
                                        <div class="col-md-6">
                                        
                                        <!-- <table border="1"> -->
                                        <table class="table table-bordered table-striped text-center">
                                        <?php
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

    ?>
                                        <tr>
                                        <td>Shift Capacity</td>
                                        <td><?php echo $row['WC Cap Shift 1'] + $row['WC Cap Shift 2'] + $row['WC Cap Shift 3']  ?></td>
                                         </tr>

                                         <tr>
                                        <td>Shift Opening</td>
                                        <td><?php echo $row['Open Qty'] + $row['Open Types'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Shift Additions</td>
                                        <td><?php echo $row['Additions Types'] + $row['Additions Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Shift Output</td>
                                        <td><?php echo $row['Actual Types'] + $row['Actual Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Rejections</td>
                                        <td><?php echo $row['Reject Qty'] + $row['Rework Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>WIP (NOW)</td>
                                        <td><?php echo $row['Current Types'] + $row['Current Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Waiting > 24 Hours</td>
                                        <td><?php echo $row['Wait Types'] + $row['Wait Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Current Load (In Hrs.)</td>
                                        <td><?php echo $row['Updated Time'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>On-Hold</td>
                                        <td><?php echo $row['On-Hold Types'] + $row['On-Hold Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Output done within Cycle Time range</td>
                                        <td><?php echo $row['Against Cyc Time Types'] + $row['Against Cyc Time Qty'] ?></td>

                                        </tr>
                                        
                                        <?php
}
?>

                                        </table>
</div>
                                        <div class="col-md-6  justify-content-Right" >
                                        <!-- <table border="1"> -->
                                        <table class="table table-bordered table-striped text-Right">
                                        <?php
while ($row = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)) {

    ?>
                                        <tr>
                                        <td>Shift Capacity</td>
                                        <td><?php echo $row['WC Cap Shift 1'] + $row['WC Cap Shift 2'] + $row['WC Cap Shift 3']  ?></td>
                                         </tr>

                                         <tr>
                                        <td>Shift Opening</td>
                                        <td><?php echo $row['Open Qty'] + $row['Open Types'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Shift Additions</td>
                                        <td><?php echo $row['Additions Types'] + $row['Additions Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Shift Output</td>
                                        <td><?php echo $row['Actual Types'] + $row['Actual Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Rejections</td>
                                        <td><?php echo $row['Reject Qty'] + $row['Rework Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>WIP (NOW)</td>
                                        <td><?php echo $row['Current Types'] + $row['Current Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Waiting > 24 Hours</td>
                                        <td><?php echo $row['Wait Types'] + $row['Wait Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Current Load (In Hrs.)</td>
                                        <td><?php echo $row['Updated Time'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>On-Hold</td>
                                        <td><?php echo $row['On-Hold Types'] + $row['On-Hold Qty'] ?></td>

                                        </tr>
                                        <tr>
                                        <td>Output done within Cycle Time range</td>
                                        <td><?php echo $row['Against Cyc Time Types'] + $row['Against Cyc Time Qty'] ?></td>

                                        </tr>
                                        <?php
}
?>

                                        </table>
</div>
    </div>
</div>


</div>
<script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>


<script src="assets/js/core.js" type="text/javascript"></script>
<script src="assets/js/chat.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>

</body>
</html>