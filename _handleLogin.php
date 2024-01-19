<?php
$showError = "Invalid Credentials";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];
    $sql = "Select * from users where user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail'] = $email;
            $_SESSION['username'] = $row['username'];
            echo "logged in". $email;
            header("Location: /subham/forum/index.php");
            exit();
        }  
        else{
                 $showError = "Invalid Credentials";
            }

        } 
    }
else{
             $showError = "Invalid Credentials";
}
header("Location: /subham/forum/index.php?signupsuccess=false&error=$showError");  
?>