<?php

if (isset($_POST["btnCreateAccount"]))
{
    CreateAccount();
}

if (isset($_POST["btnLoginAccount"]))
{
    LoginAccount();
}

function CreateAccount()
{
    require("Database.php");
        $Username = test_input($_POST['username']);
        $Email = test_input($_POST['email']);
        $Password = $_POST['password'];
        $salt = PASSWORD_DEFAULT;
        $salt_password = password_hash($_POST['password'], $salt);
        global $formError;
        global $formSucces;
        global $emailError;
        global $duplEmail;
        global $duplUsername;
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
            else if (emailExists($Email))
            {
                $duplEmail = "That E-mail is already in use";
            }
        
            else if (usernameExists($Username))
            {
                $duplUsername = "That Username is already in use";
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
}

function LoginAccount()
{
    session_start();
    include 'Database.php';
    global $SuccesVar;
    $LoginUsername = $_POST['uid'];
    $LoginPassword = $_POST['pwd'];

    $statement = $db->prepare('SELECT * FROM User WHERE Username = :LoginUsername;');
    $statement->bindParam(':LoginUsername', $LoginUsername);
    $result = $statement->execute();
    $user = $result->fetchArray() ;
    $pass = $user['Password'];
    $LoginEmail = $user['Email'];
    $ID = $user['User_id'];

    if(password_verify($LoginPassword, $pass))
    {
        $SuccesVar = "success";
        $_SESSION['user_id'] = $ID;
        $_SESSION['email'] = $LoginEmail;
        $_SESSION['username'] = $LoginUsername;
        header('Location: Mainpage.html');
    }
    else
    {
        $SuccesVar = "fail";
    }
}

function LogoutUser()
{
    echo "Logout is called";
    session_start();
    session_destroy();
}
             
function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function emailExists($Email) 
{
    include 'Database.php';
    $statement = $db->prepare("SELECT Email FROM User WHERE Email = :Email");
    $statement->bindParam(':Email', $Email);
    $result = $statement->execute();
    $rows = 0;
    while($row = $result->fetchArray()) 
    {
        $rows += 1;
    }
    if($rows >= 1) 
    {
        return true;
    } 
    else
    {
        return false;
    }
}

function usernameExists($Username) 
{
    include 'Database.php';
    $statement = $db->prepare("SELECT Username FROM User WHERE Username = :Username");
    $statement->bindParam(':Username', $Username);
    $result = $statement->execute();
    $rows = 0;
    while($row = $result->fetchArray()) 
    {
        $rows += 1;
    }
    if($rows >= 1) 
    {
        return true;
    } 
    else
    {
        return false;
    }
}
    
?>