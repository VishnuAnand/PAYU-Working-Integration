<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"]; //Please use the amount value from database
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$phone=$_POST["phone"];
$address=$_POST["address1"];
$poojaid=$_POST["udf1"];
$templeid=$_POST["udf2"];
$city=$_POST["city"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$star=$_POST["udf3"];
$date=$_POST["udf4"];
$salt="eCwWELxi"; //Please change the value with the live salt for production environment


//Validating the reverse hash
If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||'.$date.'|'.$star.'|'.$templeid.'|'.$poojaid.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||'.$date.'|'.$star.'|'.$templeid.'|'.$poojaid.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Transaction has been tampered. Please try again";
		   }
	   else {
           	   
          echo "<h3>Thank You, " . $firstname .".Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";



          $conn=mysqli_connect("localhost","root","","db_temple");
           
echo "Done";
            $querry="INSERT INTO booking (tempid,poojaid,name,poojaname,amount,address,city,phone,email,txid,star,date) VALUES('$templeid','$poojaid','$firstname','$productinfo','$amount','$address','$city','$phone','$email','$txnid','$star','$date')";
$sql=mysqli_query($conn,$querry);
if($sql==true)
{
 echo "<script> alert('success')</script>";
 }
 }         
?>	