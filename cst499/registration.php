<?php
	//session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Registration Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sacle=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

    <?php include_once 'header.php';?>    

    

	<div class="container text-center">
        <h1>Welcome to the Registration Page</h1>
    </div>
    <div style='margin-bottom:60px' class="container">
            <form class="padding-top" action="includes/signup.inc.php" method="post">
                <div class="form-row">
                	<div class="form-group col-md-12" id="no-padding-left">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" autocomplete="off" name="email" required>
                </div>
                <div class="form-group col-md-6" id="no-padding-right">
                    <label for="pwd">Password</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Password" autocomplete="off" name="pwd" required>
                </div>
                <div class="form-group col-md-6" id="no-padding-right">
                    <label for="pwdrepeat">Repeat Password</label>
                    <input type="password" class="form-control" id="pwdrepeat" placeholder="Password" autocomplete="off" name="pwdrepeat" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" id="no-padding-left">
                    <label for="firstName">First Name</label>
                    <input type=text class="form-control" id="firstName" placeholder="First Name" autocomplete="off" name="firstName" required>
                </div>
                <div class="form-group col-md-6" id="no-padding-right">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="Last Name" autocomplete="off" name="lastName" required>
                </div>
            </div>
            <div class="form-group col-md-12" id="no-padding-left">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="1234 Main St, (Apartment, studio, or floor), City, State, Zipcode" name="address" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" id="no-padding-left">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="phone" placeholder="123-456-7890" name="phone" required>
                </div>
                <div class="form-group col-md-6" id="no-padding-right">
                    <label for="degree">Degree</label>
                    <input type="text" class="form-control" id="degree" placeholder="B.S. in Computer Software Technology" name="degree" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Register</button>
        </form>
	</div>
	<?php include 'footer.php';?>
</body>
</html>