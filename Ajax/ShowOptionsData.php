<?php
    
	$hostname_DB = "127.0.0.1";
	$database_DB = "itemstore";
	$username_DB = "root";
	$password_DB = "";
		
	try {
		$CONNPDO = new PDO("mysql:host=".$hostname_DB.";dbname=".$database_DB.";charset=UTF8", $username_DB, $password_DB, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_TIMEOUT => 3));
	} catch (PDOException $e) {
		$CONNPDO = null;
	}
	if ($CONNPDO != null) {
				
		$getdata_PRST = $CONNPDO->prepare("SELECT * FROM items ");
		
		$getdata_PRST->execute() or die($CONNPDO->errorInfo());
		
		$resp = "";
		while ($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
			$rid = $getdata_RSLT["id"];
			$rName = $getdata_RSLT["name"];
			$rImage = $getdata_RSLT["image"];
			$rDes = $getdata_RSLT["description"];
			$rPrice = $getdata_RSLT["price"];
			if( $rName != "" && $rImage != "" && $rDes != "" && $rPrice != "") {
				$resp .= "<tr><td id=\"name$rid\">$rName</td><td><img src=$rImage width=50 height=50/></td><td>$rDes</td><td id=\"price$rid\">$rPrice</td><td><input type=number id=\"quantity$rid\" class=\"quantity\"></input></td></tr>";
			}
		}
		echo $resp;
	}
?>