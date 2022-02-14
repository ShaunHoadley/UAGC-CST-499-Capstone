<!DOCTYPE html>
<html lang="en">
<head>
    <title> Login Page </title>
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
        <h1>Welcome to the Login Page</h1>
    </div>
        <div style='margin-bottom:60px' class="container">
            <form class="padding-top" action="includes/login.inc.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-12" id="no-padding-left">
                        
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" autocomplete="off" name="email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12" id="no-padding-left">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Password" autocomplete="off" name="pwd" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                
            </form>
        </div>

    <?php include 'footer.php';?>

</body>
</html>