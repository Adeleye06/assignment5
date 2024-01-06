<?php
session_start();

if(isset($_POST["submit"])){
    // Create connection
    $conn = mysqli_connect("localhost", "root", "", "webprogramming");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $image = $conn->real_escape_string($_POST["image"]);

    $sql = "select id from assignment5 where username='$username'";
    if($result = $conn->query($sql)){
        if($result->num_rows > 0) {
            header("refresh:2; url=register.php");
            die("This username exists, try other usernames please!");
        }
    }

    $secondSql = "INSERT INTO assignment5 (username, password, picture) VALUES ('$username', '$password', '$image')";
    if($conn->query($secondSql) === FALSE){
        header("refresh:2; url=register.php");
        die("try again, registration failed". $conn->error);
    }else{
        header("refresh:2; url=login.php");
        die("Registration Successful");
    }
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
<body style='background-image: url(img/1.jpg); background-repeat: no-repeat; background-size: cover; background-attachment: fixed;'>
    <form action = 'register.php' method='POST' enctype='multipart/form-data'>
    <h1> Register Page </h1>

    <label for='username'> Username </label>
    <input type='text' id='username' name='username' value='' placeholder='Enter Username' required> <br>

    <label for='password'> Password </label>
    <input type='password' id='password' name='password' placeholder='Enter Password' required> <br>

    <label for='image'>Background Image</label>
    <select name='image' id='image' onchange='previewImg(this.value)' required>
        <option value='1'>Option 1</option>
        <option value='2'>Option 2</option>
        <option value='3'>Option 3</option>
    </select> <br>
    <input type='submit' value='register' name='submit'>
    </form>
</body>
</html>
";
?>



