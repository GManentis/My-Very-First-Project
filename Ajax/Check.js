function Orders()
 {
	try {				
		var xmlhttp3;

		if (window.XMLHttpRequest) {
			xmlhttp3 = new XMLHttpRequest();
			// most browsers
		} else {
			xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
			// internet explorer
		}
		
		xmlhttp3.onreadystatechange = function() {			
			if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
				var strOut2;	
                var strOut2 = "<center><table border=2><tr><th>OrderID</th><th>Date</th><th>Order</th><th>ProductPrice</th><th>Quantity</th><th>Sum</th><th>Total</th></tr>";	
			    strOut2 += xmlhttp3.responseText;
			    
				strOut2 += "</table></center>";				
				
				document.getElementById("resultss").innerHTML = strOut2;
			}
		}
		xmlhttp3.open("POST", "Ajax/PrintOrders.php", true);
		xmlhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
		xmlhttp3.send();
	}
	catch(err) 
	{
		alert(err);
	}
 }