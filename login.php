<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css">
    <title>Login</title>
</head>

<body class="bg-login">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid contain">
            <a class="navbar-brand" href="#"><b class="logo-txt">BooksWorld!</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php">Home</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="login.php">Log in</a></li>
                            <li><a class="dropdown-item" href="signup.php">Sign up</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
<?php

include("dbconfig.php");  
session_start();
if(isset($_SESSION['email'])) {
    header("Location: home.php");
  }
  else {

if(isset($_POST['login']))  
{  
    $loginemail = $_POST['loginEmail'];  
    $loginpass = md5($_POST['loginPass']);  
  
    $check_user = "SELECT * FROM `user` WHERE email = '$loginemail' AND password = '$loginpass'";  
    $run = mysqli_query($conn, $check_user);  
    if(mysqli_num_rows($run))  
    {  
        if($loginemail == "admin") {
            echo '<script>alert("Login success!")</script>';
            echo "<script>window.open('admin_dash.php','_self')</script>";  
            $_SESSION['email']="admin";  
        } else {
        echo '<script>alert("Login success!")</script>';
        echo "<script>window.open('home.php','_self')</script>";  
        $_SESSION['email']=$loginemail;  
        }
    }  
    else  
    {  
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert"><strong>Incorrect Email ID or password! Please try again.</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';  
    }  
}  }

?>

    <div class="container-fluid loginForm mt-4">
        <form method="post" action="">
            <h5 style="text-align: center; font-family: 'Source Code Pro', monospace;">Login Page</h5>
            <div class="mb-3 mt-4">
                <label for="loginEmail" class="form-label">Email address</label>
                <input type="text" class="form-control" id="loginEmail" aria-describedby="emailHelp" name="loginEmail">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="loginPass" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPass" name="loginPass">
            </div>
            <div class="btn-center">
                <button type="submit" class="btn btn-primary" style="align-items: center;" name="login">Login</button>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>