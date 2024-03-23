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

$queryPrep->execute([$email,$hashedPassword,$name]);

//header("localtion:home.php")