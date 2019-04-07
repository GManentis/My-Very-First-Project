function ShowOptions()
{
	try 
	{				
		var xmlhttp3;

		if (window.XMLHttpRequest) 
		{
			xmlhttp3 = new XMLHttpRequest();
			// most browsers
		} 
		else 
		{
			xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
			// internet explorer
		}
		
		xmlhttp3.onreadystatechange = function() 
		{			
			if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) 
			{
				var strOut2;	
                var strOut2 = "<table border=2><tr><th>Name</th><th>Image</th><th>Description</th><th>Price</th><th>Quantity</th>";	
			    strOut2 += xmlhttp3.responseText;
			    
				strOut2 += "</table>";				
				
				document.getElementById("shop").innerHTML = strOut2;
			}
		}
		xmlhttp3.open("POST","Ajax/ShowOptionsData.php", true);
		xmlhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
		xmlhttp3.send();
	}
	catch(err) 
	{
		alert(err);
	}
	
	
}


function getOrder() 
{	
	try 
	{				
		var xmlhttp;

		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
			// most browsers
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			// internet explorer
		}
		
		
		
		var quantity = document.getElementsByClassName("quantity"); 
		
						
		var OrderList = [];
		for (var i = 0;  i < quantity.length; i++) 
		{ 
	      if (quantity[i].value != 0 && quantity[i] != "")
		  {
			var oOrder = new COrder();
			var z = quantity[i].id;
			var item = z.replace("quantity","");
			oOrder.Item = item ;
			oOrder.Quantity = quantity[i].value;
			OrderList[i] = oOrder;
		  }
		}
		
		
		var order = JSON.stringify(OrderList);
		
		

		
		xmlhttp.onreadystatechange = function() {			
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var strOut;			
				strOut = xmlhttp.responseText;
				document.getElementById("answer").innerHTML = strOut;
			}
		}
		
		xmlhttp.open("POST", "Ajax/GetOrderData.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
		xmlhttp.send("OrderData="+order); 
	}
	catch(err) {
		alert(err);
	}
}

function COrder() {
	this.Item = "";
	this.Quantity = 0;
}
			