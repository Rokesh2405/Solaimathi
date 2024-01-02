<?php
$menu = "4";
$thispageid = 17;
$franchisee = 'yes';
include ('../../config/config.inc.php');
include ('../../require/header.php');
// error_reporting(1);
// ini_set('display_errors','1');
// error_reporting(E_ALL);

if($_REQUEST['delid1']!='')
{
 global $db;
 $c=$_REQUEST['delid1'];
        $get = $db->prepare("DELETE FROM `coapplicant` WHERE `id` = ? ");
        $get->execute(array($c));	
		$url=$sitename.'master/'.$_REQUEST['banid'].'/editcustomer.htm';
	  echo "<script>alert('Addon Deleted Successfully');window.location.assign('".$url."')</script>";
			
}

if (isset($_REQUEST['submit'])) {
    @extract($_REQUEST);
    $getid = $_REQUEST['banid'];
    $ip = $_SERVER['REMOTE_ADDR'];


	$pimage11 = getcustomer('insurance_proof', $_REQUEST['banid']);
    if(isset($_FILES["insurance_proof"]) && $_FILES["insurance_proof"]["error"] == 0)
    {
        $allowed11 = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename11 = time().str_replace(' ','-',$_FILES["insurance_proof"]["name"]);
        $filetype11 = $_FILES["insurance_proof"]["type"];
        $filesize11 = $_FILES["insurance_proof"]["size"];
        $ext11 = pathinfo($filename11, PATHINFO_EXTENSION);
        if(!array_key_exists($ext11, $allowed11)) die("Error: Please select a valid file format.");
        $maxsize11 = 5 * 1024 * 1024;
        if($filesize11 > $maxsize11) die("Error: File size is larger than the allowed limit.");
        if(in_array($filetype11, $allowed11))
        {
                move_uploaded_file($_FILES["insurance_proof"]["tmp_name"], $filename11 . "../../../../images/insurance_proof/" . $filename11);
                echo "Your file was uploaded successfully.";
    
        } 
        else
        {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } 
    else {
        $filename11 = $pimage11;
    }
	
	
	 $pimage1 = getcustomer('proof', $_REQUEST['banid']);
    if(isset($_FILES["proof"]) && $_FILES["proof"]["error"] == 0)
    {
        $allowed1 = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename1 = time().str_replace(' ','-',$_FILES["proof"]["name"]);
        $filetype1 = $_FILES["proof"]["type"];
        $filesize1 = $_FILES["proof"]["size"];
        $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);
        if(!array_key_exists($ext1, $allowed1)) die("Error: Please select a valid file format.");
        $maxsize1 = 5 * 1024 * 1024;
        if($filesize1 > $maxsize1) die("Error: File size is larger than the allowed limit.");
        if(in_array($filetype1, $allowed1))
        {
                move_uploaded_file($_FILES["proof"]["tmp_name"], $filename1 . "../../../../images/proof/" . $filename1);
                echo "Your file was uploaded successfully.";
    
        } 
        else
        {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } 
    else {
        $filename1 = $pimage1;
    }
	
	 $pimage2 = getcustomer('cuphoto', $_REQUEST['banid']);
    if(isset($_FILES["cuphoto"]) && $_FILES["cuphoto"]["error"] == 0)
    {
        $allowed2 = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename2 = time().str_replace(' ','-',$_FILES["cuphoto"]["name"]);
        $filetype2 = $_FILES["cuphoto"]["type"];
        $filesize2 = $_FILES["cuphoto"]["size"];
        $ext2 = pathinfo($filename2, PATHINFO_EXTENSION);
        if(!array_key_exists($ext2, $allowed2)) die("Error: Please select a valid file format.");
        $maxsize2 = 5 * 1024 * 1024;
        if($filesize2 > $maxsize2) die("Error: File size is larger than the allowed limit.");
        if(in_array($filetype2, $allowed2))
        {
                move_uploaded_file($_FILES["cuphoto"]["tmp_name"], $filename2 . "../../../../images/cuphoto/" . $filename2);
                echo "Your file was uploaded successfully.";
    
        } 
        else
        {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } 
    else {
        $filename2 = $pimage2;
    }
	
	
	$pimage3 = getcustomer('bikephoto', $_REQUEST['banid']);
    if(isset($_FILES["bikephoto"]) && $_FILES["bikephoto"]["error"] == 0)
    {
        $allowed3 = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename3 = time().str_replace(' ','-',$_FILES["bikephoto"]["name"]);
        $filetype3 = $_FILES["bikephoto"]["type"];
        $filesize3 = $_FILES["bikephoto"]["size"];
        $ext3 = pathinfo($filename3, PATHINFO_EXTENSION);
        if(!array_key_exists($ext3, $allowed3)) die("Error: Please select a valid file format.");
        $maxsize3= 5 * 1024 * 1024;
        if($filesize3 > $maxsize3) die("Error: File size is larger than the allowed limit.");
        if(in_array($filetype3, $allowed3))
        {
                move_uploaded_file($_FILES["bikephoto"]["tmp_name"], $filename3 . "../../../../images/bikephoto/" . $filename3);
                echo "Your file was uploaded successfully.";
    
        } 
        else
        {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } 
    else {
        $filename3 = $pimage3;
    }
	
	if($vehicle_type>2) {
		if($vehicle_type=='3'){ $due_amt_per_month=$days; } 
		if($vehicle_type=='4'){ $due_amt_per_month=$weeks; } 
		if($vehicle_type=='5'){ $due_amt_per_month=$months; } 
	}
	

	$pimage4 = getcustomer('applicant_proof', $_REQUEST['banid']);
    if(isset($_FILES["applicant_proof"]) && $_FILES["applicant_proof"]["error"] == 0)
    {
        $allowed4 = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename4 = time().str_replace(' ','-',$_FILES["applicant_proof"]["name"]);
        $filetype4 = $_FILES["applicant_proof"]["type"];
        $filesize4 = $_FILES["applicant_proof"]["size"];
        $ext4 = pathinfo($filename4, PATHINFO_EXTENSION);
        if(!array_key_exists($ext4, $allowed4)) die("Error: Please select a valid file format.");
        $maxsize4= 5 * 1024 * 1024;
        if($filesize4 > $maxsize4) die("Error: File size is larger than the allowed limit.");
        if(in_array($filetype4, $allowed4))
        {
                move_uploaded_file($_FILES["applicant_proof"]["tmp_name"], $filename4 . "../../../../images/applicant_proof/" . $filename4);
                echo "Your file was uploaded successfully.";
    
        } 
        else
        {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } 
    else {
        $filename4 = $pimage4;
    }
	
  $msg = addcustomer($filename4,$applicant_name,$applicant_no,$applicant_prooftype,$applicant_address,$insurance_type,$filename11,$interest_percentage,$having_insurance,$insurance_name,$insurance_amount,$filename1,$filename2,$filename3,$name,$emailid,$mobileno,$alt_mobileno,$vehicle_type,$vehicle_name,$vehicle_model,$loan_amount,$noof_owners,$ins_expiry_date,$noof_month_due,$due_amt_per_month,$proof_type,$proof_details,$address,$status,$getid);
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
                        <a href="<?php echo $sitename; ?>master/customers.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Customer</h4>
                    <ol class="breadcrumb">
                      
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Customer</li>
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
                            <label>Customer Name<span style="color:#FF0000;"> *</span></label>
                           <input type="text" required="required" name="name" placeholder="Enter Name"  id="brand_name" class="form-control" value="<?php echo getcustomer('name',$_REQUEST['banid']);?>">
                            
                            
                          </div>
						  <div class="col-md-6">
                            <label>Emailid</label>
                           <input type="email" name="emailid" placeholder="Enter Emailid"  id="brand_name" class="form-control" value="<?php echo getcustomer('emailid',$_REQUEST['banid']);?>">
                            
                            
                          </div>
						  </div>
						  <br>
						 
						
						  <div class="row">
						  <div class="col-md-6">
                            <label>Customer Mobileno<span style="color:#FF0000;"> *</span></label>
                           <input type="number" required="required" name="mobileno" placeholder="Enter Mobileno"  id="brand_name" class="form-control"  value="<?php echo getcustomer('mobileno',$_REQUEST['banid']);?>">
                           </div>
						    <div class="col-md-6">
                            <label>Customer Alternative Mobileno</label>
                           <input type="number" name="alt_mobileno" placeholder="Enter Alternative Mobileno"  id="brand_name" class="form-control"  value="<?php echo getcustomer('alt_mobileno',$_REQUEST['banid']);?>">
                           </div>
						    
						    </div>
							<br>
							<div class="row">
						  <div class="col-md-6">
                            <label>Loan Type<span style="color:#FF0000;"> *</span></label>
                         <select name="vehicle_type" required="required" class="form-control" onchange="getvehicle(this.value);">
							<option value="">Select</option>
							<option value="1" <?php if(getcustomer('vehicle_type', $_REQUEST['banid'])=='1') { ?> selected="selected" <?php } ?>>Bike Loan</option>
							<option value="2" <?php if(getcustomer('vehicle_type', $_REQUEST['banid'])=='2') { ?> selected="selected" <?php } ?>>Car Loan</option>
							<option value="3" <?php if(getcustomer('vehicle_type', $_REQUEST['banid'])=='3') { ?> selected="selected" <?php } ?>>Daily Loan</option>
							<option value="4" <?php if(getcustomer('vehicle_type', $_REQUEST['banid'])=='4') { ?> selected="selected" <?php } ?>>Weekly Loan</option>
							<option value="5" <?php if(getcustomer('vehicle_type', $_REQUEST['banid'])=='5') { ?> selected="selected" <?php } ?>>Monthly Loan</option>
							</select>
                           </div>
						     <div class="col-md-6">
                            <label>No of Owners<span style="color:#FF0000;"> *</span></label>
                           <input type="number" required="required" name="noof_owners" placeholder="Enter No of Owners" value="<?php echo getcustomer('noof_owners',$_REQUEST['banid']);?>" id="brand_name" class="form-control">
                           </div>
						    
						    </div>
							<br>
							
							<div class="row" >
							<div class="col-md-6" <?php if(getcustomer('vehicle_type', $_REQUEST['banid'])=='1' || getcustomer('vehicle_type', $_REQUEST['banid'])=='2') { ?>  style="display:block;" <?php } else { ?>  style="display:none;" <?php } ?> id="loansec1">
                            <label>Vehicle Name
							</label>
                         <select name="vehicle_name" id="vehicle_name" class="form-control" onchange="getmodel(this.value);">
							<option value="">Select</option>
							<?php
							if(getmodel('vehicle_type', $_REQUEST['banid'])!='') {
							$vehitype=getmodel('vehicle_type', $_REQUEST['banid']);
			   $sel = pFETCH("SELECT * FROM `bike` WHERE `status`=? AND `vehicle_type`=? ", 1,$vehitype);
               while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
							?>
							<option value="<?php echo $fdepart['id']; ?>" <?php if(getcustomer('vehicle_name', $_REQUEST['banid'])==$fdepart['id']) { ?> selected="selected" <?php } ?>><?php echo $fdepart['bike_name']; ?></option>
			   <?php } } ?>
							</select>
							
                           </div>
						    
						 <div class="col-md-6" <?php if(getcustomer('vehicle_type', $_REQUEST['banid'])=='1' || getcustomer('vehicle_type', $_REQUEST['banid'])=='2') { ?>  style="display:block;" <?php } else { ?>  style="display:none;" <?php } ?> id="loansec2">
                            <label>Year of Model</label>
							<select name="vehicle_model" id="vehicle_model" class="form-control">
							<option value="">Select</option>
							<?php
							if(getmodel('vehicle_type', $_REQUEST['banid'])!='') {
			   $vehitype=getmodel('vehicle_type', $_REQUEST['banid']);
			   $sel = pFETCH("SELECT * FROM `model` WHERE `status`=? AND `bike_name`=? ", 1,$vehitype);
               while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
							?>
							<option value="<?php echo $fdepart['id']; ?>" <?php if(getcustomer('vehicle_name', $_REQUEST['banid'])==$fdepart['id']) { ?> selected="selected" <?php } ?>><?php echo $fdepart['bike_name']; ?></option>
							<?php } } ?>
							</select>
							
							
                           </div>
						   
						   </div>
						   <br>
						   <div class="row">
						   <div class="col-md-6">
							<label>Proof<span style="color:#FF0000;"> *</span></label>
							<select name="proof_type" required="required" class="form-control">
							<option value="">Select</option>
							<?php
							 $sel = pFETCH("SELECT * FROM `proof` WHERE `status`=?", 1);
                             while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
							?>
							<option value="<?php echo $fdepart['id']; ?>" <?php if(getcustomer('proof_type', $_REQUEST['banid'])==$fdepart['id']) { ?> selected="selected" <?php } ?>><?php echo $fdepart['proof_name']; ?></option>
			   <?php } ?>
							</select>
							</div>
						   
						    </div>
							<br>
							
							     <div class="row">
                           <div class="col-md-6">
                            <label>Proof Photo <span style="color:#FF0000;"> *(Recommended Size 600 Pixels Width and 600 Pixels Height)</span></label>
                           <input  type="file" value="<?php echo getcustomer('proof', $_REQUEST['banid']); ?>" <?php if(getcustomer('proof', $_REQUEST['banid'])=='') { ?> required="required" <?php } ?> name="proof" class="form-control" >

                       </div>
              
                   <?php if (getcustomer('proof', $_REQUEST['banid']) != '') { ?>
                    <div class="col-md-6 col-sm-6 col-xs-12" id="delimage">
                    <label> </label>
                    <img src="<?php echo $fsitename; ?>images/proof/<?php echo getcustomer('proof', $_REQUEST['banid']); ?>" style="padding-bottom:10px;" height="100" />
                    <button type="button" style="cursor:pointer;" class="btn btn-danger" name="del" id="del" onclick="javascript:deleteimage('<?php echo getcustomer('proof', $_REQUEST['banid']); ?>', '<?php echo $_REQUEST['banid']; ?>', 'customer', '../images/proof/', 'proof', 'id');"><i class="fa fa-close">&nbsp;Delete Image</i></button>
                    </div>
                    <?php } ?>
                         </div>
                        <br>
						
							     <div class="row">
                           <div class="col-md-6">
                            <label>Customer Photo <span style="color:#FF0000;"> *(Recommended Size 600 Pixels Width and 600 Pixels Height)</span></label>
                           <input  type="file" value="<?php echo getcustomer('cuphoto', $_REQUEST['banid']); ?>" <?php if(getcustomer('cuphoto', $_REQUEST['banid'])=='') { ?> required="required" <?php } ?> name="cuphoto" class="form-control" >

                       </div>
              
                   <?php if (getcustomer('cuphoto', $_REQUEST['banid']) != '') { ?>
                    <div class="col-md-6 col-sm-6 col-xs-12" id="delimage">
                    <label> </label>
                    <img src="<?php echo $fsitename; ?>images/cuphoto/<?php echo getcustomer('cuphoto', $_REQUEST['banid']); ?>" style="padding-bottom:10px;" height="100" />
                    <button type="button" style="cursor:pointer;" class="btn btn-danger" name="del" id="del" onclick="javascript:deleteimage('<?php echo getcustomer('cuphoto', $_REQUEST['banid']); ?>', '<?php echo $_REQUEST['banid']; ?>', 'customer', '../images/cuphoto/', 'cuphoto', 'id');"><i class="fa fa-close">&nbsp;Delete Image</i></button>
                    </div>
                    <?php } ?>
                         </div>
                        <br>
					<div class="row">
                           <div class="col-md-6">
                            <label>Bike Photo <span style="color:#FF0000;"> *(Recommended Size 600 Pixels Width and 600 Pixels Height)</span></label>
                           <input  type="file" value="<?php echo getcustomer('bikephoto', $_REQUEST['banid']); ?>" <?php if(getcustomer('bikephoto', $_REQUEST['banid'])=='') { ?> required="required" <?php } ?> name="bikephoto" class="form-control" >

                       </div>
              
                   <?php if (getcustomer('bikephoto', $_REQUEST['banid']) != '') { ?>
                    <div class="col-md-6 col-sm-6 col-xs-12" id="delimage">
                    <label> </label>
                    <img src="<?php echo $fsitename; ?>images/bikephoto/<?php echo getcustomer('bikephoto', $_REQUEST['banid']); ?>" style="padding-bottom:10px;" height="100" />
                    <button type="button" style="cursor:pointer;" class="btn btn-danger" name="del" id="del" onclick="javascript:deleteimage('<?php echo getcustomer('bikephoto', $_REQUEST['banid']); ?>', '<?php echo $_REQUEST['banid']; ?>', 'customer', '../images/bikephoto/', 'bikephoto', 'id');"><i class="fa fa-close">&nbsp;Delete Image</i></button>
                    </div>
                    <?php } ?>
                         </div>
                        <br>	
						
                            <div class="row">
							<div class="col-md-6">
                            <label>Proof Details<span style="color:#FF0000;"> *</span></label>
<textarea name="proof_details" class="form-control" required="required"><?php echo getcustomer('proof_details', $_REQUEST['banid']); ?></textarea>                          
				 </div>
							<div class="col-md-6">
                            <label>Address<span style="color:#FF0000;"> *</span></label>
<textarea name="address" class="form-control" required="required"><?php echo getcustomer('address', $_REQUEST['banid']); ?></textarea>                          
				 </div>
				 </div>
					  <br>
						  <div class="row">
                                                <div class="col-md-12"> 
												<div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="panel-title">Insurance Details</div>
                                                        </div>
                                                        <div class="panel-body">
														<div class="row">
														  <div class="col-md-6">
                            <label>Having Insurance ? <span style="color:#FF0000;"> *</span></label>
							<select name="having_insurance" class="form-control" required="required" onchange="getins(this.value);">
							<option value="">Select</option>
							<option value="1" <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='1') { ?> selected="selected" <?php } ?>>Yes</option>
							<option value="0" <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='0') { ?> selected="selected" <?php } ?>>No</option>
							</select>
						    </div>
							
							<div class="col-md-6"  <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='1') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?> id="ins1">
                            <label>Insurance Expiry Date <span style="color:#FF0000;"> *</span></label>
                           <input type="date"  name="ins_expiry_date" placeholder="Select Expiry Date" value="<?php echo getcustomer('ins_expiry_date',$_REQUEST['banid']);?>" id="ins_expiry_date" class="form-control">
                           </div>
														</div>
													<br>
                        <div class="row" <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='1') { ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?> id="insur1">
<div class="col-md-6">
<label>Insurance Proof Type</label>
<select name="insurance_type" class="form-control">
<option value="">Select</option>
<?php
$sel = pFETCH("SELECT * FROM `proof` WHERE `status`=?", 1);
while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
?>
<option value="<?php echo $fdepart['id']; ?>" <?php if(getcustomer('insurance_type', $_REQUEST['banid'])==$fdepart['id']) { ?> selected="selected" <?php } ?>><?php echo $fdepart['proof_name']; ?></option>
<?php } ?>
							</select>
