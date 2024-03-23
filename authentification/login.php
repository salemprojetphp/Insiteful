<?php

$email = $_POST["email"];

$password = $_POST["password"];

require_once("autoload.php");

$database = Database::getDatabase();

$query = "select Password from members where Email = ? ";

$queryPrep = $database->prepare($query);

$queryPrep->execute([$email]);

$queryResult = $queryPrep->fetch(PDO::FETCH_OBJ);

if($queryPrep->rowCount() == 0){
    echo "Wrong email";
    header("Location: loginform.php?error=Wrong%20Email");
}
elseif (!password_verify($password, $queryResult->Password)){
    echo "Wrong password";
    header("Location: loginform.php?error=Wrong%20Password");
}
else{
    echo "Correct information";
    //header("location:home.php");
}

