<?php

session_start();
    
    require_once("../config/setup.php");

    if (isset($_GET[''])){

    } else {
        header("Location :post.php?selectsomething");
        exit();
    }