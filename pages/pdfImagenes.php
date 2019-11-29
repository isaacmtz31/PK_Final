<?php
session_start();

    $email = $_SESSION["email"];
    global $test;
    $test = $_GET["val"];
    echo "$test";
    include("./pruebaPDF.php");
?>
