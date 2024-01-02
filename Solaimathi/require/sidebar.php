<?php
$loginaccess2 = $db->prepare("SELECT * FROM `users` WHERE `orgpassword` = ? AND `id`=? ");
$loginaccess2->execute(array($_SESSION['Gpassword'], $_SESSION['GRUID']));
$loginaccess2 = $loginaccess2->fetch();
if ($loginaccess2['id'] == '') {
    logout();
    session_destroy();
    session_unset();
    header("location:https://ttbilling.in/solaimathi/pages/");
}
?>

<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu" <?php  if(getusers('mainadmin',$_SESSION['GRUID'])=='0') { ?>  style="padding-bottom:0px;" <?php } ?>>
            <ul>

                <li class="has_sub">
                    <a href="<?php echo $sitename; ?>" class="waves-effect subdrop"  <?php if($menu==1) { ?>style="font-weight:bold;" <?php } ?>>
                        <i class=" md-dashboard" <?php if($menu==1) { ?>style="font-weight:bold;" <?php } ?>></i> <span> Dashboard</span> </a>
                </li>
			<?php if($_SESSION['GRUID']=='1') { ?>
							  <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php if($menu==16 || $menu==17) { ?> active subdrop <?php } ?>"><i class=" md-credit-card"></i> <span> Master</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                 <li>
                    <a href="<?php echo $sitename; ?>master/proof.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                       
                       <span>Proofs</span> </a>
                   
                </li>
				<li>
                 <a href="<?php echo $sitename; ?>master/bikes.htm" class="waves-effect subdrop"  <?php if($menu==16) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Vehicle Name</span> </a>
                </li>
                <li>
                 <a href="<?php echo $sitename; ?>master/models.htm" class="waves-effect subdrop"  <?php if($menu==17) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Year of Models</span> </a>
                </li>
				
				 <li>
                    <a href="<?php echo $sitename; ?>master/subusers.htm" class="waves-effect subdrop"  <?php if($menu==3) { ?>style="font-weight:bold;" <?php } ?>>
                       <span> Cash Collection</span> </a>
                   
                </li>
				
			    </ul>
                            </li> 

			
                 <li class="has_sub">
                    <a href="<?php echo $sitename; ?>master/customers.htm" class="waves-effect subdrop"  <?php if($menu==115) { ?>style="font-weight:bold;" <?php } ?>>
                   
                    <i class="fa fa-user text-primary"></i><span> Customers</span> </a>
                   
                </li><?php } ?>
				
				    <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php if($menu==22 || $menu==23) { ?> active subdrop <?php } ?>"><i class=" md-credit-card"></i> <span>Installment</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                
                
				   <li>
                    <a href="<?php echo $sitename; ?>master/daily.htm" class="waves-effect subdrop"  <?php if($menu==23) { ?>style="font-weight:bold;" <?php } ?>>
                       <span> Daily</span> </a>
                   
                </li>
				 <li>
                    <a href="<?php echo $sitename; ?>master/weekly.htm" class="waves-effect subdrop"  <?php if($menu==24) { ?>style="font-weight:bold;" <?php } ?>>
                       <span> Weekly </span> </a>
                   
                </li>
				<li>
                    <a href="<?php echo $sitename; ?>master/monthly.htm" class="waves-effect subdrop"  <?php if($menu==25) { ?>style="font-weight:bold;" <?php } ?>>
                       <span> Monthly </span> </a>
                   
                </li>
                </ul>
                            </li>
           
		   
                          <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php if($menu==22 || $menu==23) { ?> active subdrop <?php } ?>"><i class=" md-credit-card"></i> <span>Loan</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                
                
				   <li>
                    <a href="<?php echo $sitename; ?>master/monthly_loan.htm" class="waves-effect subdrop"  <?php if($menu==23) { ?>style="font-weight:bold;" <?php } ?>>
                       <span> Add Monthly Due</span> </a>
                   
                </li>
                </ul>
                            </li>
           
			
				<?php if($_SESSION['GRUID']=='1') { ?>

           <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php if($menu==16 || $menu==17) { ?> active subdrop <?php } ?>"><i class=" md-credit-card"></i> <span> Account</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                 <li>
                    <a href="<?php echo $sitename; ?>master/ledgername.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                       
                       <span>Ledger Name</span> </a>
                   
                </li>
        <li>
                 <a href="<?php echo $sitename; ?>master/ledgertype.htm" class="waves-effect subdrop"  <?php if($menu==16) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Ledger Type</span> </a>
                </li>
                <li>
                 <a href="<?php echo $sitename; ?>master/opening_balance.htm" class="waves-effect subdrop"  <?php if($menu==17) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Opening Balance</span> </a>
                </li>
        
         <li>
                    <a href="<?php echo $sitename; ?>master/debitlist.htm" class="waves-effect subdrop"  <?php if($menu==3) { ?>style="font-weight:bold;" <?php } ?>>
                       <span> Debit Entry</span> </a>
                   
                </li>
            <li>
                    <a href="<?php echo $sitename; ?>master/creditlist.htm" class="waves-effect subdrop"  <?php if($menu==3) { ?>style="font-weight:bold;" <?php } ?>>
                       <span> Credit Entry</span> </a>
                   
                </li>
          </ul>
                            </li> 

      

				  <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php if($menu==6 || $menu==7 || $menu==8 || $menu==9) { ?> active subdrop <?php } ?>"><i class=" md-credit-card"></i> <span> Expense</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                 <li>
                    <a href="<?php echo $sitename; ?>master/expense_type.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                       
                       <span>Expense Type</span> </a>
                   
                </li>
				<li>
                 <a href="<?php echo $sitename; ?>master/expense.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Expense</span> </a>
                </li>
                
				
			    </ul>
                            </li> 

	  <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php if($menu==6 || $menu==7 || $menu==8 || $menu==9) { ?> active subdrop <?php } ?>"><i class=" md-credit-card"></i> <span> Reports</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                 <li>
                    <a href="<?php echo $sitename; ?>master/expense_report.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                       
                       <span>Expense Report</span> </a>
                   
                </li>
				<li>
                 <a href="<?php echo $sitename; ?>master/loan_report.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Loan Report</span> </a>
                </li>
				<li>
                 <a href="<?php echo $sitename; ?>master/installment_report.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Installment Report</span> </a>
                </li>
				<li>
                 <a href="<?php echo $sitename; ?>master/transaction_report.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Transactions Report</span> </a>
                </li>
                
                <li>
                 <a href="<?php echo $sitename; ?>master/customer_report.htm" class="waves-effect subdrop"  <?php if($menu==6) { ?>style="font-weight:bold;" <?php } ?>>
                        <span>Customer Report</span> </a>
                </li>
                
				
			    </ul>
                            </li> 

				<?php } ?>
                 <li class="has_sub">
                    <a href="<?php echo $sitename; ?>logout.php" class="waves-effect subdrop"  <?php if($menu==15) { ?>style="font-weight:bold;" <?php } ?>>
                   
                    <i class="fa fa-sign-out text-primary"></i><span> Logout</span> </a>
                   
                </li>
           </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
