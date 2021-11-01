<?php
require 'dbfunctions.php';
require 'header.php';
$conn = mysqli_connect("localhost", "root", "", "booksworld");
$result = getAll($conn);
?>

<div style="margin-left: 5px; margin-top: 10px;">
    <h2 style="text-align: center; font-family: 'Source Code Pro', monospace">Admin Dashboard</h2>
    <a href="admin_publishers.php" class="btn btn-primary"><span
            class="glyphicon glyphicon-paperclip"></span>&nbsp;Publishers</a>
    <a href="admin_categories.php" class="btn btn-primary"><span
            class="glyphicon glyphicon-list-alt"></span>&nbsp;Categories</a>
            <a href="orders.php" class="btn btn-primary"><span
            class="glyphicon glyphicon-list-alt"></span>&nbsp;Orders</a>
    <?php
	if (isset($_SESSION['email'])=="admin"){
		echo '<a class="btn btn-primary" href="admin_add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Book</a>';
	}
	?>
</div>
<table class="table" style="margin-top: 20px; margin-left: 2px; margin-right: 2px;">
    <tr>
        <th>ISBN</th>
        <th>Title</th>
        <th>Author</th>
        <th>Image</th>
        <th>Description</th>
        <th>Price</th>
        <th>Publisher</th>
        <th>Category</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)){ ?>
    <tr>
        <td>
            <?php echo $row['book_isbn']; ?>
        </td>
        <td>
            <?php echo $row['book_title']; ?>
        </td>
        <td>
            <?php echo $row['book_author']; ?>
        </td>
        <td>
            <?php echo $row['book_image']; ?>
        </td>
        <td>
            <?php echo $row['book_descr']; ?>
        </td>
        <td>
            <?php echo $row['book_price']; ?>
        </td>
        <td>
            <?php echo getPubName($conn, $row['publisherid']); ?>
        </td>
        <td>
            <?php echo getCatName($conn, $row['categoryid']); ?>
        </td>
        <?php
				if( isset($_SESSION['email'])=="admin"){
					echo '<td><a href="admin_edit.php?bookisbn=';
					echo $row['book_isbn'];
					echo'"><span class="glyphicon glyphicon-pencil"></span>Edit</a></td>';
				}
                if(isset($_SESSION['email'])=="admin"){
					echo '<td><a href="admin_delete.php?bookisbn=';
					echo $row['book_isbn']; 
					echo '"><span class="glyphicon glyphicon-trash"></span>Delete</a></td>';
				}
			?>

    </tr>
    <?php } ?>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
    crossorigin="anonymous"></script>
<?php
if(isset($conn)) {mysqli_close($conn);}
require 'footer.php';
?>