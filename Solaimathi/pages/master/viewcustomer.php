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
                        <?php if(getcustomer('vehicle_type',$_REQUEST['coid'])=='1' || getcustomer('vehicle_type',$_REQUEST['coid'])=='2') { ?>
 <a href="<?php echo $sitename; ?>MPDF/loan_report.php?id=<?php echo $_REQUEST['coid']; ?>" target="_blank"><button type="button" class="btn btn-default">Print</button>
                        </a>  
                         <?php } else { ?>   
                        <a href="<?php echo $sitename; ?>MPDF/installment_report.php?id=<?php echo $_REQUEST['coid']; ?>" target="_blank"><button type="button" class="btn btn-default">Print</button>
                        </a>       
                    <?php } ?>
                        &nbsp;&nbsp;&nbsp;
                        <a href="<?php echo $sitename; ?>master/customer_report.htm"><button type="button" class="btn btn-default">Back</button>
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
                                            <h4>Customer Details</h4>
                                            <hr>
                                          <div class="row">
                                
                                   <div class="col-md-3">
                                       <label><strong>Reg No :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getusers('regno','1'); ?>
                                </div>
                                  <div class="col-md-3">
                                       <label><strong>Customer Name :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('name',$_REQUEST['coid']); ?>
                                </div>
                                   
                            </div>
                            <br />
                            <?php if(getcustomer('vehicle_type',$_REQUEST['coid'])=='1' || getcustomer('vehicle_type',$_REQUEST['coid'])=='2') { ?>
								<div class="row">
                                    <div class="col-md-3">
                                       <label><strong>Vehicle No :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('regno',$_REQUEST['coid']); ?>
                                </div> 
                                   <div class="col-md-3">
                                       <label><strong>Vehicle Name :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getbike('bike_name',getcustomer('vehicle_name',$_REQUEST['coid'])); ?>
                                </div> 
                            </div>
                                 
                                   <br>
                               <?php } ?>
                                <div class="row">
                                   <div class="col-md-3">
                                       <label><strong>Residence Address1 :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('cus_street',$_REQUEST['coid']); ?>
                                </div> 
                                 <div class="col-md-3">
                                       <label><strong>Address2 :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('cus_area',$_REQUEST['coid']).','.getcustomer('cus_city',$_REQUEST['coid']); ?>
                                </div> 
                            </div>
                            <br>
                               
                                <div class="row">
                                   <div class="col-md-3">
                                       <label><strong>Address3 :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('cus_state',$_REQUEST['coid']); ?>
                                </div> 
                                  <div class="col-md-3">
                                       <label><strong>Mobile :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('mobileno',$_REQUEST['coid']); ?>
                                </div> 
                            </div>         
                                    
                                     <br>
                               
                                <div class="row">
                                   <div class="col-md-3">
                                       <label><strong>Phone :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('alt_mobileno',$_REQUEST['coid']); ?>
                                </div> 
                                 
                            </div>         
                                      <br>
                                      <h4>Loan Details</h4>
                                      <hr>
                                       <div class="row">
                                         <div class="col-md-3">
                                       <label><strong>Loan Type :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php 
                                   if(getcustomer('vehicle_type',$_REQUEST['coid'])=='1') {
                                    echo "Bike Loan";
                                   }
                                  
                                   if(getcustomer('vehicle_type',$_REQUEST['coid'])=='2') {
                                    echo "Car Loan";
                                   }
                                   if(getcustomer('vehicle_type',$_REQUEST['coid'])=='3') {
                                    echo "Daily Loan";
                                   }
                                   if(getcustomer('vehicle_type',$_REQUEST['coid'])=='4') {
                                    echo "Weekly Loan";
                                   }
                                   if(getcustomer('vehicle_type',$_REQUEST['coid'])=='5') {
                                    echo "Monthly Loan";
                                   }
                                   ?>
                                </div> 
                                 
                                   <div class="col-md-3">
                                       <label><strong>Loan Amount :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('loan_amount',$_REQUEST['coid']); ?>
                                </div> 
                                 
                            </div>     
                     <br>
                     <?php  if(getcustomer('vehicle_type',$_REQUEST['coid'])=='1' || getcustomer('vehicle_type',$_REQUEST['coid'])=='2') { ?>
                    <div class="row">
                      <div class="col-md-3">
                                       <label><strong>Interest % :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('interest_percentage',$_REQUEST['coid']); ?>
                                </div> 
                                  <div class="col-md-3">
                                       <label><strong>EMI Amount:</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('due_amt_per_month',$_REQUEST['coid']); ?>
                                </div> 
                                 
                            </div>    
<br>
<?php } else { ?>
 <div class="row">
                      <div class="col-md-3">
                                       <label><strong>Initial Interest Amount :</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('interest_percentage',$_REQUEST['coid']); ?>
                                </div> 
                                  <div class="col-md-3">
                                       <label><strong>No Of Installment:</strong></label>
                                </div>
                                <div class="col-md-3">
                                   <?php echo getcustomer('due_amt_per_month',$_REQUEST['coid']); ?>
                                </div> 
                                 
                            </div>    
<?php } ?>
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
<?php }  else { ?>
   <br>
<table class="table table-bordered">
<tr>
<th>Sno</th>
<th>Emi Amount</th>
<th>Status</th>  
<th>Paid Date</th>    
</tr>  
<?php
$s=1;
 $loans = pFETCH("SELECT * FROM `installment` WHERE `customerid`=?", $_REQUEST['coid']);
 while ($loansfetch = $loans->fetch(PDO::FETCH_ASSOC)) {
?>  
<tr>
<td><?php echo $s; ?></td>
<td><?php echo $loansfetch['amount']; ?></td>
<td><?php if($loansfetch['paid_status']=='1') { echo "Paid"; } else { echo "Un Paid"; } ?></td>
<td><?php echo date('d-m-Y',strtotime($loansfetch['paid_date'])); ?></td>
</tr>    
<?php $s++; } ?>
<tr>
<td></td>
</tr>

</table>
<?php } ?>
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