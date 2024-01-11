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
        <p>You are now on the Blog page. Here you can read the blogs.</p>
        <input type="button" class="btn" value="Blog Post" onclick="window.location.href='blog.php'">
        <h1 class="login-title">Your Blog List</h1>
        <div class="table">
        <?php
            // Get the user ID based on the username
            $username = $_SESSION['username'];
            $user_query = "SELECT id FROM students WHERE name = '$username'";
            $user_result = $conn->query($user_query);

            if ($user_result->num_rows > 0) {
                $user_row = $user_result->fetch_assoc();
                $user_id = $user_row['id'];

                // Now you have the user ID, you can use it in your blog query
                $blog_query = "SELECT id, title, description, image FROM blogs WHERE student_id = $user_id";
                $blog_result = $conn->query($blog_query);

                if ($blog_result->num_rows > 0) {
                    echo "<table><tr><th>ID</th><th>Title</th><th>Description</th><th>Image</th></tr>";
                    // output data of each row
                    while($row = $blog_result->fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."</td><td>".$row["title"]."</td><td>".$row["description"]."</td><td><img src='data:image/jpeg;base64,".base64_encode($row["image"])."' alt='Blog Image'></td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
            } else {
                echo "User not found";
            }
        ?>
        </div>
    </div>
</body>
</html>
