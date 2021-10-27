<?php 

    include_once("./header.php");
    session_start();
    include_once("../config/db-connection.php");

    if(!isset($_GET['page'])){

        include_once('./login-page.php');

    }    

    include_once("./footer.php");

?>