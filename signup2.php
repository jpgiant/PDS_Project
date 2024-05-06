<?php
	session_start();

	include 'db_connection.php';
	//session start
	
	echo "hello";
	
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

	if (isset($_POST['regis'])) {
		$fname = $_POST['First_name'];
		$lname = $_POST['Last_name'];
		$uname = $_POST['Username'];
		$pass = $_POST['Password'];
		$repass = $_POST['Repassword'];
		$email = $_POST['Email'];
		$addr1 = $_POST['Add1'];
		$addr2 = $_POST['Add2'];
		$zcode = $_POST['zip'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$block = $_POST['block'];
		$dependents = $_POST['dependents'];
		$code = $_POST['code'];
		$phone = $_POST['contact'];

	  
		echo "Finding user name";

			
		$checkStmt = $pdo->prepare("SELECT COUNT(*) FROM Users WHERE user_name = ?");
		$checkStmt->execute([$uname]);
		$count = $checkStmt->fetchColumn();

		echo $count;
		if ($count > 0) {
			echo "Username already exists. Please choose a different username.";
		} else {
			// Insert user if username is unique
			echo "Insering into users";
			$stmt = $pdo->prepare("INSERT INTO Users (fname, lname, user_name, address_line1, address_line2, city, state, zipcode, country, email, block_id, dependents_desc, password, last_access, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(),?)");
			$stmt->execute([$fname, $lname, $uname, $addr1, $addr2, $city, $state, $zcode, $country, $email, $block, $dependents, $pass, $phone]);

			// Registration successful, set session variables
			$_SESSION['user_id'] = $pdo->lastInsertId();
			$_SESSION['username'] = $uname;

			// Insert into access relation and record sign-in time
			$insertStmt = $pdo->prepare("INSERT INTO access (user_id, user_name, last_signin) VALUES (?, ?, NOW())");
			
			
			
			
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
			$stmt->bindParam(13, $pass);
			$stmt->bindParam(14, $phone);
			
			
			
			$insertStmt->execute([$_SESSION['user_id'], $uname]);

			// Redirect to main page
			header("Location: mainpage.php");
			exit(); // Stop script execution after redirection
			
			
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="css/styleSignup.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<form class="h-100 h-custom gradient-custom-2" method="POST">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="p-5">
                  <h3 class="fw-normal mb-5" style="color: #4835d4;">General Infomation</h3>

                  <div class="mb-4 pb-2">
                    <select data-mdb-select-init>
                      <option value="1">Title</option>
                      <option value="2">Mr.</option>
                      <option value="3">Ms.</option>
                      <option value="4">Mrs.</option>
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                        <input type="text" id="form3Examplev2" name="First_name" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplev2">First_name</label>
                      </div>

                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline">
                        <input type="text" id="form3Examplev3" name="Last_name" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplev3">Last_name</label>
                      </div>

                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                      <div data-mdb-input-init class="form-outline">
                        <input type="text" id="form3Examplev5" name="Username" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplev5">Username</label>
                      </div>

                    </div>
                  </div>
				  
				  <div class="row">
                    <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                      <div data-mdb-input-init class="form-outline">
                        <input type="password" id="form3Examplev5" name="Password" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplev5">Password</label>
                      </div>

                    </div>
                  
                    <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                      <div data-mdb-input-init class="form-outline">
                        <input type="password" id="form3Examplev5" name="Repassword" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplev5">Re-type Password </label>
                      </div>

                    </div>
                  </div>
				  
				  <div class="row">
                    <div class="col-md-6 mb-4 pb-2 mb-md-0 pb-md-0">

                      <div data-mdb-input-init class="form-outline">
                        <input type="text" id="form3Examplev5" name="Email" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplev5">Email</label>
                      </div>

                    </div>
                  </div>

                </div>
              </div>
              <div class="col-lg-6 bg-indigo text-white">
                <div class="p-5">
                  <h3 class="fw-normal mb-5">Contact Details</h3>

                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline form-white">
                      <input type="text" id="form3Examplea2" name="Add1" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea2">Address Line 1</label>
                    </div>
                  </div>

                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline form-white">
                      <input type="text" id="form3Examplea3" name="Add2" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea3">Address Line 2</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline form-white">
                        <input type="text" id="form3Examplea4" name="zip" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplea4">Zip Code</label>
                      </div>

                    </div>
                    <div class="col-md-7 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline form-white">
                        <input type="text" id="form3Examplea5" name="city" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplea5">City</label>
                      </div>

                    </div>
                  </div>
				  
				  <div class="row">
                    <div class="col-md-5 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline form-white">
                        <input type="text" id="form3Examplea4" name="state" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplea4">State</label>
                      </div>

                    </div>
                    <div class="col-md-7 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline form-white">
                        <input type="text" id="form3Examplea5" name="country" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplea5">Country</label>
                      </div>

                    </div>
                  </div>

                  <div class="mb-4 pb-2">
                    <div data-mdb-input-init class="form-outline form-white">
                      <input type="text" id="form3Examplea6" name="block" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea6">Block</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline form-white">
                        <input type="text" id="form3Examplea7" name="code" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplea7">Code +</label>
                      </div>

                    </div>
                    <div class="col-md-7 mb-4 pb-2">

                      <div data-mdb-input-init class="form-outline form-white">
                        <input type="text" id="form3Examplea8" name="contact" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplea8">Phone Number</label>
                      </div>

                    </div>
                  </div>

                  <div class="mb-4">
                    <div data-mdb-input-init class="form-outline form-white">
                      <input type="text" id="form3Examplea9" name="dependents" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea9">Dependents</label>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-start mb-4 pb-3">
                    <input class="form-check-input me-3" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label text-white" for="form2Example3">
                      I do accept the <a href="#!" class="text-white"><u>Terms and Conditions</u></a> of your
                      site.
                    </label>
                  </div>

                  <button type="submit" data-mdb-button-init data-mdb-ripple-init name="regis" class="btn btn-light btn-lg"
                    data-mdb-ripple-color="dark">Register</button>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>


</body>
</html>