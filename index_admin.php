<?php

session_start();
$connected = isset ($_SESSION["connected"]) ? true : false;
if (!$connected) {
    header("location:login.php");
}