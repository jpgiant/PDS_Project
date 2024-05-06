<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>signup screen</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <h1>Sign Up</h1>
            <form method="POST" class="form">
                <input type="text" name="First_Name" placeholder="John" required>
                <input type="text" name="Last_Name" placeholder="Doe" required>
                <input type="text" name="Username" placeholder="jd119" required>
                <input type="password" name="Password" placeholder="Password" required>
                <input type="password" name="Repassword" placeholder="RetypePassword" required>
                <input type="email" name="email" placeholder="email" required>
                <input type="text" name="Address_Line_1" placeholder="Apt, House Num" required>
                <input type="text" name="Address_Line_2" placeholder="Street Name" required>
                <input type="text" name="Zipcode" placeholder="11212" required>
                <input type="text" name="City" placeholder="New York City" required>
                <input type="text" name="State" placeholder="NY" required>
                <input type="text" name="Country" placeholder="US" required>
                <input type="text" name="Block" placeholder="1" required>
                <input type="text" name="Dependents" placeholder="I have three family members" required>
                <input type="text" name="Photo" placeholder="Upload Photo" required>
                <input type="text" name="Latitude" placeholder="Lat" required>
                <input type="text" name="Longitude" placeholder="Long" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="regis-signup">signup</button>
            </form>
            <?php
            include 'db_connection.php';

            //session start
            session_start();

            $valid = "";
            $pas = "";
            $conn = "";
            $a = "";
            $err = "";
            $stmt = "";
            $mail = "";
            $ins1 = "";
            $register = "";
            $insuc = "";
            $uid = "";

            if (isset($_POST['regis-signup'])) {
                $fname = $_POST['First_Name'];
                $lname = $_POST['Last_Name'];
                $uname = $_POST['Username'];
                $pass = $_POST['Password'];
                $repass = $_POST['Repassword'];
                $email = $_POST['email'];
                $addr1 = $_POST['Address_Line_1'];
                $addr2 = $_POST['Address_Line_2'];
                $zcode = $_POST['Zipcode'];
                $city = $_POST['City'];
                $state = $_POST['State'];
                $country = $_POST['Country'];
                $block = $_POST['Block'];
                $dependents = $_POST['Dependents'];
                $photo = $_POST['Photo'];
                $lat = $_POST['Latitude'];
                $long = $_POST['Longitude'];

                if ($pass == $repass) {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    }
                    $stmt = $pdo->prepare("INSERT INTO Users (fname, lname, user_name, address_line1, address_line2, city, state, zipcode, country, email, block_id, dependents_desc, photo_uri, latitude, longitude, password, last_access) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())");

                    // Bind parameters
                    $stmt->bindParam(1, $fname);
                    $stmt->bindParam(2, $lname);
                    $stmt->bindParam(3, $uname);
                    $stmt->bindParam(4, $addr1);
                    $stmt->bindParam(5, $addr2);
                    $stmt->bindParam(6, $city);
                    $stmt->bindParam(7, $state);
                    $stmt->bindParam(8, $zcode);
                    $stmt->bindParam(9, $country);
                    $stmt->bindParam(10, $email);
                    $stmt->bindParam(11, $block);
                    $stmt->bindParam(12, $dependents);
                    $stmt->bindParam(13, $photo);
                    $stmt->bindParam(14, $lat);
                    $stmt->bindParam(15, $long);
                    $stmt->bindParam(16, $pass);

                    // // Execute the statement
                    // $stmt->execute();
                    // header("Location: mainpage.php");
                    // Execute the statement
                    if ($stmt->execute()) {
                        // Registration successful, set session variables
                        $_SESSION['user_id'] = $pdo->lastInsertId();
                        $_SESSION['username'] = $uname; // Assuming email is the username
                        // Redirect to main page
                        header("Location: mainpage.php");
                        exit(); // Stop script execution after redirection
                    } else {
                        echo "Error: Registration failed.";
                    }
                } else {
                    echo "Passwords do not match.";
                }
            }


            ?>

</body>

</html>