<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit(); // Stop script execution after redirection
}

// Retrieve user information from session variables
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Display the main page content    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <form action="logout.php" method="POST">
        <button type="submit" name="logout">Sign Out</button>
    </form>

</head>

<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <h1>Welcome, <?php echo $user_id; ?>!</h1>
    <!-- Other main page content goes here -->
</body>

</html>