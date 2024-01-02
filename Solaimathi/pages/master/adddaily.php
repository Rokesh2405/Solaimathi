<?php
$menu = "4";
$thispageid = 17;
$franchisee = 'yes';
include ('../../config/config.inc.php');
include ('../../require/header.php');
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);
if($_REQUEST['banid']!='') {
	$customer_id=getinstallment('customerid',$_REQUEST['banid']);
	$type=getinstallment('type',$_REQUEST['banid']);
	 $link33 = FETCH_all("SELECT * FROM customer WHERE id=? AND vehicle_type=?", $customer_id,$type); 
 $link22 = FETCH_all("SELECT COUNT(*) AS `totdays` , SUM(`amount`) AS `totamount` FROM installment WHERE customerid=? AND type=?", $customer_id,$type);  
 $balcamt=$link33['loan_amount']-$link22['totamount'];
 $balcdays=$link33['due_amt_per_month']-$link22['totdays'];

}

if (isset($_REQUEST['submit'])) {
    @extract($_REQUEST);
    $getid = $_REQUEST['banid'];
    $ip = $_SERVER['REMOTE_ADDR'];
$type="3";
   $msg = addinstallment($customer_id,$type,$paid_date,$amount,$paid_status,$getid);
  
 $link33 = FETCH_all("SELECT * FROM customer WHERE id=? AND vehicle_type=?", $customer_id,$type); 
 $link22 = FETCH_all("SELECT COUNT(*) AS `totdays` , SUM(`amount`) AS `totamount` FROM installment WHERE customerid=? AND type=?", $customer_id,$type);  
 $balcamt=$link33['loan_amount']-$link22['totamount'];
 $balcdays=$link33['due_amt_per_month']-$link22['totdays'];

}

?>
<script type="text/javascript">
 
    function deleteimage(a, b, c, d, e, f) {

        $.ajax({
            type: "POST",
            url: "<?php echo $sitename; ?>config/functions_ajax.php",
            data: {image: a, id: b, table: c, path: d, images: e, pid: f},
            success: function (data) {
               // alert(data);   
                $('#delimage').html(data);
            }

        });

    }
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right m-t-15">
                        <a href="<?php echo $sitename; ?>master/daily.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Daily Installment</h4>
                    <ol class="breadcrumb">
                      
                        <li class="breadcrumb-item"> Daily Installment List</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?>  Daily Installment</li>
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
                            <?php echo $msg; ?>

                               
                                    <div class="box box-info">
                                        <div class="box-header with-border">

  <span style="float:right; font-size:13px; color: #333333; text-align: right; padding: 8px;"><span style="color:#FF0000;">*</span> Marked Fields are Mandatory<br></span> 
  <br>
                                        </div>
                                        <div class="box-body">
                                            <br>
											 <form method="post" autocomplete="off" enctype="multipart/form-data" action="">
											 <?php
											 if($_REQUEST['customerid']!='') {
											$cusid=$_REQUEST['customerid'];
										
											 $getrecd = FETCH_all("SELECT * FROM customer WHERE `id`=? ORDER BY `id` DESC", $cusid);
											 if($getrecd['vehicle_type']=='1' || $getrecd['vehicle_type']=='2'){
											$loanamt= $getrecd['due_amt_per_month'];
											}
											else
											{
											$loanamt=$getrecd['loan_amount']/$getrecd['due_amt_per_month'];
											}
											  }
											  if($_REQUEST['cusname']!='') {
											 $cusid=$_REQUEST['cusname'];
																						
											 $getrecd = FETCH_all("SELECT * FROM customer WHERE (`name` LIKE '%".$cusid."%') OR (`mobileno`='".$cusid."') AND `vehicle_type`='3' AND `id`!=? ORDER BY `id` DESC", '0');
											 if($getrecd['vehicle_type']=='1' || $getrecd['vehicle_type']=='2'){
											 $loanamt= $getrecd['due_amt_per_month'];
											}
											else
											{
											$loanamt=$getrecd['loan_amount']/$getrecd['due_amt_per_month'];
											}
											 }
											
											 ?>
                                        <?php //echo $msg; ?>
										<div class="panel panel-info">
  <div class="panel-heading">Search</div>
  <div class="panel-body">    
  <div class="row">
			 
			  <div class="col-md-4">
			  <label>Customer Name / Mobileno</label>
			  <input type="text" name="cusname" id="cusname" value="<?php echo $_REQUEST['cusname']; ?>" class="form-control">
			  
			  </div>
			   <div class="col-md-4">
			   <br>
			   <input type="submit" name="search" value="Search" class="btn btn-success">
			   </div>
			  </div>
              </div>
