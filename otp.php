<?php
session_start();
if(isset($_POST['save']))
{
    $rno=$_SESSION['otp'];
    $urno=$_POST['otpvalue'];
    if(!strcmp($rno,$urno))
    {
        $name=$_SESSION['name'];
        $email=$_SESSION['email'];
        $phone=$_SESSION['phone'];
        //For admin if he want to know who is register
        $to="example@gmail.com";
        $subject = "Thank you!";
        $txt = "Some one show your demo Email id: ".$email." Mobile number : ".$phone."";
        $headers = "From: studentstutorial@gmail.com" . "\r\n" .
        "CC: divyasundarsahu@gmail.com";
        mail($to,$subject,$txt,$headers);
        echo "<p>Thank you for show our Demo.</p>";
        //For admin if he want to know who is register
    }
    else{
        echo "<p>Invalid OTP</p>";
    }
}
//resend OTP
if(isset($_POST['resend']))
{
    $message="<p class='w3-text-green'>Sucessfully send OTP to your mail.</p>";
    $rno=$_SESSION['otp'];
    $to=$_SESSION['email'];
    $subject = "OTP";
    $txt = "OTP: ".$rno."";
    $headers = "From: otp@studentstutorial.com" . "\r\n" .
    "CC: divyasundarsahu@gmail.com";
    mail($to,$subject,$txt,$headers);
    $message="<p class='w3-text-green w3-center'><b>Sucessfully resend OTP to your mail.</b></p>";
}
?>