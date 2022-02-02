<?php

class Signup extends Dbh {

    protected function setUser($email, $pwd, $firstName, $lastName, $address, $phone, $degree) {
        $stmt = $this->connect()->prepare('INSERT INTO users (users_email, users_pwd, users_firstName, users_lastName, users_address, users_phone, users_degree) VALUES (?, ?, ?, ?, ?, ?, ?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($email, $hashedPwd, $firstName, $lastName, $address, $phone, $degree))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkUser($email) {
        $stmt = $this->connect()->prepare('SELECT users_email FROM users WHERE users_email = ?;');

        if(!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        //$resultCheck;
        if($stmt->rowCount() > 0) {
            $resultCheck = false;
        }
        else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

}