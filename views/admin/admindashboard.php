<?php
    session_start();
    include_once "models/Visitors.php";
    include_once "models/User.php";
    $visitors = new Visitors();
    $userModel = new User(); 
    // $user = $userModel->getUserById($_SESSION['user_id']);
    // echo $_SESSION['user_id'];
    // if(!isset($user) || $user->Role != 'Admin'){
    //     echo "404 - not found";
    //     return false;
    // }
    include_once "views/header.php";
?>

<link rel="stylesheet" href="public/css/dashboard.css">
<link rel="stylesheet" href="public/css/general.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h1>Analytics</h1>
<!-- using the same classes for the css styling -->
<section class="data-visualisation"> <!-- websites tracked line chart-->
    <div class="chart-container">
        <div class="chart">
            <?php
                $visitors->generateAdminChartJSONFile("website", "websitesLineChart"); 
            ?>
            <canvas id="websitesLineChart"></canvas>
            <script src="public/js/dashboard/admindashboard/websitesLineChart.js"></script>        
        </div>
    </div>
</section>
<section class="devices-info"> <!-- information about blogs -->
    <div class="devices-container">
        <div class="devices"> <!-- informations about likes-->
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAYZJREFUSEvl1r9LVXEYx/HXxcWhIDBoqJyCFqFoaopMiIygSVEaXGvqDwj6AeUcLerWJEiLOCQuFUI4Fg7S0hQtDiE0RA7W9wvnXo6nc73ee+73CPms5/t93ny+53k+z9NwRNE4Iq4q4POYwFt86VZAr+AhfMRF/MZNrHcD7wV8Eh9wJQdawd2U4EGs4VoB8gaTqcADWMadEsB9LKQCL2K6JPkfnMaPFOCXeNgm8ftQWDe6gcazhymuq9g4IPEDzFcFP0JMdBajWfVeR1RVJb5jDi+aSfKKxzMzaH7rJ7iZ81bWFfueOqp9npOVAhwZs8V//BRPEoOfhfyRs0/xfw2+h+gHtSreRpxou3WDW4VVJ/hX6OMz+FnWxymL61XRcvMGkgq8h2FE92pFHeClsBpNFf22DvAlbB4EfhzaKzpLP736HcbKpkte8Qxe9xl8G6udwCfCwvYJF7KDVYfEFkaC/8cN5Z8oWwQi+Bw+Ywenwq51uYdh/A1f2907zAbSA7PzleMH/gsZylsfNRWwMwAAAABJRU5ErkJggg=="/>
            <h3>Likes</h3>
            <?php
                $visitors->generateAdminDonutChartJSONFile("likes", "likesDonutChart");
            ?>
            <canvas id='likesDonutChart'></canvas>
            <script src="public/js/dashboard/admindashboard/likesDonutChart.js"></script> 
        </div>
        <div class="browsers"> <!-- informations about comments-->  
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAQ9JREFUSEvt1zFOw0AQheEvNQXcACIuEAlRwyFyhEhI9NQkPS0NEgUtXIL0FLRBCskVQEK0iQsjYxkym8SYCFzaM+/febNaz7Y09LQa4iqDt9BFe80LmuAW77luEbyDB+yvGZrLjXCAt+xFEXyKy5qguWwP12VwH+c1gwdz/YzzqeJ/cO76Cx4TW9DBdkVOktVDHCeC73G0seDGrE50+dvwpB5HKt7DbmCFSeDI5oqeAZsBbszqQOvCIUlWh1UDgX8PfIKrn/4tPuEQrxHwDaaB3i0KecbdVzNX+RD42AiLVJf5Xpy5iuCL+VB2toxgNKcKXDu0qsfZXF1rpVVzdTZPj6NWrRr3a64wqxYSzp8BzmhIH416I5UAAAAASUVORK5CYII="/>
            <h3>Comments</h3>
            <?php 
                $visitors->generateAdminDonutChartJSONFile("comments", "commentsDonutChart");
            ?>
            <canvas id="commentsDonutChart"></canvas> 
            <script src="public/js/dashboard/admindashboard/commentsDonutChart.js"></script> 
        </div>
    </div>
</section>
<section class="users-info">
    <div class="users-info-container">
        <div class="users"> <!-- Users -->
            <div class="countries-title">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAb1JREFUSEvN1k3ITUEYB/DfK18lJcmOhCyUKCs7lGJhQcpGoXyUlJ0US5LsUD42rFCilLKwYMVCCYWVfKWUkgUbCTN1jt6ue95nzts5XbOd5/x/M819Zu6YEY2xEbkmA0/BNiyvFv0SN/C7zSbawmtwBcsGkFfYiceleBt4Pe5iekP4d2zAoxK8FJ6F95gbhH7AUvyI8FJ4Ly5FYdV8Pv+bUW0pfAH7o7Bq/jQOR7Wl8EXsi8Kq+fM4ENWWwkdxPAqr5o/gVFRbCueefRGFVb28JLXWm6i2FM45l7ErCDyDQxGa59vAM6obanNDcF7YHvzqGq4XugNbxvX0J1zD7RKwrmmz4za5Ye1/Dy/A1nQjrUiPxKLUWlMHtvQz/fDepiN4hlv4GG052vFKnMSmKGhg/k51e+VXa+iYCM431TlMa4nW5fmh2J2e0KvDvm+Ct+P6JMHxn+XW2oh7g1nD4Plppe8wswM4R3zBQuT3+u8YBp/FwY7QOuZYOrITEfw5ne28juEnWD0RvBivO0bruNn41nRz5T9zD3uCc2s+b4LX4n5P8Do8aILnYFVP8FN8bYJ7Mv+Nja7M3hYyMvgPElg8H/XErXYAAAAASUVORK5CYII="/>
                <h2>Users : <?php echo $userModel->getNumberOfUsers(); ?></h2>

            </div>
            <?php
                $users = $userModel->getUsers();
                foreach($users as $u) : ?>
                    <div class="source-country-item">
                        <div class="name">
                            <?php echo $u->Username; ?>
                        </div>
                        <div class="percentage">
                            <?php echo $u->id; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    </div>
</section>


</body>