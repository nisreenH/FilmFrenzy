<?php
session_start();
    if(isset($_SESSION['username']) &&  $_SESSION['useremail']) {
    //unset($_SESSION['username']);
    //unset($_SESSION['islogin']);
    session_destroy();
    }
    header("location:../php/index.php"); 
?>