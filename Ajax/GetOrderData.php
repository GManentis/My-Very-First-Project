<?php
	if (!(empty($_POST["OrderData"])))  
	{
		$sOrder = $_POST["OrderData"];

		$hostname_DB = "127.0.0.1";
		$database_DB = "itemstore";
		$username_DB = "root";
		$password_DB = "";

		try 
		{
			$CONNPDO = new PDO("mysql:host=".$hostname_DB.";dbname=".$database_DB.";charset=UTF8", $username_DB, $password_DB, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_TIMEOUT => 3));
		} 
		catch (PDOException $e) 
		{
			$CONNPDO = null;
		}
		if ($CONNPDO != null) 
		{
			$getdata_PRST = $CONNPDO->prepare("SELECT orderid FROM jorders ORDER BY id DESC LIMIT 1");
			$getdata_PRST->execute() or die($CONNPDO->errorInfo());
			$lastorderid = 0;
			while ($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
			{
				$lastorderid = $getdata_RSLT["orderid"];
			}
			$lastorderid++;
			
				
		    $adddata_PRST = $CONNPDO->prepare("INSERT INTO jorders(orderid, ordered) VALUES(:orderid, :order)");
	    	$adddata_PRST->bindValue(":orderid", $lastorderid);
			$adddata_PRST->bindValue(":order", $sOrder);
			$adddata_PRST->execute() or die($CONNPDO->errorInfo());
			    
				
		  echo "OK";
		} 
		else 
		{
		 echo "no pdo connection";
		}
		//echo $sResponse;
	}
else 
 {
		echo "An error occured,sorry";
	}


?>  