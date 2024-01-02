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

    $msg = adddepit($ledger_name,$ledger_type,$customer_name,$other,$amount,$description,$modeofpayment,$cheque_no,$transfer_id,$getid);
   
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
                        <a href="<?php echo $sitename; ?>master/debitlist.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div>

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Debit Entry</h4>
                    <ol class="breadcrumb">
                      
                        <li class="breadcrumb-item">Debit List</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Debit Entry</li>
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
                            <label>Ledger Name<span style="color:#FF0000;"> *</span></label>
							
							<select name="ledger_name" class="form-control" id="ledger_name" onchange="getledgertype(this.value)">
                                 <option value="">Select</option>
                           <?php $sel = pFETCH("SELECT * FROM `ledgername` WHERE `status`=?", 1);
                            while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                  
                                <option value="<?php echo $fdepart['id']; ?>"
                                <?php
                                if ($fdepart['id'] == getdebit('ledger_name', $_REQUEST['banid'])) {
                                    echo 'selected="selected"';
                                }
                                ?>><?php echo $fdepart['ledgername']; ?></option>
                                    <?php } ?>
                            </select>
                              </div>
							
                            <div class="col-md-4">
                            <label>Ledger Type<span style="color:#FF0000;"> *</span></label>
                          <select name="ledger_type" class="form-control" id="ledger_type">
                             <option value="">Select</option>
<?php $sel = pFETCH("SELECT * FROM `ledgertype` WHERE `status`=?", 1);
                                     while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
                                   ?>
                                <option value="<?php echo $fdepart['id']; ?>"
                                <?php
                                if ($fdepart['id'] == getdebit('ledger_type', $_REQUEST['banid'])) {
                                    echo 'selected="selected"';
                                }
                                ?>><?php echo $fdepart['ledgertype']; ?></option>
                                    <?php } ?>
                            </select> </div>

							 <div class="col-md-4">
                            <label>Customer Name</label>
                         <select name="customer_name" class="form-control">
                            <option value="">Select</option>
<?php $sel = pFETCH("SELECT * FROM `customer` WHERE `status`=?", 1);
                                     while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
                                   ?>
                                <option value="<?php echo $fdepart['id']; ?>"
                                <?php
                                if ($fdepart['id'] == getdebit('customer_name', $_REQUEST['banid'])) {
                                    echo 'selected="selected"';
                                }
                                ?>><?php echo $fdepart['name']; ?></option>
                                    <?php } ?>
                            </select> 
                      </div> 
					  
							  </div>
							  <br>
							  <div class="row">
                              <div class="col-md-4">
                            <label>Amount<span style="color:#FF0000;"> *</span></label>
                            
                            <input type="text" name="amount" class="form-control" required="required" value="<?php echo getdebit('amount', $_REQUEST['banid']); ?>">
                            </div>
                            
                            <div class="col-md-4">
                            <label>Description<span style="color:#FF0000;"> *</span></label>
                            
                            <input type="text" name="description" class="form-control" required="required" value="<?php echo getdebit('description', $_REQUEST['banid']); ?>">
                            </div>

                             <div class="col-md-4">
                            <label>Mode Of Payment</label>
                          
                          <select name="modeofpayment" class="form-control">
                         <option value="1" <?php if(getdebit('modeofpayment', $_REQUEST['banid'])=='1') { ?> selected="selected"<?php } ?>>Cash</option>      
                         <option value="2" <?php if(getdebit('modeofpayment', $_REQUEST['banid'])=='0') { ?> selected="selected"<?php } ?>>Cheque</option>   
                          <option value="3" <?php if(getdebit('modeofpayment', $_REQUEST['banid'])=='0') { ?> selected="selected"<?php } ?>>Bank Transfer</option>         
                          </select>
                      </div> 
                      
                              </div>
                              <br>
                      
                        <div class="row">
                              <div class="col-md-4">
                            <label>Cheque No</label>
                            
                            <input type="text" name="cheque_no" class="form-control" value="<?php echo getdebit('cheque_no', $_REQUEST['banid']); ?>">
                            </div>
                            
                            <div class="col-md-4">
                            <label>Transfer ID</label>
                            
                            <input type="text" name="transfer_id" class="form-control" value="<?php echo getdebit('transfer_id', $_REQUEST['banid']); ?>">
                            </div>

 </div>
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
                            <a href="<?php echo $sitename; ?>master/debitlist.htm">Back to Listings page</a>
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
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
<script>
    function getledgertype(a)
    {
        $.ajax({
            url: "<?php echo $sitename; ?>ajaxfunction.php",
            data: {ledgername: a},
            success: function (data) {
              $("#ledger_type").html(data);
            }
        });
    }
</script>