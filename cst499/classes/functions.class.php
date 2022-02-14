<?php
include 'dbh.classes.php'

Class MyFunctions extends Dbh {

    function displayCourseSchedule($userId) {
        
        $getScheduleQuery =  "SELECT enrollment.users_id, offering.offering_id, course.courseName, offering.year, offering.semester
            FROM ((enrollment
                INNER JOIN offering ON enrollment.offering_id = offering.offering_id
                    AND enrollment.users_id = ?)
                INNER JOIN course ON course.course_id = offering.course_id)";
        $sql = $getScheduleQuery;

        $stmt = $this->connect() -> prepare($sql);
        $stmt -> execute([$userId]);
        $results = $stmt -> fetchAll();var_dump($results);

        foreach($results as $row){

        }
    }
        $results = mysqli_query($connect, $getScheduleQuery); 
        if (mysqli_num_rows($results) != 0) { 
            while($row = mysqli_fetch_assoc($results)) {
                $offeringId = $row['offering_id'];
                $courseName = $row['courseName'];
                $courseYear = $row['year'];
                $courseSemester = $row['semester'];

                echo "<div class='row'>";
                    echo "<div class='col-md-6 text-left'>";
                        echo "<h3>".$courseName."</h3>";
                    echo "</div>";
                    echo "<div class='col-md-2 text-left'>";
                        echo "<h3>".$courseSemester."</h3>";
                    echo "</div>";
                    echo "<div class='col-md-2 text-left'>";
                        echo "<h3>".$courseYear."</h3>";
                    echo "</div>";
                    echo "<div style='padding-top:15px' class='col-md-2 text-left'>";
                        echo "<form method='post'>";
                            echo "<input type='hidden' name='drop' value=".$offeringId.">";
                            echo "<button style='font-family:sans-serif' type='submit' class='btn btn-danger' name='dropButton'>DROP</button>";
                        echo "</form>";
                    echo "</div>";
                echo "</div>";
            }
        } 
    };

    function dropCourse($connection,$studentId,$offeringId) {
        $dropQuery =  "DELETE FROM enrollment
            WHERE student_id = $studentId AND offering_id = $offeringId";
        $results = mysqli_query($connection, $dropQuery);

        $getCourseInfoQuery =  "SELECT course.courseName, offering.semester, offering.year
            FROM course
            INNER JOIN offering ON course.course_id = offering.course_id
                AND offering.offering_id = $offeringId";
        $results = mysqli_query($connection, $getCourseInfoQuery);
        if (mysqli_num_rows($results) == 1) { 
            while($row = mysqli_fetch_assoc($results)) {
                $_SESSION['droppedCourseName'] = $row['courseName'];
                $_SESSION['droppedSemester'] = $row['semester'];
                $_SESSION['droppedYear'] = $row['year'];
            };
        };
    };

    function numStudentsEnrolled($connection,$offeringId) {
        $numStuEnrolledQuery =  "SELECT COUNT(enrollment.offering_id) as 'count'
            FROM enrollment
            WHERE offering_id = $offeringId";
        $results = mysqli_query($connection, $numStuEnrolledQuery);
        if (mysqli_num_rows($results) == 1) { 
            while($row = mysqli_fetch_assoc($results)) {
                $_SESSION['numStudentsEnrolled'] = $row['count'];
            };
        };
    };

    function maxStudentsForCourse($connection,$offeringId) {
        $maxStudentsQuery =  "SELECT course.maxStudents
            FROM course
            INNER JOIN offering ON offering.course_id = course.course_id
                AND offering.offering_id = $offeringId";
        $results = mysqli_query($connection, $maxStudentsQuery);
        if (mysqli_num_rows($results) == 1) { 
            while($row = mysqli_fetch_assoc($results)) {
                $_SESSION['maxStudents'] = $row['maxStudents'];
            };
        };
    };

    function numStudentsOnWaitlist($connection,$offeringId) {
        $numStuWaitlistQuery =  "SELECT COUNT(*) as students
            FROM waitlist
            WHERE offering_id = $offeringId";
        $results = mysqli_query($connection, $numStuWaitlistQuery);
        if (mysqli_num_rows($results) == 1) { 
            while($row = mysqli_fetch_assoc($results)) {
                $_SESSION['numStudentsOnWaitlist'] = $row['students'];
            };
        };
    };

    function getWaitlistedStudent($connection,$offeringId) {
        $waitlistedStudentQuery =  "SELECT student_id, dateTimeAdded
            FROM waitlist
            WHERE offering_id = $offeringId
            ORDER BY dateTimeAdded LIMIT 1";
        $results = mysqli_query($connection, $waitlistedStudentQuery);
        if (mysqli_num_rows($results) == 1) { 
            while($row = mysqli_fetch_assoc($results)) {
                $_SESSION['waitlistedStudentId'] = $row['student_id'];
                $_SESSION['dateTimeAdded'] = $row['dateTimeAdded'];
            };
        };
    };

    function registerForCourse($connection,$studentId,$offeringId) {
        $registerQuery =  "INSERT INTO enrollment (student_id, offering_id)
            VALUES 
                ($studentId,$offeringId)";
        $results = mysqli_query($connection, $registerQuery);
    }
    
    function removeStudentFromWaitlist($connection,$studentId,$offeringId,$dateTimeAdded) {
        $removeFromWaitlistQuery =  "DELETE FROM waitlist 
            WHERE student_id = $studentId
                AND offering_id = $offeringId
                AND dateTimeAdded = '$dateTimeAdded'";
        $results = mysqli_query($connection, $removeFromWaitlistQuery);
    };

    function notifyStudent($connection,$studentId,$offeringId) {
        $createNotificationQuery =  "INSERT INTO notification (student_id, offering_id)
            VALUES 
                ($studentId,$offeringId)";
        $results = mysqli_query($connection, $createNotificationQuery);
    };
}