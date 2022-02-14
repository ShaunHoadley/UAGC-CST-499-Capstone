<?php
    
    include_once 'classes/dbh.classes.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> View Schedule </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sacle=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

    <?php include 'header.php';?>

    <div style='margin-bottom:60px' class="container text-center">
        <?php 

            if(!isset($_SESSION['username'])) {
                echo "<h1>Course Schedule Page</h1>";
                echo "<h3>Please login or register</h3>";
            }
            else {
                echo "<h1>Here is your course schedule, ".$_SESSION['username']."</h1><br>";
                
                echo "<h2>You are registered for:</h2><br>";

                echo "<div class='row'><h5>";
                    echo "<form method='post'>";
                    echo "<div class='col-sm-5 text-left'></div>";
                    echo "<div class='col-sm-3 text-left'>";
                        echo "To drop any course, enter the ID# here <input type='text' class='form-control' id='drop' name='dropClass' autocomplete='off'><button type='submit' class='btn btn-primary' name='dropButton'>Drop</button></div>";
                    echo "</form></h5>";
                echo "</div>";

                echo "<div class='row'>";
                    echo "<div class='col-sm-1 text-left'>";
                        echo "<h3><strong>ID#</strong></h3>";
                    echo "</div>";
                    echo "<div class='col-sm-6 text-left'>";
                        echo "<h3><strong>Course Name</strong></h3>";
                    echo "</div>";
                    echo "<div class='col-sm-2 text-left'>";
                        echo "<h3><strong>Year</strong></h3>";
                    echo "</div>";
                    echo "<div class='col-sm-3 text-left'>";
                        echo "<h3><strong>Semester</strong></h3>";
                    echo "</div></div>";

                $courses = displayCourseSchedule($_SESSION['userId']);
            }

                if (isset($_POST['dropButton'])) {  
                    $id = $_POST['dropClass'];
                    $_SESSION['dropOfferingId'] = $_POST["dropClass"];
                                 
                    dropCourse($_SESSION['userId'],$id);
                    
                    numStudentsEnrolled($_SESSION['dropOfferingId']);
                    maxStudentsForCourse($_SESSION['dropOfferingId']);
                    if ($_SESSION['numStudentsEnrolled'] == $_SESSION['maxStudents'] - 1) {
                        numStudentsOnWaitlist($_SESSION['dropOfferingId']);
                        if ($_SESSION['numStudentsOnWaitlist'] != 0) {
                            getWaitlistedStudent($_SESSION['dropOfferingId']);
                            registerForCourse($_SESSION['waitlistedStudentId'],$_SESSION['dropOfferingId']);
                            removeStudentFromWaitlist($_SESSION['waitlistedUserId'],$_SESSION['dropOfferingId'],$_SESSION['dateTimeAdded']);
                            notifyStudent($_SESSION['waitlistedStudentId'],$_SESSION['dropOfferingId']);
                        }
                    }
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                
        ?>
    </div>

    <?php include_once 'footer.php';?>

</body>
</html>
<?php 
    
    function displayCourseSchedule($userId) {
        
        $pdo = new Dbh;

        $sql =  "SELECT enrollment.users_id, offering.offering_id, course.courseName, offering.year, offering.semester
            FROM ((enrollment
                INNER JOIN offering ON enrollment.offering_id = offering.offering_id
                    AND enrollment.users_id = $userId)
                INNER JOIN course ON course.course_id = offering.course_id)";
        

        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute();
        $results = $stmt -> fetchAll();

        foreach($results as $row){

            $courses[] = array((string)$row['courseName'], (string)$row['year'], (string)$row['semester'], (string)$row['offering_id']);

            echo "<div class='row'>";
                echo "<div class='col-sm-1 text-left'>";
                    echo "<h3>".(string)$row['offering_id']."</h3>";
                echo "</div>";
                echo "<div class='col-sm-6 text-left'>";
                    echo "<h3>".(string)$row['courseName']."</h3>";
                    
                echo "</div>";
                echo "<div class='col-sm-2 text-left'>";
                    echo "<h3>".(string)$row['year']."</h3>";
                    
                echo "</div>";
                echo "<div class='col-sm-3 text-left'>";
                    echo "<h3>".(string)$row['semester']."</h3>";
                    
                echo "</div>";
            echo "</div>";
        }
            return $courses;
    }

    function dropCourse($userId,$id) {

        $pdo = new Dbh;
        
        $sql =  "DELETE FROM enrollment
            WHERE users_id = ? AND offering_id = ?";

        $stmt = $pdo->connect() -> prepare($sql);
        $stmt -> execute(array($userId, $id));        
    }

    function numStudentsEnrolled($offeringId) {
        
        $pdo = new Dbh;

        $sql =  "SELECT COUNT(enrollment.offering_id) as 'count'
            FROM enrollment
            WHERE offering_id = ?";
        $stmt = $pdo->connect()->prepare($sql);
        $stmt -> execute(array($offeringId));
        $results = $stmt -> fetchAll();

        foreach($results as $row){
            $_SESSION['numStudentsEnrolled'] = $row['count'];
        }
    }

    function maxStudentsForCourse($offeringId) {

        $pdo = new Dbh;

        $sql =  "SELECT course.maxStudents
            FROM course
            INNER JOIN offering ON offering.course_id = course.course_id
                AND offering.offering_id = ?";
        $stmt = $pdo->connect()->prepare($sql);
        $stmt -> execute(array($offeringId));
        $results = $stmt -> fetchAll();

        foreach($results as $row){
            $_SESSION['maxStudents'] = $row['maxStudents'];
        }
    }

    function numStudentsOnWaitlist($offeringId) {

        $pdo = new Dbh;

        $sql =  "SELECT COUNT(*) as students
            FROM waitlist
            WHERE offering_id = ?";
        $stmt = $pdo->connect()->prepare($sql);
        $stmt -> execute(array($offeringId));
        $results = $stmt -> fetchAll();

        foreach($results as $row){
            $_SESSION['numStudentsOnWaitlist'] = $row['students'];
        }
    }

    function getWaitlistedStudent($offeringId) {

        $pdo = new Dbh;

        $sql =  "SELECT users_id, dateTimeAdded
            FROM waitlist
            WHERE offering_id = ?
            ORDER BY dateTimeAdded LIMIT 1";
        $stmt = $pdo->connect()->prepare($sql);
        $stmt -> execute(array($offeringId));
        $results = $stmt -> fetchAll();

        foreach($results as $row){
            $_SESSION['waitlistedStudentId'] = $row['student_id'];
            $_SESSION['dateTimeAdded'] = $row['dateTimeAdded'];
        }
    }

    function registerForCourse($userId,$offeringId) {

        $pdo = new Dbh;

        $sql =  "INSERT INTO enrollment (users_id, offering_id)
            VALUES (?, ?)";
        $stmt = $pdo->connect()->prepare($sql);
        $stmt -> execute(array($userId, $offeringId));
    }
    
    function removeStudentFromWaitlist($userId,$offeringId,$dateTimeAdded) {

        $pdo = new Dbh;

        $sql =  "DELETE FROM waitlist 
            WHERE users_id = ?
                AND offering_id = ?
                AND dateTimeAdded = ?";
        $stmt = $pdo->connect()->prepare($sql);
        $stmt -> execute(array($userId, $offeringId, $dateTimeAdded));
    }

    function notifyStudent($userId,$offeringId) {

        $pdo = new Dbh;

        $sql =  "INSERT INTO notification (users_id, offering_id)
            VALUES (?, ?)";
        $stmt = $pdo->connect()->prepare($sql);
        $stmt -> execute(array($userId, $offeringId));
    }
?>