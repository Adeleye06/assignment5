<?php
   // Create connection
   $conn = mysqli_connect("localhost", "root", "", "webprogramming");
   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $sql = "delete from assignment5 where id ='$id'";
    if ($conn->query($sql)) {
        header("refresh:2; url=manageAccounts.php");
        die("Account was deleted");
    } else {
        die("Could not delete this account" .$conn->error);
    }
}

$conn->close();
?>