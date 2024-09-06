<?php
require_once ('config.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
$msg='';
$fullname=mysqli_real_escape_string($con,trim($_POST['fullname']));
$email=mysqli_real_escape_string($con,trim($_POST['email']));
$username=mysqli_real_escape_string($con,trim($_POST['username']));
$password=mysqli_real_escape_string($con,trim($_POST['password']));


// if(isset($_POST['done'])){
// $fullname=$_POST['fullname'];
// $email=$_POST['email'];
// $username=$_POST['username'];
// $password=$_POST['password'];


$fullname_valid=$email_valid=$username_valid= $password_valid =0;

if(!empty($fullname)){
    if(strlen($fullname)>=3 && strlen($fullname)<=30){
        if(!preg_match('/[^a-zA-Z\s]/',$fullname)){

            $fullname_valid=1;
        }else{$msg.="full name can contain lett";}
    }else{$msg.="fullname must between 3&&30";}
}else{$msg.="fullname cant be blank <br>";}


if(!empty($email)){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_valid=true;
       
            $fullname_valid=1;
    
}else{$msg.="email is an invalid email";}
}else{$msg.="email cant not blank <br>";}

if(!empty($username)){
    if(strlen($username)>4 && strlen($username)<=15){
        if(preg_match('/^[a-z]\w{2,23}[^_]$/i',$username)){
            $query="SELECT username FROM users WHERE username='$username'";
            $fire=mysqli_query($con,$query) or die("cannot fire");

            if(mysqli_num_rows($fire)>0){
                $msg.="username already Taken <br>";
            }
            else{
                $username_valid=1;
            }
        }else{ $msg.="invalid username";}
    }else{ $msg.="username must be <4 and >15";}
}else{$msg.="username cant bank";}

//password
if(!empty($password)){
    if(strlen($password)<6 && strlen($password)>=16){
        $password_valid=1;
        $password=md5($password);
    }else{$msg.="password must..<br> ";}
}else{$msg.="password cant be blank <br>";}
 b 


if($fullname_valid && $email_valid && $username_valid && $password_valid=1){
$sql="INSERT INTO users(fullname,email,username,password)VALUES('$fullname','$email','$username','$password')";

$result=mysqli_query($con,$sql) or die("cannot ...");
if($result){
  $msg.="Data submit sucessful";
 
}else{ echo "Data unablle to sumit ";}
}else{ echo "$msg";}
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration</title>
</head>
<body>
    <form action="" method="POST">
    <h1>registration</h1>
    
    
    Fullname:<input type="text" name="fullname"><br><br>
    Email:<input type="email" name="email"><br><br>
    username:<input type="text" name="username"><br><br>
    password:<input type="password" name="password"><br><br>
    <!-- confrimpwd:<input type="password" name="cpassword"><br><br> -->
<input type="submit" name="submit">   
</form>
</body>
</html>