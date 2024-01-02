<?php
$menu = "4";
$thispageid = 17;
$franchisee = 'yes';
include ('../../config/config.inc.php');
include ('../../require/header.php');
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);

if (isset($_REQUEST['submit'])) {
    @extract($_REQUEST);
    $getid = $_REQUEST['banid'];
    $ip = $_SERVER['REMOTE_ADDR'];

    
    
    //$msg = addexpensetype($expense_type,$status,$getid);
   
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
                        ?> Loan</h4>
                    <ol class="breadcrumb">
                      
                        <li class="breadcrumb-item">Loans List</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Loan</li>
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
			   <div class="col-md-4">
                            <label>Customer Name<span style="color:#FF0000;"> *</span></label>
							
							<select name="cname" class="form-control">
							<option value="">Select</option>
							<option value="Customer1">Customer1</option>
							<option value="Customer2">Customer2</option>
							<option value="Customer3">Customer3</option>
							</select>
                            </div>
							<div class="col-md-2">
							<br>
						<button name="addcus" class="btn btn-info">Add Customer</button>
							</div>
							<div class="col-md-6">
                            <label>Co-Applicant<span style="color:#FF0000;"> *</span></label>
							
							<select name="cname" class="form-control">
							<option value="">Select</option>
							<option value="co-applicant1">co-applicant1</option>
							<option value="co-applicant2">co-applicant2</option>
							<option value="co-applicant3">co-applicant3</option>
							</select>
                            </div>
			  </div>
			  <br>
                          <div class="row">
                              <div class="col-md-6">
                            <label>Bike Name<span style="color:#FF0000;"> *</span></label>
							
							<select name="bikename" class="form-control">
							<option value="">Select</option>
							<option value="HONDA">HONDA</option>
							</select>
                            </div>
							<div class="col-md-6">
                            <label>Year of Model<span style="color:#FF0000;"> *</span></label>
							
							<select name="modelyear" class="form-control">
							<option value="">Select</option>
							<?php for($i=2013;$i<=date('Y');$i++) { ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
							</select>
                            </div>
							</div>
							<br>
							<div class="row">
							<div class="col-md-6">
                            <label>Model Name</label>
							<select name="model" class="form-control">
							<option value="">Select</option>
							<option value="Activa">Activa</option>
							</select>
							</div>
							<div class="col-md-6">
                            <label>Amount</label>
							<input type="text" class="form-control" />
							</div>
							</div>
							<br>
							<div class="row">
							 <div class="col-md-6">
                            <label>Status</label>
                          
                          <select name="status" class="form-control">
                         <option value="1" <?php if(getexpensetype('status', $_REQUEST['banid'])=='1') { ?> selected="selected"<?php } ?>>Active</option>      
                         <option value="0" <?php if(getexpensetype('status', $_REQUEST['banid'])=='0') { ?> selected="selected"<?php } ?>>Inactive</option>      
                          </select>
                      </div> 
					  
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
                            <a href="<?php echo $sitename; ?>master/models.htm">Back to Listings page</a>
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
