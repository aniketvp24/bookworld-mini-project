<?php	
	// if save change happen
	if(!isset($_POST['save_change'])){
		echo "Something wrong!";
		exit;
	}

	$publisher = trim($_POST['name']);
	$id = trim($_POST['id']);

    require_once("dbfunctions.php");
	$conn = mysqli_connect("localhost", "root", "", "booksworld");


	$query = "UPDATE publisher SET  
	publisher_name = '$publisher' where publisherid='$id'";
	
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't update data " . mysqli_error($conn);
		exit;
	} else {
		header("Location: admin_publishers.php?bookisbn=$isbn");
	}
?>