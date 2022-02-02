
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body style="font-family:Impact">
	<div class="jumbotron" style="background-color:#66cc00">
	    <div class="container text-center">
	        <h1>Nomad University</h1>
	        <h2>Student Course Enrollment System</h2>
	    </div>
	</div>
		<nav class="navbar navbar-inverse">
		    <div class="container-fluid">
		        <div class="navbar-header">
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		        </div>
		        <div class="collapse navbar-collapse" id="myNavbar">
		            <ul class="nav navbar-nav">
		                <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
		            </ul>
		            <ul class="nav navbar-nav navbar-right">
						<?php
						
					        if(isset($_SESSION['username']))
					        {
					            echo '<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>';
					            echo '<li><a href="viewSchedule.php"><span class="glyphicon glyphicon-th-list"></span> View Schedule</a></li>';
					            echo '<li><a href="searchCourses.php"><span class="glyphicon glyphicon-plus"></span> Register for Courses</a></li>';
					            echo '<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>';
					        }
					        else
					        {
					            echo '<li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>';
					            echo '<li><a href="registration.php"><span class="glyphicon glyphicon-pencil"></span> Registration</a></li>';
					        }
						?>
					</ul>
		        </div>
		    </div>
		</nav>
</body>
</html>