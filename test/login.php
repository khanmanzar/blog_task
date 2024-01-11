<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('conn.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['roll_no'])) {
        $roll_no = stripslashes($_REQUEST['roll_no']);
        $roll_no = mysqli_real_escape_string($conn, $roll_no);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `students` WHERE roll_no='$roll_no'
                     AND password='$password'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['name'];
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  <p class='link'>Click here to <a href='register.php'>New Registration</a></p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="roll_no" placeholder="Enter your Roll No" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="register.php">New Registration</a></p>
  </form>
<?php
    }
?>
</body>
</html>