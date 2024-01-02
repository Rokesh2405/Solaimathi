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

    $msg = addbalance($ledgername,$opening_balance,$getid);
   
}
if (isset($_REQUEST['delete']) || isset($_REQUEST['delete_x'])) {
    $chk = $_REQUEST['chk'];
    $chk = implode('.', $chk);
   
    $msg = delbalance($chk);
}
?>
<script type="text/javascript" >
    function validcheck(name)
    {
        var chObj = document.getElementsByName(name);
        var result = false;
        for (var i = 0; i < chObj.length; i++) {
            if (chObj[i].checked) {
                result = true;
                break;
            }
        }
        if (!result) {
            return false;
        } else {
            return true;
        }
    }

    function checkdelete(name)
    {
        if (validcheck(name) == true)
        {
            if (confirm("Please confirm you want to Delete this Details(s)"))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else if (validcheck(name) == false)
        {
            alert("Select the check box whom you want to delete.");
            return false;
        }
    }

</script>
<script type="text/javascript">
    function checkall(objForm) {
        len = objForm.elements.length;
        var i = 0;
        for (i = 0; i < len; i++) {
            if (objForm.elements[i].type == 'checkbox') {
                objForm.elements[i].checked = objForm.check_all.checked;
            }
        }
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
                    <!-- <div class="btn-group pull-right m-t-15">
                        <a href="<?php echo $sitename; ?>master/ledgertype.htm"><button type="button" class="btn btn-default">Back to Listings Page</button>
                        </a>

                    </div> -->

                    <h4 class="page-title"><?php
                        if (isset($_REQUEST['banid'])) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        }
                        ?> Opening Balance</h4>
                    <ol class="breadcrumb">
                      
                        <li class="breadcrumb-item"> Opening Balance</li>
                        <li class="breadcrumb-item active"><?php
                            if (isset($_REQUEST['banid'])) {
                                echo "Edit";
                            } else {
                                echo "Add";
                            }
                            ?> Opening Balance</li>
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
              
              <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <div class="panel-title">Add Opening Balance</div>
                                                        </div>
                                                        <div class="panel-body">

                          <div class="row">
                             <div class="col-md-6">
                            <label>Ledger Type<span style="color:#FF0000;"> *</span></label>
                            <select name="ledgername" class="form-control">
                                <option value="">Select</option>
                                <?php $sel = pFETCH("SELECT * FROM `ledgername` WHERE `status`=?", 1);
                                     while ($fdepart = $sel->fetch(PDO::FETCH_ASSOC)) {
                                   ?>
                                <option value="<?php echo $fdepart['id']; ?>"
                                <?php
                                if ($fdepart['id'] == getbalance('ledger_name', $_REQUEST['banid'])) {
                                    echo 'selected="selected"';
                                }
                                ?>><?php echo $fdepart['ledgername']; ?></option>
                                    <?php } ?>
                            </select>

                          </div>
                              <div class="col-md-6">
                            <label>Opening Balance Amount<span style="color:#FF0000;"> *</span></label>
							  <input type="text" name="opening_balance" class="form-control" required="required" value="<?php echo getbalance('opening_balance', $_REQUEST['banid']); ?>">
                            

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


                </div> </div>
                                          
                         
               
                </div><!-- /.box-body -->
               
                   <div class="row">
                              <div class="col-md-6">
                            <label><h4>Last Opening Balance Amount</h4></label>
                             </div>
                           <div class="col-md-6">
                             Rs. <?php
$link22 = FETCH_all("SELECT * FROM opening_balance WHERE `id`!=? ORDER BY `id` DESC", $getid);

                               echo $link22['opening_balance']; ?>

                          </div>
                             </div>
                          


                    
                                    </div>  </form>

                  <br>
                  
                 <form name="form1" method="post" action="">
                                <div class="table-responsive">
                                    <table id="normalexamples" class="table table-bordered table-striped" width="100%">
                                         <thead>
                                <tr align="center">
                                    <th style="width:5%;">S.id</th>
                                     <th style="text-align: left;">Date</th>
                                     <th style="text-align: left;">Ledger Name</th>
                                     <th style="text-align: left;">Opening Balance</th>
                                 
                                  </tr>
                            </thead>
                           
                                <tfoot>
                                    <tr>
                                        <th colspan="4">&nbsp;</th>
                                       

                                    </tr>
                                </tfoot>

                                    </table>
                                </div>
                            </form>   


                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?php echo $sitename; ?>master/ledgertype.htm">Back to Listings page</a>
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
<script type="text/javascript">
      $('#normalexamples').dataTable({
        "bProcessing": true,
        "bServerSide": false,
        //"scrollX": true,
        "searching": true,
        
        "sAjaxSource": "<?php echo $sitename; ?>pages/dataajax/gettablevalues.php?types=balancetable"
    });
</script>
