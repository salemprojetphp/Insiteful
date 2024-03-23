<?php
require_once("autoload.php");

//function to verify emails names and passwords?

$email = $_POST["email"];

$password = $_POST["password"];

$confirmPassword = $_POST["cpassword"];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$name = $_POST["username"];

$database = Database::getDatabase();



if($password == $confirmPassword){
    try{
        $query = "insert into members(Email,Password,Username) values (?, ?, ?)";
        $queryPrep = $database->prepare($query);
        $queryPrep->execute([$email,$hashedPassword,$name]);
    }
    catch(PDOException $e){
        header("Location: signupform.php?error=Email%20Already%20Used");
    }
}
else{
    header("Location: signupform.php?error=Verify%20Password");
}

//header("localtion:home.php")