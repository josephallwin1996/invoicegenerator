
/*
	function to apply discount on total amount
*/
function jsApplyDiscount(){
	
	var total = document.getElementById('hdnTotal').value;
	var discType = document.getElementById('selDiscountType').value;
	var discount = document.getElementById('txtDiscount').value;
	var  newTotal = total;

	if(discType == 'F'){
		newTotal = total - discount;
	}
	else{
		if(discount){
			percentage = (total / 100) * discount;
		}
		newTotal = total - percentage;
	}
	
	if(newTotal > 0){
		document.getElementById('txtTotal').value = newTotal;
	}
	else{
		alert("This Discount cant't be applied! Discount value greater than the Biiling Price");
		document.getElementById('txtDiscount').value = "0";
	}
	
}

/*
	function to create generateInvoice
*/
function jsCreateInvoice(){
   document.getElementById("hdnDiscount").value = document.getElementById('txtDiscount').value;
   document.getElementById("hdnDiscountType").value = document.getElementById('selDiscountType').value;
   document.getElementById("hdnInvoiceNo").value = document.getElementById('txtInvoiceNo').value;
   
   document.getElementById('frmInvoice').submit();
}

/*
	function to print Invoice
*/
function jsPrintInvoice(){
	window.print();
}

/*
	function to print Invoice
*/
function jsPrintInvoice(){
	window.print();
}

