<?php

session_start();

$userID = $_POST['userID'];
$userPW = $_POST['userPW'];

if($_POST['submitType'] == "Login"){

    echo "login";


}

if($_POST['submitType'] == 'Register'){

    echo "register";

}

// if(!isset($_COOKIE['userID'])){

//     // first time login

//     setcookie('userID', $userID, time() + (60 * 60 * 24));
//     setcookie('userPW', $userPW, time() + (60 * 60 * 24));

// }else {

//     if($userID == $_COOKIE['userID'] && $userPW == $_COOKIE['userPW']){

//         // valid user
//         header("Location: /project/public/customer-page.php?page='products'")

//     }else {

//         // invalid user
//         setcookie('userID', $userID, time() - (60 * 60 * 24));
//         setcookie('userPW', $userPW, time() - (60 * 60 * 24));

//     }

// }

?>