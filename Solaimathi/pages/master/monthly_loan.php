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
   
   $msg = addloan($due_date,$principle_amount,$loan_interest,$loanid,$due_amount,$dueno,$due_status,$interest_days,$interest_amount,$getid);
   
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
                        <!--<a href="<?php echo $sitename; ?>master/models.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>-->

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Monthly Loan</h4>
                    <ol class="breadcrumb">
                      
                        <li class="breadcrumb-item">Monthly Loans List</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Monthly Loan</li>
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

                                <form method="post" autocomplete="off" enctype="multipart/form-data" action="">
                                    <div class="box box-info">
                                        <div class="box-header with-border">

  <span style="float:right; font-size:13px; color: #333333; text-align: right; padding: 8px;"><span style="color:#FF0000;">*</span> Marked Fields are Mandatory<br></span> 
  <br>
                                        </div>
                                        <div class="box-body">
                                            <br>
                                        <?php //echo $msg; ?>
              
              <div class="row">
			   <div class="col-md-6">
                            <label>Customer Loan ID<span style="color:#FF0000;"> *</span></label>
							
							<select name="loanid" id="loanid" class="form-control" required="required" onchange="getloandetails(this.value);">
							<option value="">Select</option>
							<?php
							 $sel = pFETCH("SELECT * FROM `customer` WHERE `status`=? AND (`vehicle_type`='1' OR `vehicle_type`='2')", 1);
               while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
							?>
							<option value="<?php echo $fdepart['id']; ?>"><?php echo $fdepart['customerid']; ?></option>
			   <?php } ?>
							</select>
                            </div>
			   <div class="col-md-6">
                            <label>Customer Name<span style="color:#FF0000;"> *</span></label>
							
							<input type="text" id="cuname" name="cuname" class="form-control" readonly="readonly">
                            </div>
							
							
			  </div>
			  <br>
                        <div class="row">
						<div class="col-md-6">
                            <label>Bike Name</label>
                            <input type="hidden" id="vehicle_type">
							<input type="text" class="form-control" name="bike_name" id="bike_name" readonly="readonly">
							</div>
                            <div class="col-md-6">
                            <label>Due Date</label>
                            <input type="date" required="required" class="form-control" name="due_date" id="due_dates">
                            </div>
							
						</div>
						<br>
                        <div class="row">
                            <div class="col-md-6">
                            <label>Due Amount</label>
                            <input type="text" required="required" class="form-control" name="due_amount" id="due_amount">
                            </div>
                        <div class="col-md-6">
                            <label>Principle Amount</label>
                             <input type="text" class="form-control" name="principle_amount" id="principle_amount" readonly="readonly">
                            </div>
                          
                        </div>
                        <br>

							<div class="row">
							  <div class="col-md-6">
                            <label>Interest Amount</label>
                            <input type="text" readonly="readonly" class="form-control" name="loan_interest" id="loan_interest">
                            </div>
							<div class="col-md-6">
                            <label>Due No<span style="color:#FF0000;"> *</span></label>
							
							<select name="dueno" class="form-control" required="required">
							<option value="">Select</option>
							<?php for($i=1;$i<=10;$i++) { ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
							</select>
                            </div>
							
							</div>
							<br>
							<div class="row">
                                <div class="col-md-6">
                            <label>Due Status</label>
                            <select name="due_status" class="form-control">
                            <option value="Current Due">Current Due</option>
                            <option value="Late Due">Late Due</option>
                            </select>
                            </div>
							<div class="col-md-6">
                            <label>Days of Interest</label>
							<input type="text" class="form-control" name="interest_days" >
							</div>
							
							</div>
							<br>
							<div class="row">
                                <div class="col-md-6">
                            <label>Interest Amount</label>
                            <input type="text" class="form-control" name="interest_amount">
                            </div>
							 <div class="col-md-6">
                            <label>Status</label>
                          
                          <select name="status" class="form-control">
                         <option value="1">Active</option>      
                         <option value="0">Inactive</option>      
                          </select>
                      </div> 
					  
							  </div>
							  <br>
							 
                       <div class="row">
                             <div class="col-md-6"><strong>Remaining Amount</strong></div>
                             <div class="col-md-6"><strong>Remaining Days</strong></div>
                             </div>
                             <br>
                             <div class="row">
                             <div class="col-md-6" id="balcamt">Rs. <?php echo $balcamt; ?></div>
                             <div class="col-md-6"  id="balcdays"><?php echo $balcdays; ?></div>
                             </div>
                             <br>
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
                         
               
                </div><!-- /.box-body -->
                <br><br>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <!--<a href="<?php echo $sitename; ?>master/models.htm">Back to Listings page</a>-->
                        </div>
                       
                    </div>
                </div>
                    
                                    </div>  </form>
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

$("#due_amount").keyup(function(){
    cusid=$("#loanid").val();
    amount=$("#principle_amount").val();

    vehicle_type=$("#vehicle_type").val();
 $.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {loantype:vehicle_type,cusid: cusid,vehicle_type:vehicle_type,incval:1,amount:amount},
            success: function (data) {
            var result = data.split('#');
            $("#balcamt").html(result[0]);
            $("#balcdays").html(result[1]);

            
            }
        });
});

function getloandetails(a)
   {
     var successCount = 0;
       $.ajax({
         cache: true,
         url: "<?php echo $sitename; ?>pages/master/loandetails.php?loanid="+a,
         success: 
           function(data)
           {
               if(data!='' && data!='0')
               {
            const myArray = data.split("#");
           $('#cuname').val(myArray[0]); 
          $('#bike_name').val(myArray[1]); 
		   $('#due_amount').val(myArray[2]); 
           $("#vehicle_type").val(myArray[3]);
$("#principle_amount").val(myArray[4]);
$("#loan_interest").val(myArray[5]);

              cusid=$("#loanid").val();
    amount=myArray[4];
    vehicle_type=myArray[3];

  
 $.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {loantype:vehicle_type,cusid: cusid,vehicle_type:vehicle_type,incval:1,amount:amount},
            success: function (data) {
            var result = data.split('#');
            $("#balcamt").html(result[0]);
            $("#balcdays").html(result[1]);

            
            }
        });

		   }
               else{
				   
                $('#orderresult').val('');
                
               }
         },
         complete: function() 
         {
           
          // setInterval(sendRequest, 30000); 
         }
     });
   };
   
   
    function getmanager(a)
    {
        $.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {supervisor: a},
            success: function (data) {
              $("#manager").html(data);
            }
        });
    }
   
</script>  
