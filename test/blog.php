<?php
include("auth.php");
include("conn.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php
    if(isset($_REQUEST['submit'])){
        if(isset($_SESSION['username'])){
            $title = $_REQUEST['title'];
            $description = $_REQUEST['description'];
            $student_username = $_SESSION['username'];

            $checkUserQuery = "SELECT * FROM `students` WHERE `name` = '$student_username'";
            $result = mysqli_query($conn, $checkUserQuery);

            if(mysqli_num_rows($result) > 0) {
                $userData = mysqli_fetch_assoc($result);
                $student_id = $userData['id'];

                // File upload handling
                $image = $_FILES['image']['tmp_name']; // Temporary file name on the server
                $imageData = addslashes(file_get_contents($image)); // Convert image to binary data

                // Insert data into 'blogs' table
                $query = "INSERT INTO `blogs` (title, description, image, student_id) VALUES ('$title', '$description', '$imageData', '$student_id')";
                $result = mysqli_query($conn, $query);

                if($result){
                    echo "<div class='form'>
                    <h3>Your Blog Post Successfully.</h3><br/>
                    <p class='link'>Click here to <a href='view.php'>Blog List</a></p>
                    <p class='link'>Click here to <a href='blog.php'>New Blog</a></p>
                    </div>";
                } else {
                    echo "Failed to insert into blogs table.";
                }
            } else {
                echo "User with username $student_username does not exist.";
            }
        } else {
            echo "Username is not set in the session. Authentication issue.";
        }
    } else {
    ?>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?> ! <a href="logout.php">Logout</a></p>
        <p>You can write your Blog Here.</p>
        <input type="button" class="btn" value="Blog List" onclick="window.location.href='view.php'">
        <form action="" method="post" enctype="multipart/form-data">
            <h1 class="login-title">Post New Blog</h1>
            <input type="text" class="login-input" name="title" placeholder="Title" required />
            <textarea name="description" class="login-input" cols="30" rows="10"></textarea>
            <input type="file" name="image" class="login-input" accept="image/*" required/>
            <input type="submit" name="submit" value="Register" class="login-button">
        </form>
    </div>
    <?php
    }
    ?>
</body>
</html>