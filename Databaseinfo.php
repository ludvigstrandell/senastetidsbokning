<?php
        require("database.php");
        $Username = test_input($_POST['username']);
        $Email = test_input($_POST['email']);
        $Password = $_POST['password'];
        $salt = random_bytes(8);
        $salt_password = md5($salt.$password);
        global $formError;
        global $formSucces;
        global $emailError;
        
        if(empty($Username) || empty($Email) || empty($Password))
        {
            $formError = "please fill in every box";
        }
        else
        {
        
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) 
            {
                $emailError = "Invalid e-mail format";
            }
            else
            {
                $statement =$db->prepare("INSERT INTO User (Username , Email , Password, Salt) VALUES (:username , :email , :password , :salt)");
                $statement->bindParam(':username', $Username);
                $statement->bindParam(':email', $Email);
                $statement->bindParam(':password', $salt_password);
                $statement->bindParam(':salt', $salt);
                $statement->execute();
                $formSucces = "Your Account has been created!";
            }
        }

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
?>