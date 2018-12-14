<?php
//begins a new session
 session_start();
 include 'inc/dbConnection.php';
 $dbConn = startConnection("final_project");
 validateSession();

//DROP DOWN TO DISPLAY GENERES
function displayGenres() { 
    global $dbConn;
    
    $sql = "SELECT * FROM proj_genres ORDER by genName";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    foreach ($records as $record) {
        echo "<option value='".$record['genreId']."'>" . $record['genName'] . "</option>";//genreId is type of product
    }
}


//WAY TO SEARCH/FILTER PRODUCTS
function filterMovies() {
    global $dbConn;
    $movie = $_GET['movieName'];
    
    if(isset($_GET['searchForm'])) {
        
        echo "<h3>Products Found: </h3>";
        
        $namedParameters = array();
        //$product = $_GET['productName'];
        
        //This SQL works but it doesn't prevent SQL injection (due to single quotes)
        //$sql = "SELECT * FROM om_product 
        //       WHERE productName LIKE '%$product%'";
        
        $sql = "SELECT * FROM proj_products WHERE 1"; //Getting all records from database
        
        if(!empty($movie)){
            //This SQL prevents SQL INJECTION by using a named parameter 
            $sql .= " AND (title LIKE :movie 
                      OR actors LIKE :movie
                      OR director LIKE :movie)";
            $namedParameters[':movie'] = "%$movie%";
        }
        
        if(!empty($_GET['genre'])){
            //This SQL prevents SQL INJECTION by using a named parameter
            $sql .= " AND genreId = :genre";
            $namedParameters[':genre'] = $_GET['genre'];
        }
        
        if (isset($_GET['searchBy'])) {
            
            if($_GET['searchBy'] == "nameOrder") {
                $sql .= " ORDER BY title";
            } else if($_GET['searchBy'] == "ratingOrder") {
                $sql .= " ORDER BY ratingId";
            } else {
                $sql .= " ORDER BY year";
            }
            
            if (isset($_GET['orderBy'])) {
            
                if($_GET['orderBy'] == "dc") {
                    $sql .= " DESC";
                } else {
                    $sql .= " ASC";
                }
                
            }
            
        }
        
        //}
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($records);
        
        
        //Creating a table
        echo "<table class='table'>";
        
        foreach($records as $record){
            
            // echo "<a href='movieInfo.php?movId=".$record['movId']."'>";
            // echo $record['title'];
            // echo "</a> ";
            // echo "<br>";
            // echo "Director: " . $record['director'] . "<br> Starring: " . $record['actors'] . "<br>";
            // echo "<br>";
            
            
            //Putting them in variables to avoid having to concatenate strings later
            $itemName = $record['title'];//name
            $itemDirector = $record['director'];//brand name
            $itemActors = $record['actors'];//description
            $itemImage = $record['image'];
            $itemId = $record['movId'];//order in database
            $itemRating = $record['ratingId'];
            $itemYear = $record['year'];//price
            $productId = $record['movId'];
            
            //Displaying things as a table
            echo "<tr>";
            echo "<td> <img src='$itemImage' width=50> </td>";
            echo "<td> <h4> <a href='productDetails.php?movId=".$record['movId']."'> $itemName </a> </h4> </td>";
            echo "<td> <h4>Price:$$itemYear</h4> </td>";
            echo "<td> <h4>Brand: $itemDirector</h4> </td>";
            echo "<td> <h4>Description: $itemActors</h4> </td>";
            echo "<td> <h4>Rating: $itemRating Stars</h4> </td>";
            
            
            //Hidden elements
            echo "<form method='POST'>";
            echo "<input type='hidden' name='itemName' value='$itemName'>";
            echo "<input type='hidden' name='itemDirector' value='$itemDirector'>";
            echo "<input type='hidden' name='itemActors' value='$itemActors'>";
            echo "<input type='hidden' name='itemRating' value='$itemRating'>";
            echo "<input type='hidden' name='itemImage' value='$itemImage'>";
            echo "<input type='hidden' name='itemYear' value='$itemYear'>";
            echo "<input type='hidden' name='itemId' value='$itemId'>";
            
            //Check to see if the item we added is the most recent POST itemId
            //and change button accordingly
            if ($_POST['itemId'] == $itemId) {
                echo "<td> <button class='btn btn-success'> Added </button> </td>";
            } else {
                echo "<td> <button class='btn btn-warning'> Add </button> </td>";
            }
            echo "</form>";
            
            
            echo "</tr>";
            
        }
        
        echo "</table>";
    
    }
    
}

