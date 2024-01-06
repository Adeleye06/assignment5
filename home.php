<?php
    $image =  '';
    $username = '';
    session_start();

    if(isset($_SESSION['username'])){
        $image = $_SESSION['image'];
        $username = $_SESSION['username'];
        
        if(isset($_REQUEST['logout'])){
            session_unset();
            session_destroy();
            header('refresh:2; url=login.php');
            die('YOU LOGGED OUT SUCCESSFULLY');
        }
    }else{
        header('refresh: 2; url=login.php');
        die('Please Log in before you view page');
    }

print"
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
</head>
<body style='background-image: url(img/{$image}.jpg);  background-repeat: no-repeat; background-size: cover; background-attachment: fixed;'>
    <h1> Welcome {$username}</h1>
    <a href='manageAccounts.php'>Manage Accounts</a>
    <a href='home.php?logout'>Log out</a>
    
</body>
</html>
";
?>



