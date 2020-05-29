<?php
$Name1 = $_POST['Name'];
$date1 = $_POST['date'];
$month1 = $_POST['month'];
$year1 = $_POST['year'];
$phone1 = $_POST['phone'];
$email1 = $_POST['email'];

if (!empty($Name1) || !empty($date1) || !empty($month1) || !empty($year1) || !empty($phone1) || !empty($email1)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "kumarashok";
    $dbname = "test";
    

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) 
    {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }
    else 
    {
     $SELECT = "SELECT email From PhoneBook Where email = ? Limit 1";
     $UPDATE = "UPDATE PhoneBook set Name=Name1, date1=date1, month=month1, year=year1, phone=phone1, email=email1";

     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email1);
     $stmt->execute();
     $stmt->bind_result($email1);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) 
     {
      $stmt->close();
      $stmt = $conn->prepare($UPDATE);
      $stmt->bind_param("ssssii", $Name1, $date1, $month1, $year1, $phone1, $email1);
      $stmt->execute();
      echo "New Phone Number update sucessfully";
     } 
     else 
     {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} 
else 
{
 echo "All field are required";
 die();
}
?>