<!-- Left Sidebar End -->
<!-- Right Sidebar -->
<!--   <div class="side-bar right-bar nicescroll">
      <h4 class="text-center">Chat</h4>
      <div class="contact-list nicescroll">
          <ul class="list-group contacts-list">
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-1.jpg" alt="">
                      </div>
                      <span class="name">Chadengle</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-2.jpg" alt="">
                      </div>
                      <span class="name">Tomaslau</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-3.jpg" alt="">
                      </div>
                      <span class="name">Stillnotdavid</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-4.jpg" alt="">
                      </div>
                      <span class="name">Kurafire</span>
                      <i class="fa fa-circle online"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-5.jpg" alt="">
                      </div>
                      <span class="name">Shahedk</span>
                      <i class="fa fa-circle away"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-6.jpg" alt="">
                      </div>
                      <span class="name">Adhamdannaway</span>
                      <i class="fa fa-circle away"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-7.jpg" alt="">
                      </div>
                      <span class="name">Ok</span>
                      <i class="fa fa-circle away"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-8.jpg" alt="">
                      </div>
                      <span class="name">Arashasghari</span>
                      <i class="fa fa-circle offline"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-9.jpg" alt="">
                      </div>
                      <span class="name">Joshaustin</span>
                      <i class="fa fa-circle offline"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                  <a href="#">
                      <div class="avatar">
                          <img src="assets/images/users/avatar-10.jpg" alt="">
                      </div>
                      <span class="name">Sortino</span>
                      <i class="fa fa-circle offline"></i>
                  </a>
                  <span class="clearfix"></span>
              </li>
          </ul>
      </div>
  </div> -->
<!-- /Right-bar -->

<!-- END wrapper -->