</div>

</div>						
<br>
		     <div class="row" <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='1') { ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?> id="insur2">
                           <div class="col-md-6">
                            <label>Insurance Proof Photo</label>
                           <input  type="file" value="<?php echo getcustomer('insurance_proof', $_REQUEST['banid']); ?>" <?php if(getcustomer('insurance_proof', $_REQUEST['banid'])=='') { ?> required="required" <?php } ?> name="insurance_proof" class="form-control" >

                       </div>
              
                   <?php if (getcustomer('insurance_proof', $_REQUEST['banid']) != '') { ?>
                    <div class="col-md-6 col-sm-6 col-xs-12" id="delimage">
                    <label> </label>
                    <img src="<?php echo $fsitename; ?>images/insurance_proof/<?php echo getcustomer('insurance_proof', $_REQUEST['banid']); ?>" style="padding-bottom:10px;" height="100" />
                    <button type="button" style="cursor:pointer;" class="btn btn-danger" name="del" id="del" onclick="javascript:deleteimage('<?php echo getcustomer('insurance_proof', $_REQUEST['banid']); ?>', '<?php echo $_REQUEST['banid']; ?>', 'customer', '../images/insurance_proof/', 'insurance_proof', 'id');"><i class="fa fa-close">&nbsp;Delete Image</i></button>
                    </div>
                    <?php } ?>
                         </div>
                        <br>
						
						

							<div class="row" >
										<div class="col-md-6" <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='0') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?> id="ins2">
                            <label>Name of the Insurance<span style="color:#FF0000;"> *</span></label>
                           <input type="text" name="insurance_name" placeholder="Enter Insurance Name" value="<?php echo getcustomer('insurance_name',$_REQUEST['banid']);?>" id="insurance_name" class="form-control">
                           </div>
									<div class="col-md-6" <?php if(getcustomer('having_insurance',$_REQUEST['banid'])=='0') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?> id="ins3">
                            <label>Insurance Amount<span style="color:#FF0000;"> *</span></label>
                           <input type="text" name="insurance_amount" placeholder="Enter Insurance Amount" value="<?php echo getcustomer('insurance_amount',$_REQUEST['banid']);?>" id="insurance_amount" class="form-control">
                           </div></div>
										</div>				
														</div></div></div>
						  <br>
						   <div class="row">
                                                <div class="col-md-12"> 
												<div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="panel-title">Co-applicant Details</div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="row">   
                                                                <div class="col-md-12">
                                                                   
																	<div class="row">
																	<div class="col-md-6">
																	<label>Co Applicant Name<span style="color:#FF0000;"> *</span></label>
                           <input type="text" name="applicant_name" placeholder="Enter Name" value="<?php echo getcustomer('applicant_name',$_REQUEST['banid']);?>" id="insurance_amount" class="form-control">																
																	</div>
																	<div class="col-md-6">
																	<label>Co Applicant Contact No<span style="color:#FF0000;"> *</span></label>
                           <input type="text" name="applicant_no" placeholder="Enter Name" value="<?php echo getcustomer('applicant_no',$_REQUEST['banid']);?>" id="insurance_amount" class="form-control">																
																	</div>
																	</div>
						<br>
						<div class="row">
																	<div class="col-md-6">
																	<label>Co Applicant Proof Type<span style="color:#FF0000;"> *</span></label>
                         <select name="applicant_prooftype[]" class="form-control">
