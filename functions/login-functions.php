<?php

session_start();
include_once('../config/db-connection.php');

function loginAC($userID, $userPW) {

    global $connect;

    $userSQL = "select * from user
    where userID ='" . $userID . "'";
    $userQuery = mysqli_query($connect, $userSQL);
    $user = mysqli_fetch_assoc($userQuery);

    if($userID == $user['userID'] && $userPW == $user['password']){

        // setting cookie
        if(!isset($_COOKIE['userID'])){

            // first time login
            setcookie('userID', $userID, time() + (60 * 60 * 24));
            setcookie('userPW', $userPW, time() + (60 * 60 * 24));
            $_SESSION['userID'] = $userID;
            header("Location: /project/public/customer-page.php?page=products");
        
        }else {
        
            if($userID == $_COOKIE['userID'] && $userPW == $_COOKIE['userPW']){

                // valid user
                header("Location: /project/public/customer-page.php?page=products");
        
            }else {
        
                // invalid user
                setcookie('userID', $userID, time() - (60 * 60 * 24));
                setcookie('userPW', $userPW, time() - (60 * 60 * 24));
                header("Location: /project/public/index.php?error=invalid_user");
        
            }
        
        }

    }else{

        // login unsuccessfully
        header("Location: /project/public/index.php?error=login_fail");

    }

}

// login

if($_POST['submitType'] == "Login"){

    $userID = $_POST['userID'];
    $userPW = $_POST['userPW'];

    loginAC($userID, $userPW);

}

// register

if($_POST['submitType'] == 'Register'){

    $userID = $_POST['regUserID'];
    $userPW = $_POST['regUserPW'];

    $userSQL = "select * from user
    where userID ='" . $userID . "'";
    $userQuery = mysqli_query($connect, $userSQL);
    $user = mysqli_fetch_assoc($userQuery);

    if($user == null){

        $imgName = $_FILES['regProfileImg']['name'];
        $imgTMP = $_FILES['regProfileImg']['tmp_name'];
        $imgEX = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
        $imgPath = "../uploads/profile/" . $imgName;

        if(!$imgName){

            $imgPath = "\'\'";

        }

        move_uploaded_file($imgTMP, $imgPath);

        $userSQL = "INSERT INTO `user` (
            `userID`, `userName`, `password`, `gender`, 
            `birthday`, `email`, `icon`, `question`, `answer`
        ) VALUES (
            '". $_POST['regUserID'] ."', '". $_POST['nickName'] ."', 
            '". $_POST['regUserPW'] ."', '". $_POST['gender'] ."', 
            '". $_POST['birth'] ."', '". $_POST['email'] ."', 
            '$imgPath', '". $_POST['securityQuestion'] ."', '". $_POST['securityAns'] ."'
        )";
    
        if(mysqli_query($connect, $userSQL)){

            loginAC($_POST['regUserID'], $_POST['regUserPW']);

        }else{

            header("Location: /project/public/index.php?error=register_fail");

        }

    }else{

        header("Location: /project/public/index.php?error=user_exist");

    }

}

// logout 

if(isset($_GET['op']) && $_GET['op'] == 'sign_out'){

    setcookie('userID', $userID, time() - (60 * 60 * 24));
    setcookie('userPW', $userPW, time() - (60 * 60 * 24));
    session_unset();
    session_destroy();
    header("Location: /project/public/index.php");

}

?>