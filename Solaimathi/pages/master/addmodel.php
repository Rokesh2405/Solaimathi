<?php
$menu = "4";
$thispageid = 17;
$franchisee = 'yes';
include ('../../config/config.inc.php');
include ('../../require/header.php');
//error_reporting(1);
//ini_set('display_errors','1');
//error_reporting(E_ALL);

if (isset($_REQUEST['submit'])) {
    @extract($_REQUEST);
    $getid = $_REQUEST['banid'];
    $ip = $_SERVER['REMOTE_ADDR'];

    
    
   $msg = addmodel($vehicle_type,$bike_name,$yearof_model,$model_name,$amount,$status,$getid);
   
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
                        <a href="<?php echo $sitename; ?>master/models.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Year of Models</h4>
                    <ol class="breadcrumb">
                      
                        <li class="breadcrumb-item">Year of Models List</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Year of Model</li>
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
                            <label>Vehicle Type<span style="color:#FF0000;"> *</span></label>
							<select name="vehicle_type" class="form-control" required="required" onchange="getvehicle(this.value);">
							<option value="">Select</option>
							<option value="1" <?php if(getmodel('vehicle_type', $_REQUEST['banid'])==1) { ?> selected="selected" <?php } ?>>Bike</option>
							<option value="2" <?php if(getmodel('vehicle_type', $_REQUEST['banid'])==2) { ?> selected="selected" <?php } ?>>Car</option>
							</select>
							</div>
							
                              <div class="col-md-6">
                            <label>Vehicle Name<span style="color:#FF0000;"> *</span></label>
							
							<select name="bike_name" id="bike_name" class="form-control">
							<option value="">Select</option>
							<?php
							if($_REQUEST['banid']!='') {
							$vehitype=getmodel('vehicle_type', $_REQUEST['banid']);
			   $sel = pFETCH("SELECT * FROM `bike` WHERE `status`=? AND `vehicle_type`=? ", 1,$vehitype);
               while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
							?>
							<option value="<?php echo $fdepart['id']; ?>" <?php if(getmodel('bike_name', $_REQUEST['banid'])==$fdepart['id']) { ?> selected="selected" <?php } ?>><?php echo $fdepart['bike_name']; ?></option>
							<?php } } ?>
							</select>
                            </div>
							
							</div>
							<br>
							<div class="row">
							<div class="col-md-6">
                            <label>Model Name<span style="color:#FF0000;"> *</span></label>
							<input type="text" required="required" name="model_name" value="<?php echo getmodel('model_name', $_REQUEST['banid']); ?>" placeholder="Enter the Model Name" class="form-control" />
							</div>
							<div class="col-md-6">
                            <label>Year of Model<span style="color:#FF0000;"> *</span></label>
							<input type="text" name="yearof_model" required="required" class="form-control" placeholder="Enter the Year Of Model" value="<?php echo getmodel('yearof_model', $_REQUEST['banid']); ?>">
							
                            </div>
							</div>
							<br>
							<div class="row">
							
							 <div class="col-md-6">
                            <label>Status</label>
                          
                          <select name="status" class="form-control">
                         <option value="1" <?php if(getmodel('status', $_REQUEST['banid'])=='1') { ?> selected="selected"<?php } ?>>Active</option>      
                         <option value="0" <?php if(getmodel('status', $_REQUEST['banid'])=='0') { ?> selected="selected"<?php } ?>>Inactive</option>      
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
    function getvehicle(a)
    {
		$.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {vehicletype: a},
            success: function (data) {
              $("#bike_name").html(data);
            }
        });
    }
   
</script>  
