<?php include_once 'classes/dbh.classes.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Add Course </title>
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
        <?php
            if($_SESSION['selectedYear'] == 2021 || $_SESSION['selectedSemester'] == 'Spring') {
                echo "<h1>Sorry, registration for ".$_SESSION['selectedSemester']." ".$_SESSION['selectedYear']." is closed.</h1>";
                
            } else {
                echo "<h1>Register for ".$_SESSION['selectedSemester']." ".$_SESSION['selectedYear']."</h1>";
                echo "<h3>Please select the course that you would like to register for</h3>";
            }
        ?>
    </div>
    <div style='margin-bottom:60px' class="container">
        <form class="padding-top" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-row">
                <div class="form-group col-md-12" id="no-padding-left">
                    <label for="inputCourse">Course</label>
                    <select id="inputCourse" class="form-control" name="course" required>
                        <option>Choose...</option>
                        <?php getAvailableCourses($_SESSION['selectedYear'],$_SESSION['selectedSemester']);
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="select_course">Submit</button>
            <?php 
                if (isset($_POST['select_course'])) {
                    $_SESSION['selectedCourse'] = $_POST["course"];
                    getOfferingId($_SESSION['selectedCourse'],$_SESSION['selectedYear'],$_SESSION['selectedSemester']);
                    checkIfRegistered($_SESSION['userId'],$_SESSION['selectedOfferingId']);
                    if ($_SESSION['registered'] == 1) {
                        echo "<p style='padding-top:15px'>You are already registered for this course.  Please make another selection.</p>";
                        
                    } else if ($_SESSION['registered'] == 0) {
                        numStudentsEnrolled($_SESSION['selectedOfferingId']);
                        maxStudentsForCourse($_SESSION['selectedOfferingId']);
                        if ($_SESSION['numStudentsEnrolled'] < $_SESSION['maxStudents']) {
                            registerForCourse($_SESSION['userId'],$_SESSION['selectedOfferingId']);
                            echo "<p style='padding-top:15px'>You have successfully registered for ".$_SESSION['selectedCourse']." for ".$_SESSION['selectedSemester']." ".$_SESSION['selectedYear'].".</p>";
                            
                        } else if ($_SESSION['numStudentsEnrolled'] == $_SESSION['maxStudents']) {
                            checkIfWaitlisted($_SESSION['userId'],$_SESSION['selectedOfferingId']);
                            if ($_SESSION['waitlisted'] == 1) {
                                echo "<p style='padding-top:15px'>You are already on the waitlist for ".$_SESSION['selectedCourse']." for ".$_SESSION['selectedSemester']." ".$_SESSION['selectedYear'].".  Please make another selection.</p>";
                                
                            } else {
                                addToWaitlist($_SESSION['user'],$_SESSION['selectedOfferingId']);
                                echo "<p style='padding-top:15px'>This course is full.  You have been successfully added to the waitlist for ".$_SESSION['selectedCourse']." for ".$_SESSION['selectedSemester']." ".$_SESSION['selectedYear'].".</p>";                                
                            }                         
                        }
                    }
                }                
            ?>
        </form>
    </div>
<?php require_once 'footer.php';?>
</body>
</html>

<?php
    
    function getAvailableCourses($year,$semester) {
        $pdo = new Dbh;

        $sql =  "SELECT course.courseName FROM course
            INNER JOIN offering ON course.course_id = offering.course_id
                AND offering.year = ? AND offering.semester = ?";
        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute(array($year, $semester));
        $results = $stmt -> fetchAll();
        
        foreach ($results as $row){
            echo "<option>".$row['courseName']."</option>";
        }
    }

    function getOfferingId($courseName,$year,$semester) {
        $pdo = new Dbh;

        $sql = "SELECT offering.offering_id
            FROM offering
            INNER JOIN course ON offering.course_id = course.course_id
                AND offering.year = ? AND offering.semester = ? AND course.courseName = ?";
        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute(array($year, $semester, $courseName));
        $results = $stmt -> fetchAll();
        
        foreach ($results as $row){
            $_SESSION['selectedOfferingId'] = $row['offering_id'];
        }
    }

    function checkIfRegistered($userId,$offeringId) {
        $pdo = new Dbh;

        $sql =  "SELECT COUNT(*) as count FROM enrollment
        WHERE users_id = ? AND offering_id = ?";
        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute(array($userId,$offeringId));
        $results = $stmt -> fetchAll();

        foreach ($results as $row){
            $_SESSION['registered'] = $row['count'];
        }
    }

    function numStudentsEnrolled($offeringId) {
        $pdo = new Dbh;

        $sql =  "SELECT COUNT(enrollment.offering_id) as 'count'
            FROM enrollment
            WHERE offering_id = ?";
        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute(array($offeringId));
        $results = $stmt -> fetchAll();

        foreach ($results as $row){
            $_SESSION['numStudentsEnrolled'] = $row['count'];
        }
    }

    function maxStudentsForCourse($offeringId) {
        $pdo = new Dbh;

        $sql =  "SELECT course.maxStudents
            FROM course
            INNER JOIN offering ON offering.course_id = course.course_id
                AND offering.offering_id = ?";
        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute(array($offeringId));
        $results = $stmt -> fetchAll();

        foreach ($results as $row){
            $_SESSION['maxStudents'] = $row['maxStudents'];
        }
    }

    function checkIfWaitlisted($userId, $offeringId) {
        $pdo = new Dbh;

        $sql =  "SELECT COUNT(*) as count
        FROM waitlist
        WHERE student_id = ? AND offering_id = ?";
        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute(array($userId, $offeringId));
        $results = $stmt -> fetchAll();

        foreach ($results as $row){
            $_SESSION['waitlisted'] = $row['count'];
        }    
    }

    function addToWaitlist($userId, $offeringId) {
        $pdo = new Dbh;

        $sql =  "INSERT INTO waitlist (users_id, offering_id, dateTimeAdded)
            VALUES 
                (?, ?, ?)";
        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute(array($userId, $offeringId, NOW()));   
    }
    
    function registerForCourse($userId, $offeringId) {
        $pdo = new Dbh;

        $sql =  "INSERT INTO enrollment (users_id, offering_id)
            VALUES 
                (?, ?)";
        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute(array($userId, $offeringId));
    }
?>