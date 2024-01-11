<?php
include("auth.php");
include("conn.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?> ! <a href="logout.php">Logout</a></p>
        <p>Welcome to our Page. <br> You are now on the Dashboard. Here you can read and write the blogs.</p>
        <div>
            <input type="button" class="btn" value="Blog Post" onclick="window.location.href='blog.php'">
        </div>
        <div>
            <input type="button" class="btn" value="Blog List" onclick="window.location.href='view.php'">
        </div>
    </div>
</body>
</html>
