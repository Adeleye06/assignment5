<?php
    session_start();

    if(isset($_SESSION['username'])){
           // Create connection
    $conn = mysqli_connect("localhost", "root", "", "webprogramming");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

        $sql = "select id,username, password, picture from assignment5";
        $result = $conn->query($sql);
        if($result->num_rows < 1){
            die("No Accounts Found");
        }

        if(isset($_REQUEST['logout'])){
            session_unset();
            session_destroy();
            header('refresh:2; url=login.php');
            die('YOU LOGGED OUT SUCCESSFULLY');
        }
    }else{
        header('refresh:2; url=login.php');
        die('Please Login ');
    }

print "<h1> Welcome {$_SESSION['username']}</h1>\n<table border=2>\n";
while($row = $result->fetch_assoc()){
    $id=$row['id'];
    $username = $row['username'];
    $password = $row['password'];
    $picture = $row['picture'];

    print "<tr><td>$id</td><td>$username</td><td>$password</td>";
    print "<td><a href='deleteAccount.php?id=$id'> <button>Delete</button></a>";
    print "<a href='editAccount.php?id=$id'><button>Edit</button></a></td></tr>";

}
print "</table>";
print "<a href='home.php?logout'>Log out</a>";
?>