<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('conn.php');
    if (isset($_REQUEST['submit'])) {
        $name = stripslashes($_REQUEST['name']);
        $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $roll_no = stripslashes($_REQUEST['roll_no']);
        $roll_no = mysqli_real_escape_string($conn, $roll_no);
 
        $check_query = "SELECT * FROM students WHERE roll_no = '$roll_no'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo "<div class='form'>
                  <h3>Roll No already exists. Please choose a different Roll No.</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
                  </div>";
        } else {
            $query = "INSERT INTO `students` (name, password, email, roll_no)
                      VALUES ('$name', '$password', '$email', '$roll_no')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<div class='form'>
                      <h3>You are registered successfully.</h3><br/>
                      <p class='link'>Click here to <a href='login.php'>Login</a></p>
                      <p class='link'>Click here to <a href='register.php'>New Registration</a></p>
                      </div>";
            } else {
                echo "<div class='form'>
                      <h3>Required fields are missing.</h3><br/>
                      <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
                      </div>";
            }
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Student Registration</h1>
        <input type="text" class="login-input" name="name" placeholder="Enter Name" required />
        <input type="email" class="login-input" name="email" placeholder="Enter Email Adress" required />
        <input type="text" class="login-input" name="roll_no" placeholder="Enter Roll No" required />
        <input type="password" class="login-input" name="password" pattern= "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
        title="Password should be 8 digits atleast 1 upper case 1 special case and lowercase" placeholder="Enter Password" required />
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>