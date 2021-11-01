<?php
  $book_isbn = $_GET['bookisbn'];
  // connec to database
  require_once "dbfunctions.php";
  require "dbconfig.php";


  $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Empty book";
    exit;
  }

  $title = $row['book_title'];
  require "header.php";
?>
<!-- Example row of columns -->
<div class="container">

  <p class="lead" style="margin: 25px 0"><a href="allbooks.php">Books</a> >
    <?php echo $row['book_title']; ?>
  </p>
  <div class="row">
    <div class="col-md-3 text-center">
      <img class="img-responsive img-thumbnail" src="./images/<?php echo $row['book_image']; ?>">
    </div>
    <div class="col-md-6">
      <h4>Book Description</h4>
      <p>
        <?php echo $row['book_descr']; ?>
      </p>
      <h4>Book Details</h4>
      <table class="table">
        <?php foreach($row as $key => $value){
              if($key == "book_descr" || $key == "book_image" || $key == "publisherid" || $key == "book_title"){
                continue;
              }
              switch($key){
                case "book_isbn":
                  $key = "ISBN";
                  break;
                case "book_title":
                  $key = "Title";
                  break;
                case "book_author":
                  $key = "Author";
                  break;
                case "book_price":
                  $key = "Price";
                  break;
              }
            ?>
        <tr>
          <td>
            <?php echo $key; ?>
          </td>

          <td>
            <?php 
                if($key == "Price")
                {echo '₹'. $value; }

                else
                echo $value;
                ?>
          </td>
        </tr>
        <?php 
              } 
              if(isset($conn)) {mysqli_close($conn); }
            ?>
      </table>
      <form method="post" action="cart.php">
        <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">

        <input type="submit" value="Add to Cart" name="cart" class="btn btn-primary">
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
<?php
  require "footer.php";
?>