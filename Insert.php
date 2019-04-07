<!DOCTYPE html>
<html>
<head>
<script>
function InsertData() {	
	try {				
		var xmlhttp;

		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
			// most browsers
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			// internet explorer
		}
		
		var name = document.getElementById("name").value;
		var url = document.getElementById("ImageUrl").value;
		var description = document.getElementById("Description").value;
		var price = document.getElementById("Price").value;
		
		xmlhttp.onreadystatechange = function() {			
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var strOut;			
				strOut = xmlhttp.responseText;
				document.getElementById("mySpan").innerHTML = strOut;
			}
		}
		
		xmlhttp.open("POST", "Ajax/InsertData.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");			
		xmlhttp.send("name="+name+"&url="+url+"&description="+description+"&price="+price);
	}
	catch(err) {
		alert(err);
	}
}
</script>
</head>
<body>
<center>
Please insert data
<table>
<tr><td>Name</td><td><input type="text" id="name" placeholder="Insert Name"/></td></tr>

<tr><td>Image url</td><td><input type="text" id="ImageUrl" placeholder="Insert Src"/></td></tr>
<tr><td>Description</td><td><input type="text"  id="Description" placeholder="Insert Description"/></td></tr>

<tr><td>Price</td><td><input type="number" id="Price" placeholder="Insert Price"/></td></tr>

<tr><td><button  onclick="InsertData()">Submit Entry</button></td></tr>
</table>
<span id="mySpan"></span>
</center>
</body>
</html>
