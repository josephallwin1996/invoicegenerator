<?php
session_start();
// Define DEBUG Constant
define('DEBUG', false);

// Turn on error reporting if DEBUG is true
if(DEBUG){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


// include the controller file
include_once '../controllers/invoice.class.php';

// Create object of controller file
$objScr = new InvoiceController();

if(isset($_REQUEST['new'])){
	$objScr->modDeleteLineItem();
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create invoice Application</title>
	<link rel="stylesheet" href="../css/style.css">
	<script src="../scripts/invoice.js"></script>
	
</head>
<body>
    <div class="container">
		<div class="container-wrapper"><?php
			switch($objScr->doAction){
                case "":
                        // Fetch the line item list to render in the page
                        $arrLineItem = $objScr->modGetLineItem();
						// Values for tax dropdown
						$arrTaxDropdown = $objScr->modGetTaxValues();
                        // Line item Form 
                        ?>
						<div class="section-add-items">
							<h2>Add line item</h2>
							<form name="frmLineItem" method="GET" action="./invoice.php" onSubmit="">
								<table>
									<tr>
										<td>Name</td>
										<td><input type="text" name="txtItemName" id="txtItemName" required value="<?php print($arrLineItem['name']); ?>"></td>
									</tr>
									<tr>
										<td>Quantity</td>
										<td><input type="number" name="txtQuantity" id="txtQuantity" required value="<?php print($arrLineItem['quantity']); ?>"></td>
									</tr>
									<tr>
										<td>Unit Price</td>
										<td><input type="number" name="txtUnitPrice" id="txtUnitPrice" required value="<?php print($arrLineItem['price']); ?>"></td>
									</tr>
									<tr>
										<td>Tax</td>
										<td>
											<select name="selTax" id="selTax"><?php
												foreach($arrTaxDropdown as $taxVal){
													?><option <?php if($taxVal == $arrLineItem['tax']){print("selected");}?> value="<?php print($taxVal);?>"><?php print($taxVal . '%'); ?></option><?php
												}
											?></select>
										</td>
									</tr>
									<tr>
										<td colspan="2"><input type="hidden" name="doAction" value="<?php if($objScr->lineItemId ){print('Update');}else{print('Add');} ?>"/>
										<input type="hidden" name="lineItemId" value="<?php print($objScr->lineItemId );?>"/>
										<input type="submit" value="<?php if($objScr->lineItemId){print('Update');}else{print('Add');} ?>"/></td>
									</tr>
								</table>
							</form>
                        </div>
						<div class="section-list-items">
						<h2>Line item list</h2>
						<label>Date :<?php print(date("d-m-y")) ?></label><br>
						<label>Invoice No :</label><input type="text" name="txtInvoiceNo" id="txtInvoiceNo" placeholder="Invoice No" required value="">
						
						<?php
						
                        // Fetch the line item list to render in the page
                        $rsltCm = $objScr->objInvoice->getAllItems();
                        if(mysqli_num_rows($rsltCm)){
                            $total = $objScr->objInvoice->getTotalWithOutTax();
                            ?>
							<table border="1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Tax</th>
                                    <th>Sub Total</th>
                                    <th>Sub total(Tax)</th>
                                </tr>
                            </thead>
                            <tbody><?php
                                while($rowGetInfo = $rsltCm->fetch_assoc()){
                                    print('<tr>');
                                    print('<td>' . $rowGetInfo['name'] . '</td>');
                                    print('<td>' . $rowGetInfo['quantity'] . '</td>');
                                    print('<td>' . $rowGetInfo['price'] . '</td>');
                                    print('<td>' . $rowGetInfo['tax'] . '</td>');
                                    print('<td>' . $rowGetInfo['total'] . '</td>');
                                    print('<td>' . $rowGetInfo['totalWithTax'] . '</td>');
                                    print('<td><a href="invoice.php?lineItemId=' . $rowGetInfo['recId'] . '" title="Edit">Edit</a></td>');
                                    print('<td><a href="invoice.php?doAction=Delete&recId= ' . $rowGetInfo['recId'] . '" title="Edit">Delete</a></td>');
                                }
                            ?></tbody>
                        </table>
                        <table>
                            <tr>
                                <td>Discount</td>
                                <td>
                                    <input type="number" name="txtDiscount" id="txtDiscount" required value="0">
                                    <select name="selDiscountType" id="selDiscountType">
                                        <option value="P">%</option>
                                        <option value="F">fixed</option>
                                    </select>
									<button onclick="jsApplyDiscount()">Apply Discount</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Total
                                </td>
                                <td>
                                <form method="get" name="frmInvoice" id="frmInvoice" action="invoice.php">
                                    <input type="number" name="txtTotal" id="txtTotal" readonly value="<?php print($total); ?>">
									<input type="hidden" name="hdnDiscount" id="hdnDiscount"  value="">
									<input type="hidden" name="hdnDiscountType" id="hdnDiscountType"  value="">
									<input type="hidden" name="hdnInvoiceNo" id="hdnInvoiceNo"  value="">
                                    <input type="hidden" name="hdnTotal" id="hdnTotal"  value="<?php print($total); ?>">
                                    <input type="hidden" name="doAction" id="doAction"  value="CreateInvoice">
                                </form>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1"><button title="Create invoice" onClick="jsCreateInvoice()">Generate Invoice</button></td>
                            </tr>
                        </table>
                        <?php
                        }
                        else{
                            print('<br/>No Line Items Added. Add Line Item');
                        }                               
                        ?></div><?php
                    break;

                    case "CreateInvoice":
                        // Fetch the line item list to render in the page
                        $rsltCm = $objScr->objInvoice->getAllItems();
                        ?> 
                       
						<div>
							
							<table  width="100%">
								<caption>INVOICE</caption>
							<tr>
								<td>
									<label>Invoice No : <?php print($_REQUEST['hdnInvoiceNo']) ?></label><br>
									<label>Date :<?php print(date("d-m-y")) ?></label>
								</td>
							</tr>	
							
							<tr border="1">
								<th>Name</th>
								<th>Quantity</th>
								<th>Unit Price</th>
								<th>Tax</th>
								<th>Sub Total</th>
								<th>Sub total(Tax)</th>
							</tr><?php
							while($rowGetInfo = $rsltCm->fetch_assoc()){
								print('<tr>');
								print('<td>' . $rowGetInfo['name'] . '</td>');
								print('<td>' . $rowGetInfo['quantity'] . '</td>');
								print('<td>' . $rowGetInfo['price'] . '</td>');
								print('<td>' . $rowGetInfo['tax'] . '</td>');
								print('<td>' . $rowGetInfo['total'] . '</td>');
								print('<td>' . $rowGetInfo['totalWithTax'] . '</td>');
								 print('</tr>');
							}
							?>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									Total : 
								</td>
								<td>
									<?php print($_REQUEST['hdnTotal']) ?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									Discount : 
								</td>
								<td>
									<?php print($_REQUEST['hdnDiscount']);print ($_REQUEST['hdnDiscountType'] == "P") ? "%" : ""; ?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									Grant Total : 
								</td>
								<td>
									<?php print($_REQUEST['txtTotal']) ?>
								</td>
							</tr>
							<tr>
								<td>
									<a href="javascript:" title="Print invoice" onClick="jsPrintInvoice()">Print Invoice</a>
								</td>	
								<td>
									<a  href="invoice.php?new=Y"title="New invoice" onClick="jsNewInvoice()">New Invoice</button>
								</td>
							</tr>
							
							</table>
							
						</div><?php
                    break;
            }
        ?></div>
	</div>
</body>
</html>