<?php
$menu = "10";
if (isset($_REQUEST['coid'])) {
    $thispageeditid = 47;
} else {
    $thispageaddid = 47;
}
$franchisee = 'yes';
include ('../../config/config.inc.php');
$dynamic = '1';
//ini_set('display_errors','1');
//error_reporting(E_ALL);
include ('../../require/header.php');
if (isset($_REQUEST['delete']) || isset($_REQUEST['delete_x'])) {
    $chk = $apid;
   
    $msg = delcustomer($chk);
     $_SESSION['msg']= $msg;
        header('Location:../regsiteruser.htm');
}


?>
<script type="text/javascript" >
   function checkdelete(name)
    {
        if (confirm("Do you want to delete the User"))
            {
                return true;
            }
            else
            {
                return false;
            }
   }
</script>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                
                     
                    <div class="btn-group pull-right m-t-15">
                       
                        <a href="<?php echo $sitename; ?>master/loan_report.htm"><button type="button" class="btn btn-default">Back</button>
                        </a>        
                    </div> 
                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['coid'])) {
                            echo "View";
                        } else {
                            echo "Add";
                        }
                        ?> Details </h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $sitename; ?>"><?php echo getusers('name',$_SESSION['GRUID']); ?></a></li>
                       <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['coid'])) {
                                echo "View";
                            } else {
                                echo "Add";
                            }
                            ?> Details </li>
                    </ol>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

<!-- <p class="text-muted m-b-30 font-13">
    Use the button classes on an <code>&lt;a&gt;</code>, <code>&lt;button&gt;</code>, or <code>&lt;input&gt;</code> element.
</p> -->
                        <div class="row">
                            <div class="col-md-12">
                                <form name="department" id="department" action="#" method="post" enctype="multipart/form-data" autocomplete="off" >
                                    <div class="box box-info">
                                        <div class="box-body">
                                          

<h4>EMI Details</h4>
<br>
<?php  if(getcustomer('vehicle_type',$_REQUEST['coid'])=='1' || getcustomer('vehicle_type',$_REQUEST['coid'])=='2') { ?>
<table class="table table-bordered">
<tr>
<th>Sno</th>
<th>Due Date</th>
<th>Emi Amount</th>
<th>Priniciple Amount</th>
<th>Interest Amount</th>
<th>Late Fee</th>
<th>Status</th>
<th>Paid Date</th>    
</tr>  
<?php
$s=1;
 $loans = pFETCH("SELECT * FROM `loans` WHERE `loanid`=?", $_REQUEST['coid']);
 while ($loansfetch = $loans->fetch(PDO::FETCH_ASSOC)) {
?>  
<tr>
<td><?php echo $s; ?></td>
<td><?php echo date('d-m-Y',strtotime($loansfetch['due_date'])); ?></td>
<td><?php echo $loansfetch['due_amount']; ?></td>
<td><?php echo $loansfetch['principle_amount']; ?></td>
<td><?php echo $loansfetch['loan_interest']; ?></td>
<td><?php echo $loansfetch['interest_amount']; ?></td>
<td><?php echo "Paid"; ?></td>
<td><?php echo date('d-m-Y',strtotime($loansfetch['date'])); ?></td>
</tr>    
<?php $s++; } ?>
<tr>
<td></td>
</tr>

</table>
<?php }  
?>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
										<br>
                                            <div class="row">
                                                <div class="col-md-6">
<!--                                                    <a href="<?php //echo $sitename.'master/registeruser.htm'; ?>">Back</a>-->
                                                </div>
                                                <!--                                                    <div class="col-md-6">
              <button type="submit" name="statusupdate" id="statusupdate" class="btn btn-success" style="float:right;">Update Status</button>
                                                                                                    </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </form>               
                            </div>
                        </div>
                    </div>
                </div>
            </div>                                  
        </div> <!-- container -->
    </div> <!-- content -->


</div>
<?php include ('../../require/footer.php'); ?>

<script>
    function click1()
    {

        $('#demo').css("display", "block");

    }
</script>