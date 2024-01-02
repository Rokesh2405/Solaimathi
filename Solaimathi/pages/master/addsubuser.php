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
    
  $msg = addsubuser($name,$emailid,$mobileno,$address,$username,$password,$status,$getid);
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
                        <a href="<?php echo $sitename; ?>master/subusers.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Subuser</h4>
                    <ol class="breadcrumb">
                      
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Subuser</li>
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
                            <label>Subuser Name<span style="color:#FF0000;"> *</span></label>
                           <input type="text" required="required" name="name" placeholder="Enter Name"  id="brand_name" class="form-control" value="<?php echo getsubuser('name',$_REQUEST['banid']); ?>">
                            
                            
                          </div>
						  <div class="col-md-6">
                            <label>Emailid</label>
                           <input type="email" name="emailid" placeholder="Enter Emailid"  id="brand_name" class="form-control" value="<?php echo getsubuser('emailid',$_REQUEST['banid']); ?>">
                            
                            
                          </div>
						  </div>
						  <br>
						    <div class="row">
                              
						  <div class="col-md-6">
                            <label>Username<span style="color:#FF0000;"> *</span></label>
                           <input type="text" required="required" name="username" placeholder="Enter Username"  id="brand_name" class="form-control" value="<?php echo getsubuser('username',$_REQUEST['banid']); ?>">
                            
                            
                          </div>
						  <div class="col-md-6">
                            <label>Password<span style="color:#FF0000;"> *</span></label>
                           <input type="text" required="required" name="password" placeholder="Enter Password" value="<?php echo getsubuser('password',$_REQUEST['banid']); ?>" id="brand_name" class="form-control" >
                            
                            
                          </div>
						  </div>
						  <br>
						  
						  <div class="row">
						  <div class="col-md-6">
						  
						  <div class="row">
						  <div class="col-md-12">
                            <label>Mobileno<span style="color:#FF0000;"> *</span></label>
                           <input type="number" required="required" name="mobileno" placeholder="Enter Mobileno" value="<?php echo getsubuser('mobileno',$_REQUEST['banid']); ?>" id="brand_name" class="form-control">
                           </div>
						    </div>
							<br>
                            <div class="row">
						  <div class="col-md-12">
                            <label>Status</label>
                          
                          <select name="status" class="form-control">
                         <option value="1" <?php if(getsubuser('status',$_REQUEST['banid'])=='1') { ?> selected="selected" <?php  } ?>>Active</option>      
                         <option value="0" <?php if(getsubuser('status',$_REQUEST['banid'])=='0') { ?> selected="selected" <?php  } ?>>Inactive</option>      
                          </select></div>
						    </div>
                          </div>
						  <div class="col-md-6">
                            <label>Address<span style="color:#FF0000;"> *</span></label>
<textarea name="address" class="form-control" required="required"><?php echo getsubuser('address',$_REQUEST['banid']); ?></textarea>                          
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
                            <a href="<?php echo $sitename; ?>master/subusers.htm">Back to Listings page</a>
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