</div>

          </form>
		   <?php //if($_REQUEST['banid']!='' || $getrecd['id']!='') { ?>
		   <form method="post" autocomplete="off" enctype="multipart/form-data" action="">
		   <?php //if($_REQUEST['banid']!='') { ?>
		   <div class="row" >
						  <div class="col-md-4">
                            <label><strong>Customer Name</strong></label>
							  <input type="hidden" id="cusid" name="cusid" value="<?php if($getrecd['id']!='') { echo $getrecd['id']; } else { echo getinstallment('customerid', $_REQUEST['banid']); }  ?>">
							</div>
							<div class="col-md-4" id="cusdisplay1">
						
							<?php if($getrecd['name']!='') { echo $getrecd['name']; } else { echo getcustomer('name',getinstallment('customerid', $_REQUEST['banid'])); } ?>
							</div></div>
							<br>
		   <?php //} ?>
                          <div class="row">
						  <div class="col-md-6">
                            <label>Date<span style="color:#FF0000;"> *</span></label>
							<input type="hidden" name="customer_id" class="form-control" id="customer_id" value="<?php if($getrecd['id']!='') { echo $getrecd['id']; } else { echo getinstallment('customerid', $_REQUEST['banid']); }  ?>">
						<input type="date" name="paid_date" class="form-control" value="<?php if(getinstallment('paid_date', $_REQUEST['banid'])!='') { echo getinstallment('paid_date', $_REQUEST['banid']); } else { echo date('Y-m-d');} ?>">
							</div>
							<div class="col-md-6">
                            <label>Amount<span style="color:#FF0000;"> *</span></label>
							<input type="text" id="amount" required="required" name="amount" value="<?php if($loanamt!='') { echo number_format($loanamt,2); } else { echo getinstallment('amount', $_REQUEST['banid']); }?>" placeholder="Enter the Amount" class="form-control" />
							</div>
                        
							</div>
							<br>
							<div class="row">
							
							 <div class="col-md-6">
                            <label>Status <span style="color:#FF0000;"> *</span></label>
                          
                          <select name="paid_status" class="form-control" required="required">
						  <option value="">Select</option>
                         <option value="1" <?php if(getinstallment('paid_status', $_REQUEST['banid'])=='1') { ?> selected="selected"<?php } ?>>Paid</option>      
                         <option value="0" <?php if(getinstallment('paid_status', $_REQUEST['banid'])=='0') { ?> selected="selected"<?php } ?>>Unpaid</option>      
                          </select>
                      </div> 
							</div>
							
							  <br>
							 <?php //if($msg!='') { ?>
							 <div class="row">
							 <div class="col-md-6"><strong>Remaining Amount</strong></div>
							 <div class="col-md-6"><strong>Remaining Days</strong></div>
							 </div>
							 <br>
							 <div class="row">
							 <div class="col-md-6" id="balcamt">Rs. <?php echo $balcamt; ?></div>
							 <div class="col-md-6"  id="balcdays"><?php echo $balcdays; ?></div>
							 </div>
							 <?php //}  ?>
                      
                    <div class="row">
                        
                      <div class="col-md-6">
                          <br>
                            <button type="submit" name="submit" id="submit" class="btn btn-success" style="float:left;"><?php
                                if ($_REQUEST['banid'] != '') {
                                    echo 'UPDATE';
                                } else {
                                    echo 'SUBMIT';
                                }
                                ?></button>
                        </div>
              
                    </div>
                                            <br>
                         </form>
		   <?php //} ?>
                </div><!-- /.box-body -->
                <br><br>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?php echo $sitename; ?>master/daily.htm">Back to Listings page</a>
                        </div>
                       
                    </div>
                </div>
                    
                                    </div>  
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 


    <!-- /.box -->
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<?php include ('../../require/footer.php'); ?>

<script>
$("#cusname").keyup(function(){
	searchkey=$("#cusname").val();
 $.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {searchkey: searchkey,vehicle_type:3},
            success: function (data) {
			var result = data.split('#');
			$("#cusdisplay1").html(result[0]);
			$("#cusid").val(result[1]);
			$("#customer_id").val(result[1]);
			
            }
        });
});

$("#amount").keyup(function(){
	cusid=$("#cusid").val();
	amount=$(this).val();
	
 $.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {cusid: cusid,vehicle_type:3,incval:1,amount:amount},
            success: function (data) {
			var result = data.split('#');
			$("#balcamt").html(result[0]);
			$("#balcdays").html(result[1]);
            }
        });
});

    function getvehicle(a)
    {
		$.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {vehicletype: a},
            success: function (data) {
              $("#vehicle_name").html(data);
            }
        });
    }
   
</script>  
