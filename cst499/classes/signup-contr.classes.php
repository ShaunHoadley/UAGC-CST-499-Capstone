<?php

class SignupContr extends Signup {

    private $uid;
    private $email;
    private $pwd;
    private $pwdRepeat;
    private $firstName; 
    private $lastName; 
    private $address; 
    private $phone; 
    private $degree;
    private $result;
    
    public function __construct($email, $pwd, $pwdRepeat, $firstName, $lastName, $address, $phone, $degree) {
        
        $this->email = $email;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->phone = $phone;
        $this->degree = $degree;
        
    }

    public function signupUser() {
        
        if($this->invalidEmail() == false) {
            header("location: ../index.php?error=email");
            exit();
        }
        if($this->pwdMatch() == false)
        {
            header("location: ../index.php?error=passwordmatch");
            exit();
        }
        if($this->uidTakenCheck() == false)
        {
            header("location: ../index.php?error=emailtaken");
            exit();
        }

        $this->setUser($this->email, $this->pwd, $this->firstName, $this->lastName, $this->address, $this->phone, $this->degree);
    }

    private function invalidEmail() {
        
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) 
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch() {

        if ($this->pwd !== $this->pwdRepeat) 
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck() {

        if (!$this->checkUser($this->email)) 
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }

    private function invalidFirstName() {

        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->firstName)) 
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }

    private function invalidLastName() {

        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->lastName)) 
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }

    private function invalidAddress() {

        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->address)) 
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }

    private function invalidPhone() {

        if (!preg_match("/^[\d\W-\W(\W)]*$/", $this->phone)) 
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }

    private function invalidDegree() {

        if (!preg_match("/^[a-zA-Z0-9\s]*$/", $this->degree)) 
        {
            $result = false;
        }
        else 
        {
            $result = true;
        }
        return $result;
    }
}