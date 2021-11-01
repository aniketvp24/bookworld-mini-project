<?php
    if (!function_exists("getUserIdbyEmail")){
        function getUserIdbyEmail($email){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $query = "SELECT * from user WHERE email = '$email'";
            $result = mysqli_query($conn, $query);
            // if there is customer in db, take it out
            if($result){
                $row = mysqli_fetch_assoc($result);
                return $row;
            } else {
                return null;
            }
        }
    }

    if (!function_exists("select4LatestBook")){
        function select4LatestBook($conn){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $row = array();
            $query = "SELECT book_isbn, book_image FROM books ORDER BY book_isbn DESC";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Can't retrieve data " . mysqli_error($conn);
                exit;
            }
            for($i = 0; $i < 4; $i++){
                array_push($row, mysqli_fetch_assoc($result));
            }
            return $row;
        }
    }

    if (!function_exists("selectBestSellerBook")){
        function selectBestSellerBook($conn){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $row = array();
            $query = "SELECT book_isbn, book_image FROM books  where `books`.`book_id` > 4 ORDER BY book_isbn";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Can't retrieve data " . mysqli_error($conn);
                exit;
            }
            for($i = 0; $i < 4; $i++){
                array_push($row, mysqli_fetch_assoc($result));
            }
            return $row;
        }
    }

    if (!function_exists("getAll")){
        function getAll($conn){
            $query = "SELECT * from books ORDER BY book_isbn DESC";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Can't retrieve data " . mysqli_error($conn);
                exit;
            }
            return $result;
        }
    }

    if (!function_exists("getPubName")){
        function getPubName($conn, $pubid){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $query = "SELECT publisher_name FROM publisher WHERE publisherid = '$pubid'";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Can't retrieve data " . mysqli_error($conn);
                exit;
            }
            if(mysqli_num_rows($result) == 0){
                echo "Not Set";
            }
    
            $row = mysqli_fetch_assoc($result);
            return $row['publisher_name'];
        }
    }

    if (!function_exists("getCatName")){
        function getCatName($conn, $catid){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $query = "SELECT category_name FROM category WHERE categoryid = '$catid'";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Can't retrieve data " . mysqli_error($conn);
                exit;
            }
            if(mysqli_num_rows($result) == 0){
                echo "Not Set";
            }
    
            $row = mysqli_fetch_assoc($result);
            return $row['category_name'];
        }
    }

    if (!function_exists("getAllPublishers")){
        function getAllPublishers($conn){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $query = "SELECT * from publisher ORDER BY publisher_name ASC";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Can't retrieve data " . mysqli_error($conn);
                exit;
            }
            return $result;
        }
    }

    if (!function_exists("getAllCategories")){
        function getAllCategories($conn){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $query = "SELECT * from category ORDER BY category_name ASC";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Can't retrieve data " . mysqli_error($conn);
                exit;
            }
            return $result;
        }
    }

    if (!function_exists("getBookByIsbn")){
        function getBookByIsbn($conn, $isbn){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $query = "SELECT book_title, book_author, book_price FROM books WHERE book_isbn = '$isbn'";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Can't retrieve data " . mysqli_error($conn);
                exit;
            }
            return $result;
        }
    }
    if (!function_exists("getCartId")){
        function getCartId($conn, $customerid){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $query = "SELECT id FROM cart WHERE customerid = '$customerid'";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "retrieve data failed!" . mysqli_error($conn);
                exit;
            }
            $row = mysqli_fetch_assoc($result);
            return $row['id'];
        }
    }
    
    if (!function_exists("insertIntoCart")){
        function insertIntoCart($conn, $customerid,$date){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $query = "INSERT INTO cart(customerid,date) VALUES('$customerid','$date') ";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Insert Cart failed " . mysqli_error($conn);
                exit;
            }
        }
    }
    if (!function_exists("getbookprice")){
        function getbookprice($isbn){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $query = "SELECT book_price FROM books WHERE book_isbn = '$isbn'";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "get book price failed! " . mysqli_error($conn);
                exit;
            }
            $row = mysqli_fetch_assoc($result);
            return $row['book_price'];
        }
    }
    if (!function_exists("getCustomerId")){
        function getCustomerId($name, $address, $city, $zip_code, $country){
            $conn = mysqli_connect("localhost", "root", "", "booksworld");
            $query = "SELECT user_id from user WHERE 
            name = '$name' AND 
            address= '$address' AND 
            city = '$city' AND 
            zip_code = '$zip_code' AND 
            country = '$country'";
            $result = mysqli_query($conn, $query);
            // if there is customer in db, take it out
            if($result){
                $row = mysqli_fetch_assoc($result);
                return $row['customerid'];
            } else {
                return null;
            }
        }
    }
?>
