<?php
include("dbconfig.php");
session_start();
    require_once "dbfunctions.php";
    if(isset($_SESSION['email'])) {
      $user = getUserIdbyEmail($_SESSION['email']);
      $name = $user['firstName'];
    }
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
  <link rel="stylesheet" href="custom.css">
  <title>BooksWorld - Online Book Store!</title>
</head>

<body class="bg-home">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid contain">
      <a class="navbar-brand" href="#"><b class="logo-txt">BooksWorld!</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <?php
          if(isset($_SESSION['email'])) {
            $user = getUserIdbyEmail($_SESSION['email']);
            $name = $user['firstName'];
            if($name=="admin") {
              echo "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>$name</a><ul class='dropdown-menu' aria-labelledby='navbarDropdown'><li><a class='dropdown-item' href='admin_dash.php'>Admin Dashboard</a></li><li><a class='dropdown-item' href='logout.php'>Logout</a></li></ul></li>";
            } else {
              echo "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>$name</a><ul class='dropdown-menu' aria-labelledby='navbarDropdown'><li><a class='dropdown-item' href='logout.php'>Logout</a></li></ul></li>";
            }
            

          } else {

            echo "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>My Account</a><ul class='dropdown-menu' aria-labelledby='navbarDropdown'><li><a class='dropdown-item' href='login.php'>Login</a></li><li><a class='dropdown-item' href='signup.php'>Sign up</a></li></ul></li>";
          }
          ?>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>