<?php 
    include_once "models/Visitors.php";
    include_once "utils/PDFGenerator/PDFGenerator.php";
    include_once "models/User.php";
    $userModel = new User();
    $user = $userModel->getUserById(1);
    $username = $user->Username;
    $visitors = new Visitors();
    $websites = $visitors->getUserWebsites(1);
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
                    h2{
                        text-align: center;
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
                </style>
            </head>
            <body>";
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

                            $infos = $visitors->getUserWebsiteInformation(1, $website->website);
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
            $html .= "</body>
                    </html>";
    PDFGenerator::generatePDF($html, $username)
?>


