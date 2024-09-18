<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $salt="codeflix";
    $password_ecrypted=sha1($password.$salt);


    $hashedPassword=password_hash($password,PASSWORD_BCRYPT);


    $conn= new mysqli('localhost','root','','auth');

    if($conn->connect_error){
        die("connect Failed".$conn->connect_error);

    }

    //$query="select * from login where username='$username' and password='".$password_encrypted."'";
    $query1="update login set password='$password_encrypted' where password='$hashedPassword'";


    $result=$conn->query($query1);
    
    if($result){
        header("Location: success.html");
    exit();
    }
    else{
        echo`$password_encrypted`;
    }
}
