<?php

session_start();

if(!isset($_SESSION['step'])){

    $_SESSION['step'] = 1;

}

function nextStep() {

    $_SESSION['step'] = $_SESSION['step'] + 1;

}

function prevStep() {

    $_SESSION['step'] = $_SESSION['step'] - 1;

}

if($_GET['op'] == 'next_step'){

    nextStep();
    header("Location: /project/public/index.php?register_step=" . $_SESSION['step']);
    
}

if($_GET['op'] == 'prev_step'){

    prevStep();
    header("Location: /project/public/index.php?register_step=" . $_SESSION['step']);

}

?>