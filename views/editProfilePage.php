<?php
    require_once 'views/header.php';
    require_once 'models/User.php';
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    $userModel=new User();
    $user = $userModel->getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insiteful</title>
    <link rel="icon" href="../public/images/insiteful.png">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/editProfilePage.css">
</head>
<body>
<div class="container">
    <div class="left-column">
        <?php
//            if($user->profilePicture){
//                echo '<img src="'.$user->profilePicture.'" alt="Profile Picture" class="profile-picture" width="150">';
//            }
//            else{
//                echo '<img src="..\public\images\user.png" alt="Profile Picture" class="profile-picture" width="150">';
//            }
            $imgSrc=$userModel->extractProfilePic($_SESSION['user_id']);
            echo '<img src="'.$imgSrc.'" alt="Profile Picture" class="profile-picture" width="150">';
        ?>
        <h2 class="username"><?=$user->Username?></h2>
    </div>
    <div class="right-column">
        <h2 class="section-title">Edit your profile</h2>
        <form action="/editProfile/action" method="post" enctype="multipart/form-data">
            <label class="username-label">Username:</label>
            <input type="text" name="username" class="form-input" placeholder="Username">
            <label class="profile-picture-label">Profile Picture:</label>
            <input type="file" name="profile-picture" class="form-input">
            <label class="form-label">Email Address:</label>
            <input type="email" name="email" class="form-input" placeholder="Mail">
            <label class="form-label">Password:</label>
            <input type="password" name="old-password" class="form-input" placeholder="Old Password">
            <input name="new-password" class="form-input" placeholder="New Password">
            <input name="verif-password" class="form-input" placeholder="Confirm New Password">
        </form>
        <div class="button-container">
            <a href="/" class="cancel-button" rel="modal:close">Cancel Changes</a>
            <button type="submit" class="form-button">Save Changes</button>
        </div>
    </div>
</div>
</body>
