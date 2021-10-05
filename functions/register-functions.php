<?php

session_start();

if(!isset($_SESSION['step'])){

    $_SESSION['step'] = 1;

}

if(!isset($_SESSION['isRegister'])){

    $_SESSION['isRegister'] = false;

}

function nextStep() {

    $_SESSION['step'] = $_SESSION['step'] + 1;

}

function prevStep() {

    $_SESSION['step'] = $_SESSION['step'] - 1;

}

if($_GET['op'] == 'register' || $_GET['op'] == 'login'){

    

}

if($_GET['op'] == 'next_step'){

    nextStep();
    if($_SESSION['step'] == 2){


        echo $_POST['firstName'];

    }else{


        header("Location: /project/public/index.php?register_step=" . $_SESSION['step']);

    }
    
}

if($_GET['op'] == 'prev_step'){

    prevStep();
    header("Location: /project/public/index.php?register_step=" . $_SESSION['step']);

}

?>