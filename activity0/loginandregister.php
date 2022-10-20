<?php

session_start();

error_reporting(0);

$conn = new mysqli("localhost","root","","activity0");

if(!$conn){
    die ("<script>alert('Connection failed!!')</script>");
}

//register
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if($password == $cpassword){
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn,$sql);
        if($result ->num_rows > 0){
            echo "<script>alert('Oooops! Username already exists.')</script>";
        }else{
            $sql = "INSERT INTO users(firstname, lastname, username,email,password,gender) VALUES ('$firstname','$lastname','$username','$email','$password','$gender')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "<script>alert('Congratutations! You are now registered.')</script>";
                $firstname = "";
                $lastname = "";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
                $gender = "";
            }else{
                echo "<script>alert('Oooops! Something went wrong.')</script>";
            }
        }
  
    }else{
       echo "<script>alert('Password does not match.')</script>"; 
    }
}

//login
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn,$sql);
    if($result ->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['user'] = $row['username'];
        header("Location: homepage.php");
    }else{
        echo "<script>alert('Oooops! email or password is wrong.')</script>";
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="https://kit.fontawesome.com/1c3de9b1bb.js" crossorigin="anonymous"></script>
  <title>Login and Registration page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Great+Vibes" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <link rel="stylesheet" type="text/css" href="activity0.css">

   
    
  </head>
  <body>
  <a href="#" class="logo">Nguø</a>
      
    <div class="one">

<div class="form-box">
    <div class="button-box">
        <div id="btn"></div>
        <button type="button" class="toggle-btn" onclick="login()">Login</button>
        <button type="button" class="toggle-btn" onclick="register()">Register</button>
    </div>
    <div class="social-icons1">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
    </div>
    <form id="login" class="input-group" method="POST">
        <input type="text" class="input-field" placeholder="Email Address" name="email" required>
        <input type="password" class="input-field" placeholder="Password" name="password" required>
        <span>Remember password</span><input type="checkbox" class="checkbox">
        <button type="submit" class="submit-btn" name="login"> Login </button><br>
    </form>
    <form id="register" class="input-group" method="POST">
        <input type="text" class="input-field" placeholder="Username" name="username" required>
        <input type="text" class="input-field" placeholder="Firstname" name="firstname" required>
        <input type="text" class="input-field" placeholder="Lastname" name="lastname" required>
        <input type="email" class="input-field" placeholder="Email Address" name="email" required>
        <input type="password" class="input-field" placeholder="Password" name="password" required>
        <input type="password" class="input-field" placeholder="Confirm Password" name="cpassword" required>
        <label for="male">Male</label>
        <input type="radio" id="male" name="gender" value="male">
        <label for="female">Female</label>
        <input type="radio" id="female" name="gender" value="female"><br>
        <span>I agree to the terms & conditions</span><input type="checkbox" class="checkbox">
        <button type="submit" class="submit-btn" name="register"> Register</button>
    </form>
</div>
</div>
<script src="loginandregister.js"></script>
  </body>
</html>