<?php

include_once('./title-bar.php');

$userSQL = "

    select * from user
    where userID = '".$_SESSION['userID']."'

";

$user = mysqli_fetch_assoc(mysqli_query($connect, $userSQL));

?>

<div class="profile-section">

    
    <form action="/project/functions/customer-functions.php?op=update_profile" method="post" class='profile-form' name='profileForm' enctype="multipart/form-data">
        
        <div>
            <h6>User ID: <?php echo $user['userID'];?></h6>
            <input type="hidden" value="<?php echo $user['userID']; ?>" name="userID">
            
            <label for="new-profile-path" id='new-profile-label'>
                <img src="<?php echo $user['icon'];?>" alt="" id="profile-img">
            </label>
            <input type='file' name='newProfileImg' id='new-profile-path' />

            <p class='error' id='new-profile-error'>
                <i class='fas fa-exclamation-circle'></i>
                Profile Image Failed to Upload. Please Try Again.
            </p>

        </div>

        <div>

            <label>Nick Name</label><span class='error' id='new-nickname-error'>
                <i class='fas fa-exclamation-circle'></i>
                Nick name is not valid.
            </span>
            <input type="text" name="nickName" id='new-nickname' value="<?php
                echo $user['userName'];
            ?>">
            
            <label>Gender</label>
            <select name="gender">
                <?php

                    echo "<option value='".$user['gender']."'>".ucfirst($user['gender'])."</option>";

                    if($user['gender'] != "male")
                        echo "<option value='male'>Male</option>";
                
                    if($user['gender'] != "female")
                        echo "<option value='female'>Female</option>";
                
                    if($user['gender'] != "other")
                        echo "<option value='other'>Other</option>";
                
                ?>
            </select>
            <label>Email</label>
            <span class='error' id='new-email-error'>
                <i class='fas fa-exclamation-circle'></i>
                Email is invalid.
            </span>
            <input type="text" name="email" id='new-email' value="<?php
                echo $user['email'];
            ?>">
            
            <label>Password</label><input type="password" name="password" id='new-pw' value="">
            <label>Confirm Password</label><input type="password" name="confirmPassword" id='new-confirm-pw' value="">
            <span class='error' id='new-pw-error'>
                <i class='fas fa-exclamation-circle'></i>
                Password should be longer than 8 and same with the confirmed password.
            </span>
            <br>
            <input type="button" value="Update" class="my-form-btn" id='update-profile-btn'>

        </div>

    </form>



</div>