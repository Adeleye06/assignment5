<?php
    $image =  '';
    session_start();

    if(isset($_SESSION['username'])){
        $id = $_REQUEST['id'];
            // Create connection
    $conn = mysqli_connect("localhost", "root", "", "webprogramming");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        $sql = "select username,password, picture from assignment5 WHERE id='$id'";
        $result = $conn->query($sql);

        if($result->num_rows > 1){
            die("We found multiple accounts");
            header("refresh:3; url=editAccount.php");
        }

        $account = $result->fetch_assoc();

        if(isset($_REQUEST['submit'])){
            $username = $conn->real_escape_string($_POST["username"]);
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $image = $conn->real_escape_string($_POST["image"]);

            $editSql = "UPDATE assignment5 SET username='$username', password='$password', picture='$image' WHERE id='$id'";
            if($conn->query($editSql) === FALSE){
                header("refresh:2; url=manageAccounts.php");
                die("UNABLE TO EDIT");
            }else{
                header('refresh:3;');
                die("Update Successful. Refreshing");
            }
        }
    } else{
        header('refresh:2; url=login.php');
        die('You need to log in to view this site');
    }
    
    print"
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
        <script>
            function previewImg (id) {
                document.body.style.backgroundImage = \"url('img/\" + id + \".jpg')\";
            }
        </script>
    </head>
    <body style='background-image: url(img/{$_SESSION['image']}.jpg); background-repeat: no-repeat; background-size: cover; background-attachment: fixed;'>
        <form action = 'editAccount.php' method='POST' enctype='multipart/form-data'>
        <h1> Edit Page </h1>
        <input type='hidden' id='id' name='id' value='$id'>
        <label for='username'> Username </label>
        <input type='text' id='username' name='username' value='{$account['username']}' placeholder='Enter Username' required> <br>

        <label for='password'> Password </label>
        <input type='password' id='password' name='password' placeholder='Enter Password' value='{$account['password']}' required> <br>

        <label for='image'>Background Image</label>
        <select name='image' id='image' onchange='previewImg(this.value)' required>
            <option value='1'>Option 1</option>
            <option value='2'>Option 2</option>
            <option value='3'>Option 3</option>
        </select> <br>
        <input type='submit' value='Edit' name='submit'>
        </form>
    </body>
    </html>
    ";
?>


