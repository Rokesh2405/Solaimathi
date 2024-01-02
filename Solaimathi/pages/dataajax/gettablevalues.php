<?php date_default_timezone_set('Asia/Kolkata');
include ('../../config/config.inc.php');
date_default_timezone_set('Asia/Kolkata');
//ini_set('display_errors','1');
//error_reporting(E_ALL);
function mres($value) {
    $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
    $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");
    return str_replace($search, $replace, $value);
}
if ($_REQUEST['types'] == 'debittable') {
$aColumns = array('id','ledger_name','ledger_type','customer_name','amount','modeofpayment');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "debitcredit";
}
if ($_REQUEST['types'] == 'credittable') {
$aColumns = array('id','ledger_name','ledger_type','customer_name','amount','modeofpayment');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "debitcredit";
}
if ($_REQUEST['types'] == 'balancetable') {
$aColumns = array('id','date','ledger_name','opening_balance');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "opening_balance";
}
if ($_REQUEST['types'] == 'expensetable') {
$aColumns = array('id', 'expense_date','expense_type');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "expense";
}
if ($_REQUEST['types'] == 'dailytable' || $_REQUEST['types'] == 'weeklytable' || $_REQUEST['types'] == 'monthlytable') {
$aColumns = array('id', 'paid_date','customerid','amount','paid_status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "installment";
}
if ($_REQUEST['types'] == 'expensetypetable') {
$aColumns = array('id', 'expense_type','status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "expense_type";
}
if ($_REQUEST['types'] == 'ledgernametable') {
$aColumns = array('id', 'ledgername','status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "ledgername";
}
if ($_REQUEST['types'] == 'ledgertypetable') {
$aColumns = array('id', 'ledgertype','status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "ledgertype";
}
if ($_REQUEST['types'] == 'prooftable') {
$aColumns = array('id', 'proof_name','status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "proof";
}
if ($_REQUEST['types'] == 'biketable') {
$aColumns = array('id', 'vehicle_type','bike_name','status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "bike";
}
if ($_REQUEST['types'] == 'modeltable') {
$aColumns = array('id', 'vehicle_type','bike_name','model_name','yearof_model','status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "model";
}
if ($_REQUEST['types'] == 'customertable') {
$aColumns = array('id', 'customerid','date','name','mobileno','vehicle_type','loan_amount','due_amt_per_month','status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "customer";
}
if ($_REQUEST['types'] == 'subusertable') {
$aColumns = array('id', 'name','mobileno','status');
$sIndexColumn = "id";
//$editpage = ($_REQUEST['db_table_for'] == 'live') ? "editbanner" : "editbanner";brandstable modelstable
$sTable = "subuser";
}

/* Declaration table name start here */



$aColumns1 = $aColumns;

function fatal_error($sErrorMessage = '') {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
    die($sErrorMessage);
}

$sLimit = "";

if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " . intval($_GET['iDisplayLength']);
}
 if ($_REQUEST['types'] == 'categorytable' || $_REQUEST['types'] == 'producttable' || $_REQUEST['types'] == 'subcategorytable' || $_REQUEST['types'] == 'typetable') {
   $sOrder = "ORDER BY `order` ASC ";
    }
    else
    {
    $sOrder = "ORDER BY `$sIndexColumn` DESC";
    }
    

if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    if (in_array("order", $aColumns)) {
        $sOrder .= "`order` asc, ";
    } else if (in_array("Order", $aColumns)) {
        $sOrder .= "`Order` asc, ";
    }
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " . ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
        }
        $sOrder = substr_replace($sOrder, "", -2);
        if ($sOrder == "ORDER BY ") {
            $sOrder = " ";
        }
    }
}

$sWhere = "";


if ($sWhere != '') {

     $sWhere = "WHERE `$sIndexColumn`!='' $sWhere";    
  
}
else
{ 
  
   
      if ($_REQUEST['types'] == 'blocktable') {
   $sWhere = " WHERE `block_code`!='' "; 
    }
      if ($_REQUEST['types'] == 'panchayattable') {
   $sWhere = " WHERE `panchayat_code`!='' "; 
    }
    
	if ($_REQUEST['types'] == 'formtable') {
		if($_REQUEST['formid']!='') { 
   $sWhere = "WHERE `userid`='".$_REQUEST['formid']."' AND `type`='".$_SESSION['usertype']."'";    
		}
	if($_SESSION['GRUID']!='1') { 
  	$sWhere = "WHERE `supervisor`='".$_SESSION['usertypeid']."' AND `type`='supervisor'";  	    
		}
		
		
    }
    	if ($_REQUEST['types'] == 'employeeformtable') {
    	    if($_SESSION['usertype']=='supervisor') {
    	 $sWhere = "WHERE `supervisor`='".$_SESSION['usertypeid']."' AND `type`='employee' ";  	    
    	    }
    	    if($_SESSION['usertype']=='manager') {
    	 $sWhere = "WHERE `manager`='".$_SESSION['usertypeid']."' AND `type`='employee' ";  	    
    	    }
    	    if($_SESSION['usertype']=='employee') {
    	 $sWhere = "WHERE `employee`='".$_SESSION['usertypeid']."' AND `type`='employee'";  	    
    	    }
    	}
    	
    	if ($_REQUEST['types'] == 'managerformtable') {
    	    if($_SESSION['usertype']=='supervisor') {
    	 $sWhere = "WHERE `supervisor`='".$_SESSION['usertypeid']."' AND `type`='manager' ";  	    
    	    }
    	     if($_SESSION['usertype']=='manager') {
    	 $sWhere = "WHERE `manager`='".$_SESSION['usertypeid']."' AND `type`='manager'";  	    
    	    }
    	  
    	}
    		if ($_REQUEST['types'] == 'nmanagerformtable') {
    	    if($_SESSION['usertype']=='supervisor') {
    	 $sWhere = "WHERE `supervisor`='".$_SESSION['usertypeid']."' AND `type`='manager' ";  	    
    	    }
    	     if($_SESSION['usertype']=='manager') {
    	 $sWhere = "WHERE `manager`='".$_SESSION['usertypeid']."' AND `type`='manager'";  	    
    	    }
    	  
    	}
    	
    	
    	
    
}

   if ($_REQUEST['types'] == 'pendingordertable') {
   $sWhere = " WHERE `deliver_status`='Order Placed' "; 
    }
   
   if ($_REQUEST['types'] == 'activeordertable') {
   $sWhere = " WHERE (`deliver_status`!='Order Placed' AND `deliver_status`!='Delivered' AND `deliver_status`='Cancelled') "; 
    }
	
	
    if ($_REQUEST['types'] == 'assignedordertable') {
   $sWhere = " WHERE `final_amount` IS NULL AND `driver_id`!='0' "; 
    }
	if ($_REQUEST['types'] == 'completedordertable') {
   $sWhere = " WHERE `deliver_status`='Delivered' "; 
    }
	if ($_REQUEST['types'] == 'cancelledordertable') {
   $sWhere = " WHERE `deliver_status`='Cancelled' "; 
    }
	if ($_REQUEST['types'] == 'offersettingtable') {
		if($_SESSION['GRUID']=='1') { 
   $sWhere = " WHERE `id`='".$_SESSION['GRUID']."' "; 
		}
		else
		{
		$sWhere = " WHERE `id`='2' "; 	
		}
		
    }
	
	if ($_REQUEST['types'] == 'categorytable' || $_REQUEST['types'] == 'subcategorytable' || $_REQUEST['types'] == 'producttable' || $_REQUEST['types'] == 'offertable') {
   $sWhere = " WHERE `vendor`='".getusers('vendor',$_SESSION['GRUID'])."' "; 
    }
	if ($_REQUEST['types'] == 'vendortable' || $_REQUEST['types'] == 'deliveryboytable') {
    if($_SESSION['usertype']=='subadmin') {
	$sWhere = " WHERE `subadmin`='".getusers('vendor',$_SESSION['GRUID'])."' "; 
	}
	
    }
	
	if ($_REQUEST['types'] == 'expensetable' || $_REQUEST['types'] == 'expensetypetable') {
    if($_SESSION['usertype']=='subadmin')
{
$createid=getusers('vendor',$_SESSION['GRUID']);
$createby="subadmin";
}	
else
{
$createid=$_SESSION['GRUID'];
$createby="admin";	
}

	$sWhere = " WHERE `createid`='".$createid."' AND `createby`='".$createby."' "; 
	
    }
	
	
if($_SESSION['GRUID']=='1') {
$userid="1";
$usertype="admin";
}
else
{
	$userid=getusers('typeid',$_SESSION['GRUID']);
$usertype=getusers('type',$_SESSION['GRUID']);
}


	 if ($_REQUEST['types'] == 'debittable') {
   $sWhere = " WHERE `type`='1'"; 
    }
if ($_REQUEST['types'] == 'credittable') {
   $sWhere = " WHERE `type`='2'"; 
    }
    

    if ($_REQUEST['types'] == 'dailytable') {
   $sWhere = " WHERE `type`='3' AND `userid`='".$userid."' AND `usertype`='".$usertype."' "; 
    }
	 if ($_REQUEST['types'] == 'weeklytable') {
   $sWhere = " WHERE `type`='4' AND `usertype`='".$usertype."' "; 
    }
	if($_REQUEST['types'] == 'monthlytable') {
   $sWhere = " WHERE `type`='5' AND `usertype`='".$usertype."' "; 
    }
   $sQuery = "SELECT SQL_CALC_FOUND_ROWS `" . str_replace(",", "`,`", implode(",", $aColumns)) . "` FROM $sTable $sWhere $sOrder $sLimit ";



$rResult = $db->prepare($sQuery);
$rResult->execute();

 $sQuery = "SELECT FOUND_ROWS()";

$rResultFilterTotal = $db->prepare($sQuery);
$rResultFilterTotal->execute();

$aResultFilterTotal = $rResultFilterTotal->fetch();
$iFilteredTotal = $aResultFilterTotal[0];

$sQuery = "SELECT COUNT(" . $sIndexColumn . ") FROM $sTable";
$rResultTotal = $db->prepare($sQuery);
$rResultTotal->execute();

$aResultTotal = $rResultTotal->fetch();
$iTotal = $aResultTotal[0];

$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

$ij = 1;
$k = $_GET['iDisplayStart'];

while ($aRow = $rResult->fetch(PDO::FETCH_ASSOC)) {
    $k++;
    $row = array();
    $row1 = '';
    for ($i = 0; $i < count($aColumns1); $i++) {
        if ($_REQUEST['types'] == 'modeltable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'vehicle_type') {
				if($aRow['vehicle_type']=='1') { $row[] ='Bike';  } else { $row[] ='Car'; }
            } elseif ($aColumns1[$i] == 'bike_name') {
				$row[] = getbike('bike_name',$aRow['bike_name']);
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
        else  if ($_REQUEST['types'] == 'debittable' || $_REQUEST['types'] == 'credittable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'ledger_name') {
               $row[] = getledgername('ledgername',$aRow['ledger_name']);
            } elseif ($aColumns1[$i] == 'ledger_type') {
               $row[] = getledgertype('ledgertype',$aRow['ledger_type']);
            } elseif ($aColumns1[$i] == 'customer_name') {
                $row[] = getcustomer('name',$aRow['customer_name']);
            } elseif ($aColumns1[$i] == 'modeofpayment') {
                if($aRow['modeofpayment']=='1') {
                $row[] = 'Cash';
              }if($aRow['modeofpayment']=='2') {
                $row[] = 'Cheque';
              }if($aRow['modeofpayment']=='3') {
                $row[] = 'Bank Transfer';
              }

            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        } else if ($_REQUEST['types'] == 'dailytable' || $_REQUEST['types'] == 'weeklytable' || $_REQUEST['types'] == 'monthlytable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            } elseif ($aColumns1[$i] == 'paid_date') {
				$row[] = date('d-m-Y',strtotime($aRow['paid_date']));
            } elseif ($aColumns1[$i] == 'customerid') {
				$row[] = getcustomer('customerid',$aRow['customerid']);
				$row[] = getcustomer('name',$aRow['customerid']);
            } elseif ($aColumns1[$i] == 'paid_status') {
				if($aRow['paid_status']=='1') {
					$row[] = 'Paid';
				}
				else { $row[] = 'Un Paid'; }
			
            } elseif ($aColumns1[$i] == 'amount') {
				 $row[] = 'Rs. '.$aRow[$aColumns1[$i]];
			}
			else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
		else  if ($_REQUEST['types'] == 'biketable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }  elseif ($aColumns1[$i] == 'vehicle_type') {
				if($aRow['vehicle_type']=='1') { $row[] ='Bike';  } else { $row[] ='Car'; }
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
		else  if ($_REQUEST['types'] == 'customertable' || $_REQUEST['types'] == 'balancetable') {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }  elseif ($aColumns1[$i] == 'vehicle_type') {
                if($aRow['vehicle_type']=='1') {
                $row[] = "Bike Loan";
               }
            if($aRow['vehicle_type']=='2') {
                $row[] = "Car Loan";
               }
               if($aRow['vehicle_type']=='3') {
                $row[] = "Daily Loan";
               }
               if($aRow['vehicle_type']=='4') {
                $row[] = "Weekly Loan";
               }
               if($aRow['vehicle_type']=='5') {
                $row[] = "Monthly Loan";
               }
            }  elseif ($aColumns1[$i] == 'date') {
                $row[] = date('d-m-Y',strtotime($aRow[$aColumns1[$i]]));
            } elseif ($aColumns1[$i] == 'ledger_name') {
                $row[] = getledgername('ledgername',$aRow[$aColumns1[$i]]);
            } elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
   	else {
            if ($aColumns1[$i] == $sIndexColumn) {
                $row[] = $k;
            }
			elseif ($aColumns1[$i] == 'status') {
                $row[] = $aRow[$aColumns1[$i]] ? "Active" : "Inactive";
            } else {
                $row[] = $aRow[$aColumns1[$i]];
            }
        }
    }

    /* Edit page  change start here */
  
    if (($_REQUEST['types'] == 'registertable') || ($_REQUEST['types'] == 'pendingordertable') || ($_REQUEST['types'] == 'activeordertable') || ($_REQUEST['types'] == 'completedordertable') || ($_REQUEST['types'] == 'cancelledordertable')  || ($_REQUEST['types'] == 'formtable1') ) {
        $row[] = "<i class='fa fa-eye' onclick='javascript:viewthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> </i>";
    }
    
    else {
        if($_REQUEST['types'] != 'ordertable' || $_REQUEST['types'] != 'offersettingtable')
        {
        $row[] = "<i class='fa fa-eye' onclick='javascript:editthis(" . $aRow[$sIndexColumn] . ");' style='cursor:pointer;'> View </i>";
        }
        
    }

    $row[] = '<input type="checkbox"  name="chk[]" id="chk[]" value="' . $aRow[$sIndexColumn] . '" />';



    $output['aaData'][] = $row;
    $ij++;
}

echo json_encode($output);
?>
 
