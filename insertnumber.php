<?php
$Name = $_POST['Name'];
$date1 = $_POST['date'];
$month = $_POST['month'];
$year = $_POST['year'];
$phone = $_POST['phone'];
$email = $_POST['email'];

if (!empty($Name) || !empty($date1) || !empty($month) || !empty($year) || !empty($phone) || !empty($email)) {
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
     $INSERT = "INSERT Into PhoneBook (Name, date1, month, year, phone, email) values(?, ?, ?, ?, ?, ?)";
  

     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) 
     {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $Name, $date1, $month, $year, $phone, $email);
      $stmt->execute();
      echo "New Phone Number inserted sucessfully";
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