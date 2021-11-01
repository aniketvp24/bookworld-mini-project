<?php
require 'dbfunctions.php';
require 'header.php';
$conn = mysqli_connect("localhost", "root", "", "booksworld");
	$result = getAllPublishers($conn);
?>


<div class="container" style="min-height: 800px; margin-top: 20px;">
    <div style="margin-top: 10px;">

        <a href="admin_dash.php" class="btn btn-primary"><span
                class="glyphicon glyphicon-paperclip"></span>&nbsp;Books</a>
        <a href="admin_categories.php" class="btn btn-primary"><span
                class="glyphicon glyphicon-list-alt"></span>&nbsp;Categories</a>
        <?php
	if (isset($_SESSION['email'])=="admin"){
		echo '<a class="btn btn-primary" href="admin_add.php">&nbsp;Add Book</a>';
	}
	?>
    </div>
    <table class="table" style="margin-top: 20px;">
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td>
                <?php echo $row['publisher_name']; ?>
            </td>
            <?php
				if( isset($_SESSION['email'])=="admin"){
					echo '<td><a href="admin_editpublishers.php?pubid=';
					echo $row['publisherid'];
					echo'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                  </svg>Edit</a></td>';
				}
                if (isset($_SESSION['email'])=="admin"){
					echo '<td><a href="admin_deletepublishers.php?pubid=';
					echo $row['publisherid'];
					echo '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                  </svg>Delete</a></td>';
				}
			?>

        </tr>
        <?php } ?>
    </table>
    <?php
    if (isset($_SESSION['email'])=="admin"){
		echo '<a class="btn btn-primary" href="admin_addpublisher.php"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>&nbsp;Add Publisher</a>';
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