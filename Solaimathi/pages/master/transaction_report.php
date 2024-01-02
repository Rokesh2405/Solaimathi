<?php
$menu = "10";
include ('../../config/config.inc.php');
$dynamic = '1';
//$datepicker = '1';
$datatable = '1';

include ('../../require/header.php');

print_r($_REQUEST);
if (isset($_REQUEST['delete']) || isset($_REQUEST['delete_x'])) {
    $chk = $_REQUEST['chk'];
    $chk = implode('.', $chk);
    $msg = delregister($chk);
}
if(isset($_REQUEST['export']))
{
@extract($_REQUEST);
$url=$sitename.'pages/master/export.php?type=expense&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&expense_type='.$_REQUEST['expense_type'];
echo "<script>window.open('".$url."', '_blank');</script>";
}

?>
<script type="text/javascript" >
    function validcheck(name)
    {
        var chObj = document.getElementsByName(name);
        var result = false;
        for (var i = 0; i < chObj.length; i++) {
            if (chObj[i].checked) {
                result = true;
                break;
            }
        }
        if (!result) {
            return false;
        } else {
            return true;
        }
    }

    function checkdelete(name)
    {
        if (validcheck(name) == true)
        {
            if (confirm("Please confirm you want to Delete this Model(s)"))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else if (validcheck(name) == false)
        {
            alert("Select the check box whom you want to delete.");
            return false;
        }
    }

</script>
<script type="text/javascript">
    function checkall(objForm) {
        len = objForm.elements.length;
        var i = 0;
        for (i = 0; i < len; i++) {
            if (objForm.elements[i].type == 'checkbox') {
                objForm.elements[i].checked = objForm.check_all.checked;
            }
        }
    }
</script>

<style type="text/css">
    .row { margin:0;
    }
    #normalexamples tbody tr td:nth-child(4), tbody tr td:nth-child(5)
    {
        text-align:center;
    }
    input#chk\[\] {
    margin-left: 29px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        
        <div class="row">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                <div class="col-sm-12">
                     <div class="btn-group pull-right m-t-15">
                       <!--  <a href="<?php echo $sitename; ?>master/userforms.htm"><button type="button" class="btn btn-default">Download Excel</button></a>  -->
                       <!--  <a href="<?php echo $sitename; ?>master/addregister.htm"><button type="button" class="btn btn-default">Add New</button></a>     -->                    
                    </div>
                  <h4 class="page-title">Reports</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $sitename; ?>"><?php echo getusers('name', $_SESSION['GRUID']); ?></a></li>
                        <li class="breadcrumb-item active"> Transaction Report</li>
                    </ol>
                </div>
</div>
                <!-- /.box-header -->
            <div class="row">
                    <div class="col-12">
                      
                        <div class="card-box table-responsive">
                     <?php
$first_day_this_month = date('01-m-Y'); // hard-coded '01' for first day
$last_day_this_month  = date('t-m-Y');
                     ?>       
<div class="row">
<div class="col-md-12">
<form name="search" method="post">
<div class="panel panel-info">
    <div class="panel-heading">Search</div>
    <div class="panel-body">
	<div class="row">
	<div class="col-md-4">
	 <label>From Date</label>
	<input type="date" name="fromdate" class="form-control" value="<?php if($_REQUEST['fromdate']!='') { echo $_REQUEST['fromdate']; } else { echo date('Y-m-d',strtotime($first_day_this_month)); } ?>">
	</div>
	<div class="col-md-4">
	 <label>To Date</label>
	<input type="date" name="todate" class="form-control" value="<?php if($_REQUEST['todate']!='') { echo $_REQUEST['todate']; } else { echo date('Y-m-d',strtotime($last_day_this_month)); } ?>">
	</div>
	
<div class="col-md-4">
      <br>
      <input type="submit" name="search" value="Search" class="btn btn-success">&nbsp;&nbsp;
     <!--  <input type="submit" class="btn btn-success" name="export" value="Export Excel"> -->
      </div>
</div>
<br>

 

	</div>
  </div>
</form>
</div>
</div>
 <br>                          
<?php if($msg !='') { echo $msg; } 

?>
     
              
                 <form name="form1" method="post" action="">
                                <div class="table-responsive">
                                    <table width="100%" border="1" cellpadding="10" cellspacing="0">
                                         <thead>
                               <tr align="center">
								<th style="width:5%;">S.No</th>
                       <th style="width:15%; text-align: left;">Date</th>
				      <th style="width:45%;text-align:left;">Particulars</th>
                      <th align="left">Debit</th>
					  <th align="left">Credit</th>
					
					</thead>
                    <tbody>
<?php 
if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$fday=date('Y-m-d',strtotime($_REQUEST['fromdate']));
$tday=date('Y-m-d',strtotime($_REQUEST['todate']));
}
else
{
$fday=date('Y-m-d',strtotime($first_day_this_month));
$tday=date('Y-m-d',strtotime($last_day_this_month));
}

