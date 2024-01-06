<?php
session_start();

if (isset($_POST['submit'])){
      // Create connection
      $conn = mysqli_connect("localhost", "root", "", "webprogramming");
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

    $username = $conn->real_escape_string($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "SELECT password, picture FROM assignment5 WHERE username='$username'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $account = $result->fetch_assoc();
        $isPassword = password_verify($_POST['password'], $account['password']);
        if($isPassword){
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['image'] =  $account['picture'];
            header("refresh:2; url=home.php");
            die("Welcome, Redirecting....");
        }
        
    } else{
        header("refresh:2; url=register.php");
        die('Did not find your account, password or username is wrong');
    }


}
print"
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
</head>
<body>
    <form action = 'login.php' method='POST' enctype='multipart/form-data'>
    <h1> Login Page </h1>

    <label for='username'> Username </label>
    <input type='text' id='username' name='username' value='' placeholder='Enter Username' required> <br>

    <label for='password'> Password </label>
    <input type='password' id='password' name='password' placeholder='Enter Password' required> <br>
    <input type='submit' value='login' name='submit'>
    </form>
</body>
</html>
";
?>