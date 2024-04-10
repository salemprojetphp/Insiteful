<?php 
    include_once "models/Visitors.php";
    include_once "utils/PDFGenerator/PDFGenerator.php";
    include_once "models/User.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $userID = $_SESSION["user_id"];
    $userModel = new User();
    $user = $userModel->getUserById($userID);
    $username = $user->Username;
    $visitors = new Visitors();
    $currentDate = date("d-m-Y");
    $websites = $visitors->getUserWebsites($userID);
    $html = "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Insiteful</title>
                <style>
                    *{
                        outline: none;
                        box-sizing: border-box;
                        font-family: 'Poppins', sans-serif;
                        color: #1F254C;
                    }

                    table{
                        border-collapse: collapse;
                        width: 100%;
                        margin-top: 10px;
                        margin-bottom: 10px;
                    }
                    td, th{
                        border: 1px solid #444;
                        padding: 8px;
                        text-align: center;
                    }
                    .bottom{
                        display: flex;
                        flex-direction: row-reverse;
                        margin-top: 50px;
                        border-top: 1px solid gray;
                        padding-top: 10px;
                    }
                    .username, .date{
                        display: flex;
                        flex-direction: row-reverse;
                        column-gap: space-between;
                    }
                </style>
            </head>
            <body>
                    <h2 class='username'>
                        $username
                    </h2>
                    <h2 class='date'>
                        $currentDate
                    </h2>";
                foreach($websites as $website):
                    $html .= "<h2>$website->website</h2>";
                    $html .= "<table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Referrer</th>
                                        <th>Country</th>
                                        <th>Device</th>
                                        <th>Browser</th>
                                    </tr>
                                </thead>
                                <tbody>";

                            $infos = $visitors->getUserWebsiteInformation($userID, $website->website);
                            foreach ($infos as $info):
                                $html .= "<tr>
                                            <td>$info->date</td>
                                            <td>$info->referrer</td>
                                            <td>$info->country</td>
                                            <td>$info->device</td>
                                            <td>$info->browswer</td>
                                        </tr>";
                            endforeach;
                            $html .= "</tbody>
                                    </table>";

                endforeach;
            $html .= "
                            <div class='bottom'>insitefulcontact@gmail.com</div>
                        </body>
                    </html>";
    PDFGenerator::generatePDF($html, "$username recap file $currentDate");
?>


