<?php
$count = 0;
// connecto database
require_once "dbfunctions.php";
require_once 'header.php';
$conn = mysqli_connect("localhost", "root", "", "booksworld");
if(isset($_POST['title'])){
  if(isset($_POST['asc'])){
    $query = "SELECT * FROM books order by book_title asc";

  }
  else if(isset($_POST['desc'])){
    $query = "SELECT * FROM books order by book_title desc";
  }else{
    $query = "SELECT * FROM books";
  }
}else if(isset($_POST['price'])){
  if(isset($_POST['asc'])){
    $query = "SELECT * FROM books order by book_price asc";

  }
  else if(isset($_POST['desc'])){
    $query = "SELECT * FROM books order by book_price desc";
  }else{
    $query = "SELECT * FROM books";
  }
}else if(isset($_POST['author'])){
  if(isset($_POST['asc'])){
    $query = "SELECT * FROM books order by book_author asc";

  }
  else if(isset($_POST['desc'])){
    $query = "SELECT * FROM books order by book_author desc";
  }else{
    $query = "SELECT * FROM books";
  }
}else{
  $query = "SELECT * FROM books";
}

$result = mysqli_query($conn, $query);
$title = "Full Catalogs of Books";

?>
<div class="container mt-4">
<p class="lead text-center" style="font-family: 'Source Code Pro', monospace">Full Catalogs of Books</p>
<h5 class="lead text-muted">Sort By:</h5>

<form method="post" action="allbooks.php">
  <div class="radio mt-2 mb-2">
    <label><input type="radio" name="asc" >Ascending</label>
  </div>
  <div class="radio mt-2 mb-2">
    <label><input type="radio" name="desc">Descending</label>
  </div>

  <button type="submit" class="btn btn-secondary" name="title">Title</button>
  <button type="submit" class="btn btn-secondary" name="price">Price</button>
  <button type="submit" class="btn btn-secondary" name="author">Author</button>
  <button type="submit" class="btn btn-secondary" name="clear">Clear</button>
  
</form>

<br><br>

    <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      <div class="row">
        <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
          <div class="col-md-3">
            <a href="book.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
              <img class="img-responsive img-thumbnail" src="./images/<?php echo $query_row['book_image']; ?>">
              </a>
              <table>
                <tr>
                  <td><strong>  <?php echo $query_row['book_title']; ?></strong></td>
                </tr>
                <tr>
                <td> <?php echo $query_row['book_author']; ?></td>
                </tr>
                <tr>
                <td><strong>₹<?php echo $query_row['book_price'];?></strong>  </td>
                </tr>
              </table>
            </div>
        <?php
          $count++;
          if($count >= 4){
              $count = 0;
              break;
            }
          } ?> 
      </div>
      <br><br>
<?php
      }

      ?>
</div>












  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
    crossorigin="anonymous"></script>
<?php
if(isset($conn)) {mysqli_close($conn);}
require_once 'footer.php';
?>