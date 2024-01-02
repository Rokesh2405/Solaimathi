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
    #normalexamples tbody tr td:nth-child(6)
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
                        <li class="breadcrumb-item active"> Expense Report</li>
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
	<div class="col-md-4">
	 <label>From Date</label>
	<input type="date" name="fromdate" class="form-control" value="<?php echo $_REQUEST['fromdate']; ?>">
	</div>
	<div class="col-md-4">
	 <label>To Date</label>
	<input type="date" name="todate" class="form-control" value="<?php echo $_REQUEST['todate']; ?>">
	</div>
	<div class="col-md-4">
	  <label>Expense Type</label>
 
 <select name="expense_type" class="form-control">
							 <option value="">Select</option>
                             <?php
$customer = pFETCH("SELECT * FROM `expense_type` WHERE `status`=?", '1');
while ($customerfetch = $customer->fetch(PDO::FETCH_ASSOC)) 
{
?>
 <option value="<?php echo $customerfetch['id']; ?>"><?php echo $customerfetch['expense_type']; ?></option>
<?php } ?>							
							 </select>
	 </div>

</div>
<br>

 <div class="row"> 
	<div class="col-md-4">
	  <br>
	  <input type="submit" name="search" value="Search" class="btn btn-success">&nbsp;&nbsp;
	  <input type="submit" class="btn btn-success" name="export" value="Export Excel">
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
                                    <table id="normalexamples" class="table table-bordered table-striped" width="100%">
                                         <thead>
                               <tr align="center">
								<th style="width:5%;">S.No</th>
                                    <th align="left">Date</th>
				      <th align="left">Expense Type</th>
					  
					  <th align="left">Amount</th>
					  <th align="left">Comment</th>
					
					</thead>
                              <tbody>
								 <?php 
								 if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!='') {
$s1[]="(date(`expense_date`)>='".date('Y-m-d',strtotime($_REQUEST['fromdate']))."'  AND date(`expense_date`)<='".date('Y-m-d',strtotime($_REQUEST['todate']))."')";
}
if($_REQUEST['expense_type']!='')
{
$s1[]="`expense_type`='".$_REQUEST['expense_type']."'";
}


if(count($s1)>0) {
$s=implode('  AND  ',$s1);
}

$sno=1;
if($s!='') { 
 $message1 = $db->prepare("SELECT * FROM `expense` WHERE `id`!='0' AND $s ORDER BY `date` DESC");
}
else{
$message1 = $db->prepare("SELECT * FROM `expense` WHERE `id`!='0' ORDER BY `date` DESC");	
}

 $message1->execute();
while($commsilist = $message1->fetch(PDO::FETCH_ASSOC)) {


?>

                                <tr>
                                     <td style="width:5%;"> <a href="<?php echo $chatlink; ?>" style="color:#000; font-weight:500;"><?php echo $sno; ?></a></td>
                                     <td><?php echo date('d-M-Y',strtotime($commsilist['date'])); ?></td>
                                  <td><?php echo getexpensetype('expense_type',$commsilist['expense_type']); ?></td>
									<td>Rs. <?php echo $commsilist['amount']; ?></td>
									<td><?php echo $commsilist['comment']; ?></td>
									
									</tr>
<?php  $sno++; } ?>

 <tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5">&nbsp;</th>
                                        
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
