<?php

class Login extends Dbh {

    protected function getUser($email, $pwd) {

        
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_email = ?;');

        if(!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("location: ../index.php?error=thisusernotfound");
            exit();
        }

        $pwdStored = $stmt->fetchAll();
        $pass = (string)$pwdStored[0]['users_pwd'];
        
        if($pass == $pwd){

            if(!$stmt->execute(array($email))) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0)
            {
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_email = ? AND users_pwd = ?;');
            $stmt -> execute(array($email, $pwd));
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        }else{
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        }

        session_start();
        $_SESSION['userId'] = $user[0]["users_id"];
        $_SESSION['username'] = $user[0]["users_firstName"];
        $_SESSION['firstName'] = $user[0]["users_firstName"];
        $_SESSION['email'] = $user[0]["users_email"];
        $_SESSION['lastName'] = $user[0]["users_lastName"];
        $_SESSION['address'] = $user[0]["users_address"];
        $_SESSION['phone'] = $user[0]["users_phone"];
        $_SESSION['degree'] = $user[0]["users_degree"];
        
        $stmt = null;
    }
}