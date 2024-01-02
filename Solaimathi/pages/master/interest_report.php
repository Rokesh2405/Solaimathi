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
    #normalexamples tbody tr td:nth-child(6),tbody tr td:nth-child(7),tbody tr td:nth-child(8)
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
                        <li class="breadcrumb-item active"> Installment Report</li>
                    </ol>
                </div>
</div>
                <!-- /.box-header -->
            <div class="row">
                    <div class="col-12">
                      
                        <div class="card-box table-responsive">
                            
<div class="row">
<div class="col-md-12">
<form name="search" method="post">
<div class="panel panel-info">
    <div class="panel-heading">Search</div>
    <div class="panel-body">
	<div class="row">
	<div class="col-md-6">
	 <label>From Date</label>
	<input type="date" name="fromdate" class="form-control" value="<?php echo $_REQUEST['fromdate']; ?>">
	</div>
	<div class="col-md-6">
	 <label>To Date</label>
	<input type="date" name="todate" class="form-control" value="<?php echo $_REQUEST['todate']; ?>">
	</div>
	</div>
	<br>
	<div class="row">
 <div class="col-md-6">
	 <label>Customer Mobileno</label>
	<input type="number" name="mobileno" class="form-control" value="<?php echo $_REQUEST['mobileno']; ?>">
	</div>
		<div class="col-md-6">
	  <br>
	  <input type="submit" name="search" value="Search" class="btn btn-success"><!--&nbsp;&nbsp;
	  <input type="submit" class="btn btn-success" name="export" value="Export Excel">
	  -->
	  </div>
	
	</div>
	
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
								
									 <?php 
								 if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(date(`date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND date(`date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}
if($_REQUEST['customerid']!='')
{
$s1[]="`customerid`='".$_REQUEST['customerid']."'";
}
if($_REQUEST['mobileno']!='')
{
$s1[]="`mobileno`='".$_REQUEST['mobileno']."'";
}
if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}

?>


                                    <table id="normalexamples" class="table table-bordered table-striped" width="100%">
                                         <thead>
                               <tr align="center">
								<th style="width:5%;">S.No</th>
                                    <th align="left">Date</th>
									<th align="left">Customer ID</th>
				      <th align="left">Customer Name</th>
					   <th align="left">Customer Mobileno</th>
					   <th align="left">Loan Amount</th>
					    <th align="left">Interest Percentage</th>
					  <th align="left">Interest Amount</th>
					</thead>
                              <tbody>
							

<?php
$sno=1;
if($s!='') { 
 $message1 = $db->prepare("SELECT * FROM `customer` WHERE `id`!='0' AND $s ORDER BY `date` DESC");
}
else{
$message1 = $db->prepare("SELECT * FROM `customer` WHERE `id`!='0' ORDER BY `date` DESC");	
}

$message1->execute();
while($commsilist = $message1->fetch(PDO::FETCH_ASSOC)) {


?>

                                <tr>
                                     <td style="width:5%;"> <a href="<?php echo $chatlink; ?>" style="color:#000; font-weight:500;"><?php echo $sno; ?></a></td>
									 <td><?php echo date('d-M-Y',strtotime($commsilist['date'])); ?></td>
                                 	<td ><?php echo $commsilist['customerid']; ?></td>
									<td ><?php echo $commsilist['name']; ?></td>
									<td><?php echo $commsilist['mobileno']; ?></td>
									
									<td>Rs. <?php echo $commsilist['loan_amount']; ?></td>
									
									<td><?php if($commsilist['interest_percentage']!='') { echo $commsilist['interest_percentage'].'%'; }?></td>
									<td><?php 
									$interamt=$commsilist['loan_amount']*($commsilist['interest_percentage']/100);
									echo 'Rs.'.$interamt; ?></td>
									</tr>
<?php  $sno++; } ?>

 <tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6">&nbsp;</th>
                                        
                                    </tr>
                                </tfoot>

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
