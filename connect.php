<?php
  $username = filter_input(INPUT_POST, 'username');
  $password = filter_input(INPUT_POST, 'password');
  $email = filter_input(INPUT_POST,'email');
  $mobile = filter_input(INPUT_POST,'mobile');
  if (!empty($username)){
  if (!empty($password)){
  if (!empty($email)){
  $host = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "prasun";
  // Create connection
  $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

  if (mysqli_connect_error())
  {
    die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
  }
  else
  {
    if($email != "")
    { 
    $res = mysqli_query($conn, "SELECT * from `registration` where email='".$email."'");
    $num_rows= mysqli_num_rows($res);
      if($num_rows>0)
      {
        echo "Email Exists";
        die();
      }
    }
    if($mobile !="")
    {
      $res = mysqli_query($conn,"SELECT * FROM `registration` where mob='".$mobile."'");
      $num_rows= mysqli_num_rows($res);
        if($num_rows>1)
        {
          echo "You cannot register the same mobile number thrice";
          die();
        }
    }
    $sql = "INSERT INTO registration (name, password, email, mob) values ('$username','$password','$email','$mobile')";
  
    if ($conn->query($sql))
    {
      echo "New record is inserted sucessfully";
    }
    else
    {
      echo "Error: ". $sql ."
      ". $conn->error;
    }
    $conn->close();
  }
}

  else 
  {
  echo "Email should not be empty";
  die();
  }
}
else
{
  echo "Password should not be empty";
  die();
}
}
else
{
  echo "Username should not be empty";
  die();
}
?>