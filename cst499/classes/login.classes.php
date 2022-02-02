<?php

class Login extends Dbh {

    protected function getUser($email, $pwd) {
        $stmt = $this->connect()->prepare('SELECT users_email, users_pwd FROM users WHERE users_email = ?;');

        if(!$stmt->execute(array($email, $pwd))) {
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

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);

        if($checkPwd == false)
        {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        }
        elseif($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT users_email, users_pwd FROM users WHERE users_email = ? AND users_pwd = ?;');

            if(!$stmt->execute(array($email, $pwd))) {
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

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);


            $_SESSION["username"] = $user[0]["users_firstName"];

            $stmt = null;
        }
    }

}