//this display the  product info page 
function displayProductInfo(){
    global $dbConn;
    
    
    $movId = $_GET['movId'];
    $sql = "SELECT *
            FROM proj_products
            WHERE movId = $movId";

    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAll returns an Array of Arrays
    
    //echo $records[0]['productName'] . "<br>";
    echo "<img src='" . $records[0]['image'] . "'  width='200'/><br>";
    
    foreach ($records as $record) {
        echo "<br><br>";
        echo "<strong>Product: </strong>";
        
        echo $record[title];
        echo "<br><br>";
        echo "<strong>Price: $</strong>";
        
        echo $record[year]; 
        echo "<br><br>";
        echo "<strong>Brand: </strong>"; 
        
        echo $record[director]; 
        echo "<br><br>";
        echo "<strong>Description:</strong>"; 
        echo "<br>";
        echo $record[actors]; 
        echo "<br><br>";
        echo "<strong>Rating: </strong>";
        
        echo $record[ratingId];
        echo " Stars <br><br>";
        echo "<br><br>";
    }
    
    // echo "<table>";
    // echo "<tr>";
    // echo "<th>Title </th><th>Year </th><th>Actors</th>";
        
    // foreach ($records as $record) {
    //     echo "<tr>";    
    //     echo "<td>" . $record[title] . "</td>";
    //     echo "<td>" . $record[year] . "</td>";
    //     echo "<td>" . $record[actors] . "</td>";
    //     echo "</tr>";
    // }
    // echo "</table>";
    
    
    //print_r($records);
}

///////////////////////////////
//SESSION FOR ADMIN PAGE
function validateSession(){
    if (!isset($_SESSION['adminFullName'])) {
        header("Location: index.php");  //redirects users who haven't logged in 
        exit;
    }
}

function displayAllProducts(){
    global $dbConn;
    
    $sql = "SELECT * FROM proj_products ORDER BY title";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //we're expecting multiple records

    foreach ($records as $record) {
        echo "<a class='btn btn-primary' role='button' href='updateProduct.php?productId=".$record['movId']."'>Update</a>";
        //echo "[<a href='deleteProduct.php?productId=".$record['productId']."'>Delete</a>]";
        echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
        echo "   <input type='hidden' name='productId' value='".$record['movId']."'>";
        echo "   <button class='btn btn-outline-danger' type='submit'>Delete</button>";
        echo "</form>";
        
        echo "[<a onclick='openModal()' target='productModal'
        href='productInfo.php?productId=".$record['movId']."'>".$record['title']."</a>]  ";
        echo " $" . $record['year']   . "<br><br>";
        
    }
}

function getCategories() {
    global $dbConn;
    
    $sql = "SELECT * FROM proj_genres ORDER BY genName";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //we're expecting multiple records   
    
    //print_r($records);
    
    return $records;
    
}

function getProductInfo($productId) {
    global $dbConn;
    
    $sql = "SELECT * FROM proj_products WHERE movId = $productId";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //we're expecting multiple records   
    return $record;
}


function displayResults() {
    global $items;
    
    if (isset($items)) {
        echo "<table class = 'table'>";
        foreach ($items as $item) {
            $itemName = $item['name'];
            $itemPrice = $item['salePrice'];
            $itemImage = $item['thumbnailImage'];
            $itemId = $item['itemId'];
            
            //display a row
            
            echo '<tr>';
            echo "<td><img src = '$itemImage'></td>";
            echo "<td><h4>$itemName</h4></td>";
            echo "<td><h4>$itemPrice</h4></td>";
            
            //hidden input element containing item name
            echo "<form method = 'post'>";
            echo "<input type = 'hidden' name = 'itemName' value = '$itemName'>";
            echo "<input type = 'hidden' name = 'itemId' value = '$itemId'>";
            echo "<input type = 'hidden' name = 'itemImage' value = '$itemImage'>";
            echo "<input type = 'hidden' name = 'itemPrice' value = '$itemPrice'>";
            
                if($_POST['itemId'] == $itemId) {
                    echo '<td><button class ="btn btn-success">Added</button></td>';
                } else {
                    echo '<td><button class = "btn btn-warning">Add</button></td>';
                }
            echo "</tr>";    
            echo "</form>";
        }
        echo "</table>";
    }

}
?>
