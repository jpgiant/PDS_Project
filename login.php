<?php
error_reporting(E_ALL); // Enable error reporting
session_start();
include 'db_connection.php';


if (isset($_POST['Submit'])) {
    $username = $_POST['UserName'];
    $password = $_POST['password'];

    // Query the database for the entered username and password
    $stmt = $pdo->prepare("SELECT user_id, password FROM Users WHERE user_name = ? AND password = ?");
    $stmt->execute([$username, $password]);

    // Check if the query was executed successfully
    if ($stmt->rowCount() > 0) { // Check if any rows were returned
        $user = $stmt->fetch();

        // Check if the user already exists in the access table
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM access WHERE user_id = ?");
        $checkStmt->execute([$user['user_id']]);
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            // If the user exists in the access table, update the last_signin timestamp
            $updateStmt = $pdo->prepare("UPDATE access SET last_signin = NOW() WHERE user_id = ?");
            $updateStmt->execute([$user['user_id']]);
        } else {
            // If the user does not exist in the access table, insert a new record
            $insertStmt = $pdo->prepare("INSERT INTO access (user_id, user_name, last_signin) VALUES (?, ?, NOW())");
            $insertStmt->execute([$user['user_id'], $username]);
        }

        // Start a session and store user ID
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $username;
        // Redirect to main page
        header("Location: mainpage.php");
        exit(); // Stop script execution after redirection
    } else {
        echo "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- <link rel="stylesheet" href="css/style.css"> -->

</head>

<body bgcolor=azure>
    <header>
        <center> Login page </center>
    </header>

    <div style="margin:0 auto; width: 300px; text-align:center">
        <form method="POST">
            <br><br><br><br>
            UserName <input type="text" name="UserName" />
            <br><br>
            Password <input type="password" name="password" /><br>
            <br><br>
            <input type="submit" name="Submit" />
        </form>
    </div>
</body>

</html>