<?php 

/*
* main purpose is to check the user id in register process and reset password process. 
* also, obtaining the security quesiton and answer after checking the user id
*/

include_once('../config/db-connection.php');
session_start();

$userSQL = "

    select * from user
    where userID = '".$_POST['id']."'

";

$userQ = mysqli_query($connect, $userSQL);

if($_POST['op'] == 'check_id_exist'){

    $isExist = false;

    if($userQ){

        while($user = mysqli_fetch_assoc($userQ)){

            $isExist = true;
            echo 'true';

        }

        if(!$isExist){

            echo 'false';

        }

        
    }
    else 
        echo 'false';

}

if($_POST['op'] == 'check_user_id'){

    if($userQ){

        $isNoQ = true;

        while($user = mysqli_fetch_assoc($userQ)){
        
            $isNoQ = false;
            echo $user['question'];
        
        }

        if($isNoQ){

            echo 'false';

        }
        

    }else{
        
        echo 'false';        

    } 

}

if($_POST['op'] == 'check_answer'){

    if($userQ){

        while($user = mysqli_fetch_assoc($userQ)){

            if($user['answer'] == $_POST['ans']){

                echo 'true';

            }else {

                echo 'false';

            }

        }

    }else {

        echo 'false';

    }

}


?>