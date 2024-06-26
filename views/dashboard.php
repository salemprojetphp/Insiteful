<?php
    include_once "header.php";

    
//    echo $_SESSION["user_id"];

    include_once "models/Visitors.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $userID = $_SESSION["user_id"];
    $visitors = new Visitors();
    if(isset($_GET["data"])){
        $websiteSelected = $_GET["data"];
    }
    //empty the previous json files if a website isn't selected when he opens the dashboard page
    if(!isset($websiteSelected)){
        $visitors->generateJSONFile('', "browsersDonutChart", "");
        $visitors->generateJSONFile('', "devicesDonutChart", "");
        $visitors->generateJSONFile('', "lineChart", "");
        $visitors->generateJSONFile('', "countries", "");
        $visitors->generateJSONFile('', "sources", "");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/dashboard.css">
    <link rel="stylesheet" href="public/css/general.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Analytics</h1>
    <section class="settings">
        <select onchange=redirect() id="websiteSelect">
            <option id="websiteSelected" style="display:none"><?php echo isset($websiteSelected) ? $websiteSelected : "Select website"; ?></option>
            <?php 

            $websites = $visitors->getUserWebsites($userID);
            //$websites = $visitors->getUserWebsites($currentUSer);
            foreach($websites as $website) : ?>
                <option><?php echo $website->website; ?></option>
            <?php endforeach; ?>
        </select>
        <!-- redirect redirects to a php page with information in GET about the website selected and time selected -->
        <script>
                function redirect(){
                    const websiteSelect = document.querySelector("#websiteSelect");
                    const website = websiteSelect.value;
                    window.location = "http://localhost:8000/dashboard?data="+website;
                    
                }
        </script>
        <a href="#">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAASVJREFUSEvt1sEqR0EUx/HPf83CE4i8gJI97yBbFoq8BB5CSim2fw/BAyi2LPAIUrL1n3+ubrdhhpn+lzJ1NzNzznfO+Z07cwZ6GoOeuHLAU1jDfMEhHzDEa+MjBZ7BFRYKoI3pLZbwEiZS4F0cVoA2LrZwkgPex15F8MHIV/CZjPhXg8/wiDlsJLJTNeJVXI6+FVz8KXBbz6baczQujjgXHDQ9baX0Bk8I//xia34zonlU41zwh3FCz1i2isC9RdwNdGIa/4OLb67cqi55M4qqeiLgHRyVkDq22zjuPouxVIfb6Pr95Snl32EZzzngsGca65gtIN/j/LOeKxZxAetr03bP1Ru4ViGlGshxKtqbahXSt8G1CmncRaZG1ulSTn6y3hv4Db9LWh8Uf/+cAAAAAElFTkSuQmCC"/>
        </a>
        <a href="/dashboard/pdf">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAATtJREFUSEvt1rEuBVEQxvHfVRAVEr3GA4iIKCTUEoV4B0olj0Cp5B1EIVGTKEREPIBGL0ElFLgnuQprz91zdiUbck+5Z2b+M9/OzG5HS6fTEtefAc9gPKLSE25TFcyt+AxLkeDnWB6AYwoMpK7qjf/dXGvYKkgQ5ngsIstzyRzv47jMvl9zhbsjhATqnABcx0cuONgPIyyGhUzyZW/RvDUZpwlcYToRfof57mt67GefOsdTuMZkBfwBc7ivSjIVHOLM4gKjkaAvWMRNFTTc54CD/QpOMFQI/o7VrsSnKdA64OCzgYMCYBOHqdC64OC3i+0eaA87OdAm4K8ZDzGis/obXV0WY6T38DW32iYV12F984l1dfIvTGIG4auWBC7dr4mQMrMfBcYqbg3cmtQNVE1zzV2ZaVETrFoDfwKFjDEfBnUGFgAAAABJRU5ErkJggg=="/>
        </a>
    </section>
    <section class="categories">
        <div id="visits">
            <h2>
                <?php
                    if(isset($websiteSelected)){
                        echo $visitors->getNumberOfVisits($userID,$websiteSelected);
                    }
                    else{
                        echo "???";
                    }
                ?>
            </h2>
            Visits
        </div>
        <div id="search-engines">
            <h2>
                <?php
                    if(isset($websiteSelected)){
                        echo $visitors->getNumberOfSearchEngines($userID, $websiteSelected);
                    }
                    else{
                        echo "???";
                    }
                ?>

            </h2>
            Search engines
        </div>
        <div id="social-networks">
            <h2>
                <?php
                   if(isset($websiteSelected)){
                    echo $visitors->getNumberOfSocialMediaVisits($userID,$websiteSelected);
                    }
                    else{
                        echo "???";
                    }

                ?>
            </h2>
            Social networks
        </div>
        <div id="direct">
            <h2>
                <?php
                   if(isset($websiteSelected)){
                        echo $visitors->getNumberOfDirectVisits($userID,$websiteSelected);
                    }
                    else{
                        echo "???";
                    }

                ?>
            </h2>
            Direct
        </div>
    </section>
    <section class="data-visualisation">
        <div class="chart-container">
            <div class="chart">
                <?php
                //generating the json file to be used in the javascript script to create the chart
                    if(isset($websiteSelected)){
                        $visitors->generateChartJSONFile($userID, $websiteSelected, "date", "lineChart");
                    } 
                ?>
                <canvas id="lineChart"></canvas>
                <script src="/public/js/dashboard/lineChart.js"></script>        
            </div>
        </div>
    </section>
    <section class="users-info">
        <div class="users-info-container">
            <div class="sources">
                <div class="source-title">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAyhJREFUSEvFllnITVEUx38fooiEEkqUOeRFmcqDB5FMRSTyIKIMhTIkQ6aQDA+mB5FkCA8yFA+SIkMykzlzSJKEDPv/tc7Xubu9zzn3vtz1cu/Ze6313+u/11p71VAlqakSLuUC1wf6AR2ANnbot8Bz4Crwp2ggRYE7A4uBMUDziPPPwAlgHfAs7wB5wI2B9cAsQNEWkV/ARmAVoP9ByQIWnSeBnmYpJ8cc1WeB28AToIHR3gcY5tbH2ppMRP1I4EMIOQbcHbgEtDCjMxb1i5yQOwE7gSGm98Zy4rVvFwJuDdwA2pnySve7ogjHpiOfG4AF9v0A6At8T/sIAR8GxpvScrurMnDrVLcAc+1rKzAvC7iX3Z90TgEjKkE0GyXjRWAA8NtyQaVXK37E+1wpTDFaugB1ijkH6AZMAHpbgiXqXYG7lnBr3QGWhoAbAp+ApsAOS6YsvARsHNAjIx9U26MBJWbHELAy8bxtDAeUySHR/atGFY0vuipFmJZpLlH32IJYfOxTPRXYawrK6BjNDyOgjwCx4Itq/KYtqq7VG0rueKGVgdYbRbqOHKs8QhIrO7XYL2agzFaGlwDPBzaZQjPgW8C76lklFhI1HbHhi3x9tUVhbPaBJwIHTUGRiTpfYjTfAkRpSJR492xDma8+URKxnrvLpqBDHPK8qGffCXjWAZe4UjoeAZ4M7Lc9dbDrPrBq+iPQEjgAyCAtaZrvA0ftcCF603ZHXMQqufdAW3dV/3xgfe9y2Twd+GGZ+yrlQRHpVRITeWCJmUpONuoR24E5yYbfuaSorNX6OUf90OSEERqzltUyL7jeMAj461jUy6VJpVZCj4RonmT7q904s6wCUJlsA2ab7W5gRtpPCLgVcM2aunTVpWIlFDpTPSuZ5GXSteihSGo5GrE2NGNd8QaBmcDLnOhVy+rzg01P3W+g9ekS03JGn59WMqetrDT6KGnU+FUm6vUafZLZTKyNchS/Cx02b9hr4p403bOyURQWEc1mGhDXVDrspUHUyRbZeKsWGBKNtxoG9e7mXUnZA72myv5Ae2+gf2oJqbIpJHlUF3JSiVLVgP8D8J2TH19wGSUAAAAASUVORK5CYII="/>
                    <h2>Sources</h2>
                </div>
                <?php
                    if(isset($websiteSelected)){
                        $visitors->generateChartJSONFile($userID, $websiteSelected, "referrer", "sources");
                    } 
                ?>
                <script src="/public/js/dashboard/sources.js"></script>

            </div>
            <div class="countries">
                <div class="country-title">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAA5dJREFUSEvFl2fIjlEYx3+vUVayR8kmMj4oq5RVilCSlS1kU1JEyhaSlcjKKDtkfjCysks+oGTvnVlknX9dt85zO89zP4/eeq8v73nOfc71P9d1/ud/XW8eBWR5BYRLrsCFgVZATaCqHfoZcB+4DPzMNpBsgesB04AeQJk0zt8C+4AFwL2kAyQBlwAWAmMARZuNfQcWA7MBjYOWCbgGcBhoFNj5GVAW5PgOUC6w5grQ1R36VQg5HXBD4Jzn8DRwAxhvTsYCq23cF9huY83VBTrZ76dAa+BxHDwEXAXQaasBv4HhwEbgFtDA7k/R/jJn8nEdaArctAwNAja5dBeyOYF/9MFDwDvd4t4GOhjYCjQDrtnG0cCaWAR+1G2BM+4K+rvot9m65cCkTMBNLKVas8Gi1XiWi3Am8AMoC+iOfSsGvHdE1N8dQD/7KB/D3Iv4BtQCnkeb4hFvdqlUmgRQx216ZAtPAe0sEkUUsl1AL+ATUNoWiKB37UXMB6aHgIsC74BSwEGgu3eHX4DiQMrmGPo4YKXNSVxe2Fgvo4uxv34IuCNw3D6IvatsXAl4meF+I1/+/g6AsiSb6ERnmY0FrOeXIplDjIma171IBmW6G7FaNgM4nybVOqCIKVtiGqCxwNbafDfgUBx4CrAojdP8mhazxfCUiCfbSfMLJORHGEvjwP5b9FNd3aVbbJfNAU6mOVkFJx67A6mubU9Tn/oAYn9KxCp3F2yj1EpvUFYeeGNjXYfuL2RtgLP2obMrn8c8X+ts3Nzp99U4sKqPnoBOrghFtmjNVxMHabF0OmRDPRKKkA9sUaQNqtuRDP/TCIh9I02ZlKLXtlmZUEak4S3SAEtaB9geMVxW2QSkpL3xCdHeuHKJ+rftCtYDI2zhCqtM6jDUCMQlU37UCEhOdYe6S5kKhTKngiIljLIQbH0k7BJ4meRTkfjioAISkSgKQCp3wH5Ip6XXA4EtNqdMjvIzFapOFa1/Ul+lk+r0+023JYWXLO2+HzG9vem01qge77GyqHKqsvghCVjfVW8veo3AEbs7lUmZtPeojSWPJ2ysNIukPe23CNXSVbkncV5kan0UsYpF4wCZ5FBdikBU/NU8xE31WxL5txRmE3G0Rmyc66qW2KhuIhtTH6YGcd7/Nns+iFqeqdbeRrU2fgixeq+VzodJJ0xqb+P7ixhRJKN+Q69irzce9WFJuDn/J5HoMNsFuUacrd/EdX8AF1i0Hzzzo+MAAAAASUVORK5CYII="/>
                    <h2>Countries</h2>
                </div>
                <?php
                    if(isset($websiteSelected)){
                        $visitors->generateChartJSONFile($userID, $websiteSelected, "country", "countries");
                    } 
                ?>
                <script src="/public/js/dashboard/countries.js"></script>
            </div>
        </div>
    </section>
    <section class="devices-info">
        <div class="devices-container">
            <div class="devices">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAXtJREFUSEvll70uRUEQx3/XI2glvmrCG+ARUEg0NHpR+7h4AGqtEFEpVYLQEhEtUXsAHw37T+4mm5s9Z8eek5yb3OnuyX/nNzO7O7O3RUPWaohLz4IV2CQwWLEyb8B76KMs4yHgEpioCPXLj4EV4FcfysBHwFpNUO9mHrhIga+AOeAJWM8IYLWTYbh0B9hLga+BGQe/AWYzwG1XVoFC23U/9D1a6hFgDDgEpiIZfwGPwHciGDN4ADgFlgzZfbiAtF/3JVozeBk4MUC9RHs/XQd425VeeyDToSoyf2h0LVSlIjNnHArLrlmOzgcXPVw5Dq0B1gJW1NqW1HWsvdT9B1bL22qi1P0H3gc2myh1eKo1uYpsFNDACW0DOOi+h+G9860z5lQjUuPyv/bZec28doPDXm1xql59axECginTZ68PW57G4ZnRkWQvVd5jIViT5txFtWiAax4vAHcGbVQSa/LjwHCJQ71AHoCfXGiqyVfxm1zbs/8kkpHnCv4A5OpdHwlmzyAAAAAASUVORK5CYII="/>
                <h3>Devices</h3>
                <?php if(isset($websiteSelected)){
                        $visitors->generateChartJSONFile($userID, $websiteSelected, "device", "devicesDonutChart");
                }
                ?>
                <canvas id='devicesDonutChart'></canvas>
                <script src="public/js/dashboard/devicesDonutChart.js"></script> 
            </div>
            <div class="browsers">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAvVJREFUSEvFlknIjlEUx39fZhvExoJELAyZo8xlKGMhs2RaWEiGKNOKMpSFjZApc5GiRDJT5inJvDEWmTNG7l/nqee97n2e93376ju757nnnP+95/zPUEEVSUUV4VIqcAOgL9AWqGaX/gjcAm4D74p9SLHAI4FpwCCgesT5H+AssAXYnXeBPOBmwE6gZ54j7/wiMB14ELPLAh5moPVKBE3UPwD9gesh+xjwGGB/mYBps89AL8t/gbsY8DHLZyVg8wjoAHxNOwsBjwXeuJuerAxU87EdmJoF3A24BPQAFgNDAuA/gXXA8RIvdh74ndj4L97jmDje2DgOuOk5vwBMAboAre3sBnDY6Y4A5mZcRiSbHwKuBbwH6tjhAsfqFsAs+9YL5wG7gI4egOpW5aOLq+ZD8g1QhfzSYfrFva0BJEZfgK4W+u/2wqtA84jjE4Ci9AKoHdFRKq/4wDOBTZ7BDleLCm974DRwMCevAlbIla6QiGAiWsGLF7owrw5oKxKPXRrmAItygEVIRXFlRE85FjELgJe4PrwiYHAZ6O7Ct6oI4KXAD2BtBFiXX+8DzwA2RwyGAw2BbTkvHm2hnhzRmwDs9YH7uJF3JmLwxEahOpr0QvIUGAjcA2pGdDolJZpmdQ1XLp8yGKmSUYkdsTpO+1aNilTiwOwIqKpE5aTx+d8ioBE4KSOcG1zPFQlVs1oKJKp9/VdDuZZaEHw3SpNm+j/xO1dnM85K5StXXoesn0uvnTWZoy4aso+JSvJODFj/DwCjckiUPtbGocG/NcNGHW1i+jw0nbR1qP8mocy6gzqa9i8NgMYRxbfWgF7mASfhOwU0ynm5end9R5jlEb3Xrg33c630vn+etfo0deNR/bdVxKmcDQXuRipB/wc7Ij4L2ecte3VtLqvV+Y1fC+CywKai6bPGuqBSEZQ84MSoiY3EAUAbG40ik9KRiDbKfS7XGwExP1OKBU47aQmIMBoemssPgXPA8zywYshVio+ydMt5cVlAvtFfz0SEH9RaN3YAAAAASUVORK5CYII="/>
                <h3>Browsers</h3>
                <?php if(isset($websiteSelected)){
                        $visitors->generateChartJSONFile($userID, $websiteSelected, "browser", "browsersDonutChart");
                }
                ?>
                <canvas id="browsersDonutChart"></canvas> 
                <script src="public/js/dashboard/browsersDonutChart.js"></script> 
            </div>
        </div>
    </section>
    
</body>

</html>
<?php
include_once 'footer.php';?>