<?php
session_start();
session_destroy();

header("Location: ../main/index.php");//Nos regresa al login