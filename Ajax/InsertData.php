<?php
	if (!empty($_POST["name"]) && !empty($_POST["url"]) && !empty($_POST["description"]) && !empty($_POST["price"]) )
	{
		$sName = $_POST["name"];
		$sImage = $_POST["url"];
		$sDescription = $_POST["description"];
		$sPrice = $_POST["price"];
		
		
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
			$adddata_PRST = $CONNPDO->prepare("INSERT INTO items(name,image,description,price) VALUES(:Name,:Image,:Description,:Price)");
			$adddata_PRST->bindValue(":Name", $sName);
			$adddata_PRST->bindValue(":Image", $sImage);
			$adddata_PRST->bindValue(":Description", $sDescription);
			$adddata_PRST->bindValue(":Price", $sPrice);
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
		echo "Please fill all the fields";
	}
?>  