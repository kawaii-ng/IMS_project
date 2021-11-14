<?php

session_start();
include_once('../config/db-connection.php');

function loginAC($userID, $userPW) {

    global $connect;

    $userSQL = "select * from permission
    where userID ='" . $userID . "'";
    $userQuery = mysqli_query($connect, $userSQL);
    $user = mysqli_fetch_assoc($userQuery);

    echo $userID; 

    if($userID == $user['userID'] && password_verify($userPW, $user['password'])){

        // setting cookie
        if(!isset($_COOKIE['userID'])){

            // first time login
            setcookie('userID', $userID, time() + (60 * 60 * 24));
            setcookie('userPW', password_hash($userPW, PASSWORD_BCRYPT), time() + (60 * 60 * 24));
            $_SESSION['userID'] = $userID;
            $_SESSION['role'] = $user['role'];
            
            if($user['role'] == "admin"){

                header("Location: /project/public/dashboard-page.php?page=stock_checking&table=inventory");
                // $_SESSION['page'] = 'stock_check';
                
            }else {
                
                header("Location: /project/public/dashboard-page.php?page=products");
                // $_SESSION['page'] = 'products';
                
            }
            
            // header("Location: /project/public/dashboard-page.php");
        
        }else {
        
            if($userID == $_COOKIE['userID'] && password_verify($userPW, $_COOKIE['userPW'])){

                
                // valid user
                if($user['role'] == "admin"){
                    
                    header("Location: /project/public/dashboard-page.php?page=stock_checking&table=inventory");
                    // $_SESSION['page'] = 'stock_check';
                    
                }else {
                    
                    echo "ok";
                    header("Location: /project/public/dashboard-page.php?page=products");
                    // $_SESSION['page'] = 'products';
                    
                }
                
                // header("Location: /project/public/dashboard-page.php");
                
            }else {
        
                // invalid user
                setcookie('userID', $userID, time() - (1060 * 60 * 24));
                setcookie('userPW', $userPW, time() - (1060 * 60 * 24));
                header("Location: /project/public/index.php?error=invalid_user");
        
            }
        
        }

    }else{

        // login unsuccessfully
        echo "not ok";
        header("Location: /project/public/index.php?error=login_fail");

    }

}

// login

if(isset($_POST['submitType']) && $_POST['submitType'] == "Login"){

    $userID = $_POST['userID'];
    $userPW = $_POST['userPW'];

    loginAC($userID, $userPW);

}

// register

if(isset($_POST['submitType']) && $_POST['submitType'] == 'Register'){

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

        $loginInfoSQL = "

            INSERT INTO `permission`(
                `pid`, `userID`, `password`, `role`
            ) VALUES (
                NULL,'".$userID."','".password_hash($userPW, PASSWORD_BCRYPT)."','user'
            )

        ";

        $userSQL = "INSERT INTO `user` (
            `userID`, `userName`, `gender`, 
            `birthday`, `email`, `icon`, `question`, `answer`
        ) VALUES (
            '". $_POST['regUserID'] ."', '". $_POST['nickName'] ."', 
            '". $_POST['gender'] ."', '". $_POST['birth'] ."', 
            '". $_POST['email'] ."', '$imgPath', 
            '". $_POST['securityQuestion'] ."', '". $_POST['securityAns'] ."'
        )";
    
        if(mysqli_query($connect, $loginInfoSQL) && mysqli_query($connect, $userSQL)){

            loginAC($_POST['regUserID'], $userPW);

        }else{

            header("Location: /project/public/index.php?error=register_fail");

        }

    }else{

        header("Location: /project/public/index.php?error=user_exist");

    }

}

if(isset($_POST['submitType']) && $_POST['submitType'] == 'Reset'){

    $userID = $_POST['resetUser'];
    $userPW = $_POST['resetPW'];


    $resetSQL = "
        
        UPDATE `permission` 
        SET 
        `password`='". password_hash($userPW, PASSWORD_BCRYPT) ."'
        WHERE userID = '".$userID."'
    
    ";

    if(mysqli_query($connect, $resetSQL)){

        loginAC($userID, $userPW);
    
    }else {

        header("Location: /project/public/index.php?error=reset_fail");
        
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