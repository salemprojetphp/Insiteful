<?php
function autoloader($className){
    require_once "Classes/$className.php";
}
spl_autoload_register("autoloader");