<option value="">Select</option>
<?php
							 $sel = pFETCH("SELECT * FROM `proof` WHERE `status`=?", 1);
                             while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
							?>
							<option value="<?php echo $fdepart['id']; ?>" <?php if($coapplicantlist['prooftype']==$fdepart['id']) { ?> selected="selected" <?php } ?>><?php echo $fdepart['proof_name']; ?></option>
			   <?php } ?>
</select>

																	</div>
																	<div class="col-md-6">
																	<label>Co Applicant Proof <span style="color:#FF0000;"> *</span></label>
                          <input type="file" name="applicant_proof" class="form-control">
						  
						  </div>
																	</div>  <br>             <div class="row">
																	<div class="col-md-6"><label>Co Applicant Address <span style="color:#FF0000;"> *</span></label>
<textarea name="applicant_address" class="form-control"><?php echo $coapplicantlist['applicant_address']; ?></textarea>                         </div>

</div>
																	</div>                                   
                                                              
															  </div>   </div>
                                                            </div>

                                                        </div></div>
                                              
  <br>  
   <div class="row">
						  <div class="col-md-6">
                            <label>Loan Amount<span style="color:#FF0000;"> *</span></label>
                           <input type="text" required="required" name="loan_amount" placeholder="Enter Loan Amount"  value="<?php echo getcustomer('loan_amount',$_REQUEST['banid']);?>" id="brand_name" class="form-control">
                           </div>
						   
						     <div class="col-md-6">
                            <label>Interest Percentage<span style="color:#FF0000;"> *</span></label>
                         <input type="text" name="interest_percentage" class="form-control" required="required" placeholder="Enter the Interest Percentage" value="<?php echo getcustomer('interest_percentage', $_REQUEST['banid']); ?>">
                         
						  
                          </div>
						  <div class="col-md-6" <?php if(getcustomer('vehicle_type',$_REQUEST['banid'])=='3') { ?>style="display:block;" <?php } else { ?> style="display:none;" <?php } ?> id="dailysec1">
                            <label>No of Days</label>
                         <input type="text" name="days" class="form-control" placeholder="Enter the No of Days" value="<?php echo getcustomer('due_amt_per_month', $_REQUEST['banid']); ?>">
                         
						  
                          </div>
						   <div class="col-md-6" <?php if(getcustomer('vehicle_type',$_REQUEST['banid'])=='4') { ?>style="display:block;" <?php } else { ?> style="display:none;" <?php } ?> id="weeklysec1">
                            <label>No of Weeks</label>
                         <input type="text" name="weeks" class="form-control" placeholder="Enter the No of Weeks" value="<?php echo getcustomer('due_amt_per_month', $_REQUEST['banid']); ?>">
                         
						  
                          </div>
						  </div>
						  <br>
						  <div class="row">
						   <div class="col-md-6" <?php if(getcustomer('vehicle_type',$_REQUEST['banid'])=='5') { ?>style="display:block;" <?php } else { ?> style="display:none;" <?php } ?> id="monthlysec1">
                            <label>No of Months</label>
                         <input type="text" name="months" class="form-control" placeholder="Enter the No of Months" value="<?php echo getcustomer('due_amt_per_month', $_REQUEST['banid']); ?>">
                         
						  
                          </div>
						    </div>
							<br>
							<div class="row">
						  <div class="col-md-6" <?php if(getcustomer('vehicle_type',$_REQUEST['banid'])=='1' || getcustomer('vehicle_type',$_REQUEST['banid'])=='2') { ?>style="display:block;" <?php } else { ?> style="display:none;" <?php } ?> id="bikesec2">
                            <label>No of Month Due</label>
                           <input type="number"  name="noof_month_due" placeholder="Enter No of Month Due"  value="<?php echo getcustomer('noof_month_due',$_REQUEST['banid']);?>" id="brand_name" class="form-control">
                           </div>
						      <div class="col-md-6" <?php if(getcustomer('vehicle_type',$_REQUEST['banid'])=='1' || getcustomer('vehicle_type',$_REQUEST['banid'])=='2') { ?>style="display:block;" <?php } else { ?> style="display:none;" <?php } ?> id="bikesec3">
                            <label>Due Amount Per Month </label>
                           <input type="text" name="due_amt_per_month" placeholder="Enter Due Amount Per Month"  id="brand_name" class="form-control" value="<?php echo getcustomer('due_amt_per_month',$_REQUEST['banid']);?>">
                           </div>
						   	
               
						    </div>
							 <br>  
				 <div class="row">
						  <div class="col-md-6">
                            <label>Status</label>
                          
                          <select name="status" class="form-control">
                         <option value="1" <?php if(getcustomer('status', $_REQUEST['banid'])=='1') { ?> selected="selected" <?php } ?>>Active</option>      
                         <option value="0" <?php if(getcustomer('status', $_REQUEST['banid'])=='0') { ?> selected="selected" <?php } ?>>Inactive</option>      
                          </select></div>
						
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
                            <a href="<?php echo $sitename; ?>master/customers.htm">Back to Listings page</a>
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
<script type="text/javascript">
function getmodel(a){
	$.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {vehiclename: a},
            success: function (data) {
              $("#vehicle_model").html(data);
            }
        });
}
 function getvehicle(a)
    {
		if(a=='1' || a=='2'){
			$("#bikesec2").css("display", "block");
			$("#bikesec3").css("display", "block");
			$("#dailysec1").css("display", "none");
			$("#weeklysec1").css("display", "none");
			$("#monthlysec1").css("display", "none");
			$("#loansec1").css("display", "block");
			$("#loansec2").css("display", "block");
		}
		else if(a==3) {
			$("#loansec1").css("display", "none");
			$("#loansec2").css("display", "none");
			$("#bikesec2").css("display", "none");
			$("#bikesec3").css("display", "none");
			$("#dailysec1").css("display", "block");
			$("#weeklysec1").css("display", "none");
			$("#monthlysec1").css("display", "none");
		}
		else if(a==4) {
			$("#loansec1").css("display", "none");
			$("#loansec2").css("display", "none");
			$("#bikesec2").css("display", "none");
			$("#bikesec3").css("display", "none");
			$("#dailysec1").css("display", "none");
			$("#weeklysec1").css("display", "block");
			$("#monthlysec1").css("display", "none");
		}
		else
		{
			$("#loansec1").css("display", "none");
			$("#loansec2").css("display", "none");
			$("#bikesec2").css("display", "none");
			$("#bikesec3").css("display", "none");
			$("#dailysec1").css("display", "none");
			$("#weeklysec1").css("display", "none");
			$("#monthlysec1").css("display", "block");
		}
		$.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {vehicletype: a},
            success: function (data) {
              $("#vehicle_name").html(data);
            }
        });
    }
	
    function delrec(elem, id) {
        if (confirm("Are you sure want to delete this Details?")) {
            $(elem).parent().remove();
            window.location.href = "<?php echo $sitename; ?>master/<?php echo $_REQUEST['pid']; ?>/editproduct.htm?delid=" + id;
        }
    }

    function delrec1(elem, id) {
        if (confirm("Are you sure want to delete this Details?")) {
            $(elem).parent().remove();
            window.location.href = "<?php echo $sitename; ?>master/<?php echo $_REQUEST['banid']; ?>/editcustomer.htm?delid1=" + id;
        }
    }


    $(document).ready(function (e) {

        $('#add_task').click(function () {


            var data = $('#firsttasktr').clone();
            var rem_td = $('<td />').html('<i class="fa fa-trash fa-2x" style="color:#F00;cursor:pointer;"></i>').click(function () {
                if (confirm("Do you want to delete the Details?")) {
                    $(this).parent().remove();
                    re_assing_serial();

                }
            });
            $(data).attr('id', '').show().append(rem_td);
            $(data).find('td').each(function (e) {
                $(this).find('input[name="appname[]"]').val('');
                $(this).find('input[name="appmobile[]"]').val('');
                $(this).find('textarea[name="appaddress[]"]').val('');
            });
            data = $(data);
            $('#task_table tbody').append(data);
             var tbl = $('#task_table tbody');
              tbl.find('tr').each(function () {
        $(this).find('input[type=text]').bind("keyup", function () {
            calculateSum();
        });
            
 });
            re_assing_serial();

        });

     $('#add_task1').click(function () {


            var data = $('#firsttasktr1').clone();
            var rem_td = $('<td />').html('<i class="fa fa-trash fa-2x" style="color:#F00;cursor:pointer;"></i>').click(function () {
                if (confirm("Do you want to delete the Details?")) {
                    $(this).parent().remove();
                    re_assing_serial1();

                }
            });
            $(data).attr('id', '').show().append(rem_td);
            $(data).find('td').each(function (e) {
                 $(this).find('input[name="appname[]"]').val('');
                $(this).find('input[name="appmobile[]"]').val('');
                $(this).find('textarea[name="appaddress[]"]').val('');
            });
            data = $(data);
            $('#task_table1 tbody').append(data);
             var tbl = $('#task_table1 tbody');
              tbl.find('tr').each(function () {
        $(this).find('input[type=text]').bind("keyup", function () {
            calculateSum();
        });
            
 });
            re_assing_serial1();

        });


    });

 
    function del_addi(elem) {
        if (confirm("Are you sure want to remove this?")) {
            elem.parent().parent().remove();
            additionalprice();
        }
    }

 function del_addi1(elem) {
        if (confirm("Are you sure want to remove this?")) {
            elem.parent().parent().remove();
            additionalprice();
        }
    }
	
    function re_assing_serial() {
        $("#task_table tbody tr").not('#firsttasktr').each(function (i, e) {
            //$(this).find('td').eq(0).html(i + 1+1);
        });
        $("#worker_table tbody tr").not('#firstworkertr').each(function (i, e) {
            $(this).find('td').eq(0).html(i + 1);
        });
    }

 function re_assing_serial1() {
        $("#task_table1 tbody tr").not('#firsttasktr1').each(function (i, e) {
            //$(this).find('td').eq(0).html(i + 1+1);
        });
        $("#worker_table1 tbody tr").not('#firstworkertr1').each(function (i, e) {
            $(this).find('td').eq(0).html(i + 1);
        });
    }
	function getins(a){
		if(a==1)
		{
		$("#ins1").css("display", "block");
			$("#insur1").css("display", "block");
			$("#insur2").css("display", "block");
		$("#ins_expiry_date").prop('required',true);
	
$("#insurance_name").prop('required',false);
$("#insurance_amount").prop('required',false);
$("#ins2").css("display", "none");
$("#ins3").css("display", "none");	
		}
		else{
			$("#insur1").css("display", "none");
			$("#insur2").css("display", "none");
			$("#ins2").css("display", "block");
			$("#ins3").css("display", "block");
			$("#insurance_name").attr("required", "true");
$("#insurance_amount").prop('required',true);
$("#ins_expiry_date").prop('required',false);
$("#ins1").css("display", "none");	
		}
	}
</script>
