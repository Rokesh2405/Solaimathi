<?php
$dynamic = '1';
$menu = '1';
$index='1';
include ('config/config.inc.php');


include ('require/header.php');
//print_r($_SESSION);
$_SESSION['mobileno']='';
unset($_SESSION['mobileno']);

if($_SESSION['highrisk']!='unshow' && isset($_SESSION['doctorid']))
{
  $_SESSION['highrisk']='show';  
}


?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
      
            <div class="row">
                <div class="col-sm-12">
                <h4 class="page-title">Dashboard</h4>
                    <p class="text-muted page-title-alt">Welcome to <?php echo getusers('name',$_SESSION['GRUID']); ?>!</p>
                </div>
            </div>
			<?php if($_SESSION['FUID']=='1') { ?>
			<div class="row">
			        <div class="col-md-6 col-lg-6 col-xl-4">
             
                   <a href="<?php echo $sitename; ?>master/customers.htm">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-purple pull-left">
                            <i class="md-group-add text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                               <?php
                             $stmt = $db->prepare("SELECT * FROM `customer` ");
                               
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?> 
                                            
                                </span></h3>
                            <p class="text-muted mb-0">No of Customers</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
					</a>
              
                </div>
				
        	 
				           <div class="col-md-6 col-lg-6 col-xl-4">
             
                    <a href="<?php echo $sitename; ?>master/proof.htm">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-danger pull-left">
                            <i class="fa fa-id-card-o text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                               <?php
                             $stmt = $db->prepare("SELECT * FROM `proof` WHERE `id`!='0'");
                               
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?> 
                                            
                                </span></h3>
                            <p class="text-muted mb-0">No of Proofs</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
              </a>
                </div>

     <div class="col-md-6 col-lg-6 col-xl-4">
             
                         <a href="<?php echo $sitename; ?>master/bikes.htm">
                             
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-pink pull-left">
                            <i class="fa fa-motorcycle text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                                 <?php
                             $stmt = $db->prepare("SELECT * FROM `bike` WHERE `id`!='0'");
                                  
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?> 
                                            
                                </span></h3>
                            <p class="text-muted mb-0">No of Vehicles</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
	
</div>	
		
<div class="row">
       <div class="col-md-6 col-lg-6 col-xl-4">
             
                   <a href="<?php echo $sitename;?>master/models.htm">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-warning pull-left">
                            <i class="fa fa-life-ring text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                               <?php
                             $stmt = $db->prepare("SELECT * FROM `model` WHERE `id`!='0'");
                                  
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?> 
                                            
                                </span></h3>
                            <p class="text-muted mb-0">No of Models</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
              </a>
                </div>
          <div class="col-md-6 col-lg-6 col-xl-4">
                     <a href="<?php echo $sitename; ?>master/subusers.htm">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-info pull-left">
                            <i class="typcn typcn-user-add text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                               <?php
                             $stmt = $db->prepare("SELECT * FROM `subuser` WHERE `id`!='0'");
                                  
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?> 
                                            
                                </span></h3>
                            <p class="text-muted mb-0">No of Subusers</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
           <div class="col-md-6 col-lg-6 col-xl-4">
                     <a href="<?php echo $sitename; ?>master/expense.htm">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-purple pull-left">
                            <i class="fa fa-money text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                               <?php
                             $stmt = $db->prepare("SELECT * FROM `expense` WHERE `id`!='0'");
                                  
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?>      
                                </span></h3>
                            <p class="text-muted mb-0">No of Expenses</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                                     
</div>
			<?php } else { ?>
		<div class="row">
       <div class="col-md-4 col-lg-4 col-xl-4">
             
                   <a href="<?php echo $sitename;?>master/models.htm">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-warning pull-left">
                            <i class="fa fa-life-ring text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                               <?php
                             $stmt = $db->prepare("SELECT * FROM `model` WHERE `id`!='0'");
                                  
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?> 
                                            
                                </span></h3>
                            <p class="text-muted mb-0">Today Collections</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
              </a>
                </div>
          <div class="col-md-4 col-lg-4 col-xl-4">
                     <a href="<?php echo $sitename; ?>master/subusers.htm">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-info pull-left">
                            <i class="typcn typcn-user-add text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                               <?php
                             $stmt = $db->prepare("SELECT * FROM `subuser` WHERE `id`!='0'");
                                  
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?> 
                                            
                                </span></h3>
                            <p class="text-muted mb-0">Today Daily Collections</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
           <div class="col-md-4 col-lg-4 col-xl-4">
                     <a href="<?php echo $sitename; ?>master/expense.htm">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-purple pull-left">
                            <i class="fa fa-money text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                               <?php
                             $stmt = $db->prepare("SELECT * FROM `expense` WHERE `id`!='0'");
                                  
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?>      
                                </span></h3>
                            <p class="text-muted mb-0">Today Weekly Collections</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
                                     
</div>
	<div class="row">
       <div class="col-md-4 col-lg-4 col-xl-4">
             
                   <a href="<?php echo $sitename;?>master/models.htm">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-warning pull-left">
                            <i class="fa fa-life-ring text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                               <?php
                             $stmt = $db->prepare("SELECT * FROM `model` WHERE `id`!='0'");
                                  
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?> 
                                            
                                </span></h3>
                            <p class="text-muted mb-0">Today Monthly Collections</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
              </a>
                </div>
          <div class="col-md-4 col-lg-4 col-xl-4">
                     <a href="<?php echo $sitename; ?>master/subusers.htm">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-info pull-left">
                            <i class="typcn typcn-user-add text-white"></i>
                        </div>
                        <div class="text-right">
                                    <h3 class="text-dark"><span class="counter">
                               <?php
                             $stmt = $db->prepare("SELECT * FROM `subuser` WHERE `id`!='0'");
                                  
                           $stmt->execute();
                           echo $sel = $stmt->rowCount();
                                ?> 
                                            
                                </span></h3>
                            <p class="text-muted mb-0">Today Loan Collections</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </a>
                </div>
         
		 </div>
			<?php } ?>
	<?php include 'require/footer.php'; ?>      