<?php
    require "header.php";
    $conn = mysqli_connect("localhost", "root", "", "booksworld");
?>
<div class="container mt-4" style="min-height: 800px;">

    <table class="table">
        <tr><th>Customer ID</th>
        <th>Customer Name</th>
        <th>Book</th>
        <th>Quantity</th></tr>
<?php
        $query="SELECT * FROM cart join cartitems join books join user
		on user.user_id = cart.customerid and cart.id=cartitems.cartid and  cartitems.productid=books.book_isbn";
	    $result=mysqli_query($conn,$query);
        for($i = 0; $i < mysqli_num_rows($result); $i++){
			
			while($query_row = mysqli_fetch_assoc($result)){
                echo '<tr><td>';
                echo $query_row['user_id'];
                echo '</td>';
                echo '<td>';
                echo $query_row['firstName']." ".$query_row['lastName'];
                echo '</td>';
                echo '
				<td>
				<a href="book.php?bookisbn=';
				echo $query_row['book_isbn'];
				echo '">';
				echo '<img style="height:100px;width:80px"class="img-responsive img-thumbnail" src="images/';
				echo $query_row['book_image'];
				echo '">';
				echo ' </a>
				</td>
				<td>';
				echo $query_row['quantity'];
				echo '
				</td></tr>';

			}
		}
?>



    </table>



</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
    crossorigin="anonymous"></script>
<?php
    require "footer.php";
?>