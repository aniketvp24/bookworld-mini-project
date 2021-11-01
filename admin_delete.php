<?php
	$book_isbn = $_GET['bookisbn'];

	require_once "dbfunctions.php";
	$conn = mysqli_connect("localhost", "root", "", "booksworld");

	$query = "DELETE FROM books WHERE book_isbn = '$book_isbn'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: admin_dash.php");
?>