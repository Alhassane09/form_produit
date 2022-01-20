<?php
session_start();
unset($_SESSION["connected"]);
header("location:login.php");
