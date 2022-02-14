<?php include_once 'classes/dbh.classes.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Search Courses </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sacle=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container text-center">
        <h1>Search for Courses</h1>
        <h3>Please select the semester and year that you would like to register for<h3>
    </div>
    <div style='margin-bottom:60px' class="container">
        <form class="padding-top" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-row">
                <div class="form-group col-md-6" id="no-padding-left">
                    <label for="inputSemester">Semester</label>
                    <select id="inputSemester" class="form-control" name="semester" required>
                        <option>Choose...</option>
                        <?php getSemestersAvailable(); ?>
                    </select>
                </div>
                <div class="form-group col-md-6" id="no-padding-left">
                    <label for="inputYear">Year</label>
                    <select id="inputYear" class="form-control" name="year" required>
                        <option>Choose...</option>
                        <?php getYearsAvailable(); ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="search_courses">Submit</button>
            <?php 
                if (isset($_POST['search_courses'])) {
                    $_SESSION['selectedSemester'] = $_POST["semester"];
                    $_SESSION['selectedYear'] = $_POST["year"];

                    header('location: addCourse.php');
                }                 
            ?>
        </form>
    </div>
        <?php include 'footer.php';?>
</body>
</html>

<?php
    
    function getSemestersAvailable() {
        $pdo = new Dbh;
        
        $sql =  "SELECT DISTINCT semester FROM offering";
        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute();
        $results = $stmt -> fetchAll();
        
        foreach ($results as $row){
            echo "<option>".$row['semester']."</option>";
        }
    }

    function getYearsAvailable() {
        $pdo = new Dbh;

        $sql =  "SELECT DISTINCT year FROM offering";
        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute();
        $results = $stmt -> fetchAll();
        
        foreach ($results as $row){
            echo "<option>".$row['year']."</option>";
        }
    }
?>