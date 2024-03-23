<?php
require_once("autoload.php");

//function to verify emails names and passwords?

$email = $_POST["email"];

$password = $_POST["password"];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$name = $_POST["username"];

$database = Database::getDatabase();

$query = "insert into members(Email,Password,Username) values (?, ?, ?)";

$queryPrep = $database->prepare($query);
try{
    $queryPrep->execute([$email,$hashedPassword,$name]);
}
catch(PDOException $e){
    header("localtion:signupform.php?error=Email%20Already%20Used");
}

//header("localtion:home.php")