if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}

$j='01';
$sno=1;
$debitamt='';
$creditamt='';
$i=$fday;
while(strtotime($i)<=strtotime($tday)) {


$cudate=date('Y-m-d',strtotime($i));

$j=$j+1;

$openingbalance = $db->prepare("SELECT * FROM `opening_balance` WHERE `id`!='0' AND date(`date`)='".$cudate."' ");
$openingbalance->execute();
while($openingbalancefetch = $openingbalance->fetch(PDO::FETCH_ASSOC)) {
    if($openingbalancefetch['opening_balance']!='') {
$creditamt+= $openingbalancefetch['opening_balance'];
?>

                                <tr>
                                     <td style="width:5%;"><?php echo $sno; ?></td>
                                     <td><?php echo date('d-M-Y',strtotime($openingbalancefetch['date'])); ?></td>
                                  <td><strong><?php echo getledgername('ledgername',$openingbalancefetch['ledger_name']); ?></strong>
                                  
                                </td>
                                     <td align="center">-</td>
                                    <td align="center">Rs. <?php echo $openingbalancefetch['opening_balance']; ?></td>
                                   
                                    
                                    </tr>
<?php  $sno++; } 
$installment = $db->prepare("SELECT * FROM `installment` WHERE `id`!='0' AND date(`date`)='".$cudate."' ");
$installment->execute();
while($installmentfetch = $installment->fetch(PDO::FETCH_ASSOC)) {
    $debitamt+= $installmentfetch['amount'];
?>

                                <tr>
                                     <td style="width:5%;"><?php echo $sno; ?></td>
                                     <td><?php echo date('d-M-Y',strtotime($installmentfetch['date'])); ?></td>
                                  <td><?php echo getcustomer('name',$installmentfetch['customerid']); ?><br>
                                    <strong>Loan Type :</strong>
                                    <?php if($installmentfetch['type']=='3') { echo "Daily Loan"; }
                                    if($installmentfetch['type']=='4') { echo "Weekly Loan"; }
                                    if($installmentfetch['type']=='5') { echo "Monthly Loan"; }
                                    ?>
                                </td>
									 <td align="center">-</td>
									<td align="center">Rs. <?php echo $installmentfetch['amount']; ?></td>
                                   
									
									</tr>
<?php  $sno++; } }


$loans = $db->prepare("SELECT * FROM `loans` WHERE `id`!='0' AND date(`date`)='".$cudate."' ");    
$loans->execute();
while($loansfetch = $loans->fetch(PDO::FETCH_ASSOC)) {
    if($loansfetch['due_amount']!='') {
     $creditamt+= $loansfetch['due_amount'];
    
?>

                                <tr>
                                     <td style="width:5%;"><?php echo $sno; ?></td>
                                     <td><?php echo date('d-M-Y',strtotime($loansfetch['date'])); ?></td>
                                  <td><?php echo getcustomer('name',$loansfetch['loanid']); ?><br>
                                    <strong>Loan Type :</strong>
                                    <?php if($loansfetch['type']=='1') { echo "Bike Loan"; }
                                    if($loansfetch['type']=='2') { echo "Car Loan"; }
                                    ?>
                                </td>
                                    <td align="center">-</td>
                                    <td align="center">Rs. <?php echo $loansfetch['due_amount']; ?></td>
                                    
                                    
                                    </tr>
<?php  $sno++; } }
$loancredit = $db->prepare("SELECT * FROM `loan_credit` WHERE `id`!='0' AND date(`date`)='".$cudate."' ");    
$loancredit->execute();
while($loancreditfetch = $loancredit->fetch(PDO::FETCH_ASSOC)) {
    if($loansfetch['interest_amount']!='') {
     $creditamt+= $loansfetch['interest_amount'];
    
?>

                                <tr>
                                     <td style="width:5%;"><?php echo $sno; ?></td>
                                     <td><?php echo date('d-M-Y',strtotime($loancreditfetch['date'])); ?></td>
                                  <td><?php echo getcustomer('name',$loancreditfetch['customerid']); ?><br>
                                    <strong>Loan Type :</strong>
                                    <?php if(getcustomer('vehicle_type',$loancreditfetch['customerid'])=='1') { echo "Bike Loan"; }
                                    if(etcustomer('vehicle_type',$loancreditfetch['customerid'])=='2') { echo "Car Loan"; }
                                    ?>
                                </td>
                                    <td align="center">-</td>
                                    <td align="center">Rs. <?php echo $loancreditfetch['interest_amount']; ?></td>
                                    
                                    
                                    </tr>
<?php  $sno++; } 
}
$debitcredit = $db->prepare("SELECT * FROM `debitcredit` WHERE `id`!='0' AND date(`date`)='".$cudate."' ");    
$debitcredit->execute();
while($debitcreditfetch = $debitcredit->fetch(PDO::FETCH_ASSOC)) {
 
if(($debitcreditfetch['type']=='1' && $debitcreditfetch['amount']!='') || ($debitcreditfetch['type']=='2' && $debitcreditfetch['amount']!='')) { 
?>

                                <tr>
                                     <td style="width:5%;"><?php echo $sno; ?></td>
                                     <td><?php echo date('d-M-Y',strtotime($debitcreditfetch['date'])); ?></td>
                                  <td><?php echo getcustomer('name',$debitcreditfetch['customer_name']); ?><br>
                                  <strong>Form Account:</strong> <?php echo $debitcreditfetch['description']; ?>
                                  
                                </td>

                                    <td align="center"><?php if($debitcreditfetch['type']=='1') { 
                                         $debitamt +=$debitcreditfetch['amount'];
                                        echo 'Rs.'.$debitcreditfetch['amount']; } else { echo "-"; }?></td>
                                    <td align="center"><?php if($debitcreditfetch['type']=='2') { 
                                          $creditamt+= $debitcreditfetch['amount'];
                                     echo 'Rs.'.$debitcreditfetch['amount']; } else { echo "-"; }?></td>
                                    
                                    </tr>
<?php  $sno++; } }
$expense = $db->prepare("SELECT * FROM `expense` WHERE `id`!='0' AND date(`expense_date`)='".$cudate."' ");
$expense->execute();
while($expensefetch = $expense->fetch(PDO::FETCH_ASSOC)) {
    if($expensefetch['amount']!='') {
?>

                                <tr>
                                     <td style="width:5%;"><?php echo $sno; ?></td>
                                     <td><?php echo date('d-M-Y',strtotime($expensefetch['expense_date'])); ?></td>
                                  <td><?php echo getexpensetype('expense_type',$expensefetch['expense_type']); ?><br>
                                    <?php
                                    echo $expensefetch['comment'];
                                    ?>
                                </td>
                                    <td align="center">Rs. <?php
                                         $debitamt+= $expensefetch['amount'];
                                     echo $expensefetch['amount']; ?></td>
                                    <td align="center">-</td>
                                    
                                    
                                    </tr>
<?php  $sno++; } 
}
?>


<?php
 $i = date('Y-m-d', strtotime('+1 day', strtotime($i)));


if($creditamt>$debitamt) {
$balcamt=$creditamt-$debitamt;
} 
if($creditamt<$debitamt) {
$balcamt=$debitamt-$creditamt;
} 

$lastDayThisMonth = date("Y-m-01");
$curtdate=date('Y-m-d');
if($lastDayThisMonth==$curtdate) {
global $db;
$link22 = FETCH_all("SELECT * FROM opening_balance WHERE ledger_name=? AND opening_balance=? AND date(date)=?", '5',$balcamt,$lastDayThisMonth);
if($link22['id']=='') {
$resa = $db->prepare("INSERT INTO opening_balance (ledger_name,opening_balance) VALUES (?,?)");
$resa->execute(array('5',$balcamt));
}

}

 } ?>
 <tbody>
                               

                                    <tr>
                                        <th colspan="3" style="text-align:right;"><strong>Total</strong></th>
                                        <th style="text-align:center;"><strong><?php if($debitamt!='') { echo 'Rs.'.number_format($debitamt,2); } ?></strong></th>
                                         <th style="text-align:center;" ><strong><?php if($creditamt!='') { echo 'Rs.'.number_format($creditamt,2); } ?></strong></th>
                                    </tr>
                                      <tr>
                                        <th colspan="3" style="text-align:right;"><strong>Balance</strong></th>
                                        <th style="text-align:center;" colspan="2">
                                        <?php 
                                        echo 'Rs.'.number_format($balcamt,2);
                                        ?>    
                                        </th>
                                    </tr>
                              


                                    </table>
                                </div>
                            </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        </div>
            </div>
        </div>
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
function getvendor(a)
    {
        $.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {subadmin: a},
            success: function (data) {
              $("#vendor").html(data);
            }
        });
    }
	
    function viewthis(a)
    {
        var did = a;
		 window.open("<?php echo $sitename; ?>master/' + a + '/viewuser.htm","_blank");
		 
    }     
</script>
<?php
include ('../../require/footer.php');
?>  
<script type="text/javascript">
      $('#normalexamples').dataTable({
        "bProcessing": true,
        "bServerSide": false,
        //"scrollX": true,
        "searching": true
    });
</script>
