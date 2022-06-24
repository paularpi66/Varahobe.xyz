<?php 
$conn   = new mysqli('localhost:3307', 'root', '', 'search');
if(isset($_GET['search'])){
     $searchKey = $_GET['search']; // grab keyword
     $sql    = "SELECT * FROM search WHERE name LIKE '%$searchKey%'";
}else
    $sql    = "SELECT * FROM search";
			
    $result = $conn->query($sql);
?>