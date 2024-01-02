<?php
include '../config/config.inc.php';
if($_SESSION['GRUID'] != '') {
    header("location:../submission.htm");
    exit;
}
$msg='';
if (isset($_REQUEST['logsubmit'])) {
    @extract($_REQUEST);
  $ip = $_SERVER['REMOTE_ADDR'];
  if($password==$cpassword) {
    $msg = adduser($username, $emailid, $password, $mobileno,$ip);
  }
  else
  {
 $msg = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><h4>Password could not be same.</h4></div>';	
		
  }
  
}
?>
 
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo $fsitename; ?>img/adminlogo.png">

        <title>Register</title>

        <link href="<?php echo $sitename; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sitename; ?>assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo $sitename; ?>assets/js/modernizr.min.js"></script>
        
    </head>
    <body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
   <div class="wrapper-page">
			<div class="card-box">
				<div class="panel-heading">
					<h3 class="text-center"> Sign Up </h3>
				</div>

				<div class="p-20">
				<?php echo $msg;  ?>
					<form class="form-horizontal m-t-20" name="regform" id="regform" method="POST">

						<div class="form-group ">
							<div class="col-12">
								<input class="form-control" type="email" required="required" placeholder="Email" name="emailid" >
							</div>
						</div>
<div class="form-group ">
							<div class="col-12">
								<input class="form-control" type="number" required="required" placeholder="Mobileno" name="mobileno">
							</div>
						</div>
						<div class="form-group ">
							<div class="col-12">
								<input class="form-control" type="text" required="required" placeholder="Username" name="username">
							</div>
						</div>

						<div class="form-group">
							<div class="col-12">
								<input class="form-control" type="password" required="required" placeholder="Password" name="password">
							</div>
						</div>
<div class="form-group">
							<div class="col-12">
								<input class="form-control" type="password" required="required" placeholder="Confirm Password" name="cpassword">
							</div>
						</div>

						<div class="form-group text-center m-t-40">
							<div class="col-12">
								  <button class="btn btn-success btn-block text-uppercase waves-effect waves-light"
                                    type="submit" name="logsubmit" id="logsubmit"  style="background-color:#1a84e6 !important;">Register
                            </button>
							</div>
						</div>

					</form>

				</div>
			</div>

			<div class="row">
				<div class="col-12 text-center">
					<p>
						Already have account?<a href="<?php echo $fsitename; ?>pages/login.php" class="text-primary m-l-5"><b>Sign In</b></a>
					</p>
				</div>
			</div>

		</div>
       
        <script>
            var resizefunc = [];
           
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
$(function() {
setTimeout(function() { $("#hideDiv").fadeOut(1500); }, 5000)

})
        </script>    

        <!-- jQuery  -->
        <script src="<?php echo $sitename; ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="<?php echo $sitename; ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/detect.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/fastclick.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/waves.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/wow.min.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/jquery.scrollTo.min.js"></script>

        <script src="<?php echo $sitename; ?>assets/js/jquery.core.js"></script>
        <script src="<?php echo $sitename; ?>assets/js/jquery.app.js"></script>
	
	</body>
</html>