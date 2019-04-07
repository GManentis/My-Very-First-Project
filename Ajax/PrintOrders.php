<?php
	
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
     $getdata_PRST = $CONNPDO->prepare("SELECT MAX(orderid) AS LargestPrice FROM jorders ");
     $getdata_PRST->execute() or die($CONNPDO->errorInfo());
     while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
	 {$laststand = $getdata_RSLT["LargestPrice"];}		 
     $response="";
 for ($i = 1; $i <= $laststand; $i++){
	 
 $getdata_PRST = $CONNPDO->prepare("SELECT * FROM jorders where orderid = :ok");
 $getdata_PRST->bindValue(":ok",$i);
 $getdata_PRST->execute() or die($CONNPDO->errorInfo());
 while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) 
	{ 
		$oName = "";
	    $oPrice = "";
		$oQuan = "";
		$Total = 0;
		$Sum = "";
					  
		$orderid = $getdata_RSLT["orderid"];
		$order_temp = $getdata_RSLT["ordered"];
		$shivadate = $getdata_RSLT["date"];
					  
		$bahamut_order = json_decode($order_temp, true);
					  
		foreach($bahamut_order as $key => $value)
		{
		 $productid = $value['Item'];
		 $prQuantity = $value['Quantity'];
					 
		 $getdata_PRST = $CONNPDO->prepare("SELECT name , price  FROM items WHERE id = :cid");
		 $getdata_PRST->bindValue(":cid",$productid);
		 $getdata_PRST->execute() or die($CONNPDO->errorInfo());
						 
		 while($getdata_RSLT = $getdata_PRST->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
		 {
		   $pPrice = $getdata_RSLT["price"];
		   $pName = $getdata_RSLT["name"];
		   $oName .= $pName . "<br>";
		   $oPrice .= $pPrice . "<br>";
		   $oQuan .= $prQuantity . "<br>";
		   $Sum .= $pPrice*$prQuantity . "<br>";
		   $Total += $pPrice*$prQuantity ;
		 }
		}
		$date_temp = strtotime($shivadate);	
		$date = date("D M j G:i:s T Y", $date_temp);
		$response .= "<tr><td>Order$orderid</td><td>$date</td><td>$oName</td><td>$oPrice</td><td>$oQuan</td><td>$Sum</td><td>$Total</td></tr>";
					 
	}	
				
 }  			    
 
		 echo $response;            	   			
		                
}
else
{
 echo "An error occured,we apologise for the inconvience";
}
?>  