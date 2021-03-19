<?php
$roll = $_POST['roll'];
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$country = $_POST['country'];
$lan = $_POST['lan'];
$gen = $_POST['gen'];
$add = $_POST['add'];
$date = $_POST['date'];
$phonecode = $_POST['phonecode'];

if (!empty($roll) || !empty($name) || !empty($password) || !empty($email) || !empty($country) || !empty($country) ||
 !empty($lan) || !empty($gen) || !empty($add) || !empty($date) || !empty($phonecode))
{ 
  $host = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbname = "prasun";
  // create connection
  $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
  if (mysqli_connect_error()) 
  { 
    die('Connection Error ('.mysqli_connect_error().')'.mysqli_connect_error());
  } 
  else
  { 
    $SELECT = "SELECT email From registration Where email = ? Limit 1";
    $INSERT = "INSERT into registration (roll,name,password,email,country,language,gender,address,dob,mob) values (?,?,?,?,?,?,?,?,?,?)";
    //prepare statement 
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if ($rnum==0)
    { 
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $roll,$name,$password,$email,$country,$language,$gender,$address,$dob,$mob);
      $stmt->execute();
      echo "New Record inserted successfully";
    } 
    else
    { 
      echo "Someone already registered usingthis email.";
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