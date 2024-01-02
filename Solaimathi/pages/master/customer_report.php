<?php
$menu = "10";
include ('../../config/config.inc.php');
$dynamic = '1';
//$datepicker = '1';
$datatable = '1';

include ('../../require/header.php');

if (isset($_REQUEST['delete']) || isset($_REQUEST['delete_x'])) {
    $chk = $_REQUEST['chk'];
    $chk = implode('.', $chk);
    $msg = delregister($chk);
}

if(isset($_REQUEST['export']))
{
@extract($_REQUEST);
$url=$sitename.'pages/master/export.php?type=customer&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&expense_type='.$_REQUEST['expense_type'];
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
                       </div>
                  <h4 class="page-title">Reports</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $sitename; ?>"><?php echo getusers('name', $_SESSION['GRUID']); ?></a></li>
                        <li class="breadcrumb-item active"> Customer Report</li>
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
<?php if($msg !='') { echo $msg; } ?>
     
              
                 <form name="form1" method="post" action="">
                                <div class="table-responsive">
                                    <table id="normalexamples" class="table table-bordered table-striped" width="100%">
                                         <thead>
                               <tr align="center">
						<th style="width:5%;">S.No</th>
                       <th align="left" style="width:15%;">Customer Name</th>
				      <th align="left" style="width:15%;">Contact No</th>
                      <th align="left" style="width:15%;">Loan Type</th>
                      <th align="left" style="width:15%;">Loan Amount</th>
                      <th align="left" style="width:10%;">View</th>
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

$sno=1;


$customer = $db->prepare("SELECT * FROM `customer` WHERE `id`!='0' ORDER BY `date` DESC");
$customer->execute();
while($customerfetch = $customer->fetch(PDO::FETCH_ASSOC)) {

?>

<tr>
<td style="width:5%;"><?php echo $sno; ?></td>
<td><?php echo date('d-M-Y',strtotime($customerfetch['date'])); ?></td>
<td><?php echo $customerfetch['name']; ?></td>
<td>
<?php 
if($customerfetch['vehicle_type']=='1') { echo "Bike Loan"; }
if($customerfetch['vehicle_type']=='2') { echo "Car Loan"; }
if($customerfetch['vehicle_type']=='3') { echo "Daily Loan"; }
if($customerfetch['vehicle_type']=='4') { echo "Weekly Loan"; }
if($customerfetch['vehicle_type']=='5') { echo "Monthly Loan"; }
?>
</td>
<td>Rs. <?php echo $customerfetch['loan_amount']; ?></td>
<td><i class="fa fa-eye" onclick="javascript:editthis(<?php echo $customerfetch['id']; ?>);" style="cursor:pointer;"> View </i></td>
</tr>
<?php  $sno++; } 

?>
 <tbody>
                               

                                  


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
	
  
</script>
<script type="text/javascript">
    function editthis(a)
    {
        var did = a;
        window.location.href = '<?php echo $sitename; ?>master/' + a + '/viewcustomer.htm';
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
