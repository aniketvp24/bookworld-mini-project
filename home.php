<?php
include("dbconfig.php");
  session_start();
    require "dbfunctions.php";
    if(isset($_SESSION['email'])) {
      $user = getUserIdbyEmail($_SESSION['email']);
      $name = $user['firstName'];
    }
    $row = select4LatestBook($conn);
    $rw = selectBestSellerBook($conn);
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
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            <!-- </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li> -->
            <?php
          if(isset($_SESSION['email'])) {
            $user = getUserIdbyEmail($_SESSION['email']);
            $name = $user['firstName'];
            if($name=="admin") {
              echo "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>$name</a><ul class='dropdown-menu' aria-labelledby='navbarDropdown'><li><a class='dropdown-item' href='admin_dash.php'>Admin Dashboard</a></li><li><a class='dropdown-item' href='logout.php'>Logout</a></li></ul></li>";
            } else {
              echo "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>$name</a><ul class='dropdown-menu' aria-labelledby='navbarDropdown'><li><a class='dropdown-item' href='cart.php'>My Cart</a></li><li><a class='dropdown-item' href='logout.php'>Logout</a></li></ul></li>";
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
  <div class="container-fluid contain">
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="book-case.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h2>Welcome to BooksWorld!</h2>
            <p>Get all your favourite books at one destination.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="choosebooks.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h2>Wide variety of books.</h2>
            <p>Choose from a wide variety of categories!</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="orderonline.png" class="d-block w-100" alt="...">
          <div class="carousel-caption d-md-block">
            <h2>Order online. Hassle free!</h2>
            <p>Your books will be delivered to you at your doorsteps just by few clicks!</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>


  <div class="container-fluid">
    <div class="container-fluid bookcat row mt-4">
      <div class="col-3 border">
        <h6 class="mt-2">Browse by category</h6>
        <ul>
          <form method='post' action='bookPerCat.php'>
            <?php
            $category_query = "SELECT category_name, categoryid FROM category ORDER By category_name ASC;";
            $result_cat=mysqli_query($conn, $category_query);
            while($query_row = mysqli_fetch_assoc($result_cat)){
              echo "<br><label style='margin-left: -20px'><input type ='radio' name='catid' value='".$query_row['categoryid']."'>&nbsp;&nbsp;&nbsp;&nbsp;".$query_row['category_name']."</label>";
            }
          ?>
            <br><br>
            <div class="text-center" style="margin-left: -50px;">
              <button class="btn btn-outline-success" type="submit"
                value="catid">Search</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-outline-success"
                onclick="location.href='allbooks.php'" type="button">View All Books</button>
            </div><br>

          </form>
          <br>

        </ul>

      </div>
      <div class="col-9 border">
        <div class="row mt-2 mb-4">
          <h6 class="mb-4">Our latest books</h6>
          <?php foreach($row as $book) { ?>
          <div class="col-md-3">
            <a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
              <img class="img-responsive img-thumbnail" src="./images/<?php echo $book['book_image']; ?>">
            </a>
          </div>
          <?php } ?>
        </div>

        <div class="row mt-2 mb-4">
          <h6 class="mb-4 mt-2">Bestsellers</h6>
          <?php foreach($rw as $book) { ?>
          <div class="col-md-3">
            <a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
              <img class="img-responsive img-thumbnail" src="./images/<?php echo $book['book_image']; ?>">
            </a>
          </div>
          <?php } ?>
        </div>
      </div>

    </div>

  </div>

  <footer class="page-footer font-small blue">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 mt-2">© 2020-2021 BooksWorld, Inc.&nbsp;&nbsp;
      <a href="#">Back to top</a>
    </div>
    <!-- Copyright -->

  </footer>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    -->
</body>

</html>