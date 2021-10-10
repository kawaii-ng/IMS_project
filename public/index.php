<?php 

    include_once("../includes/header.html");
    session_start();
    include_once("../config/db-connection.php");

?>

<div class="container">

    <div class="form-section">
        <form action="/project/functions/login-functions.php" method="post" name="myForm" class="my-form">
            <h5>
                <i class="fas fa-gem"></i>
                <span>I</span>nventory <span>M</span>anagement <span>S</span>ystem
            </h5>

            <div id="login-form">
                <!-- login -->
                <h1>Login</h1>
                <label for="userID">User ID</label> 
                <input type="text" name="userID" id='login-id' placeholder="User ID" spellcheck="false">
                <label for="userPW">Password</label> 
                <input type="password" name="userPW" id='login-pw' placeholder="Password">
                <a href=""><p>Forgot password?</p></a>
                <a id="create-ac-btn"><p>Do not have a account?</p></a>
                <?php 
                    if(isset($_GET['error']) && $_GET['error'] == "login_fail")
                        echo "<p class=\"error\"><i class='fas fa-exclamation-circle'></i> Login Failed. </p>";
                ?>
            </div>

            <div id="register-form">
            <!-- register -->
            <h1>Register</h1>

            <!-- step 1 -->
            <div id="register-form-1">
                
                <h3>Personal Information</h3>
                <table width='100%' cellspacing='10px'>
                    <tr width='100%'>
                        <td colspan="2">
                            <label for="nickName">Nick Name</label> 
                            <br>
                            <input type="text" name="nickName" id="nick-name" placeholder="Nick Name" spellcheck="false">
                        </td>                          
                    </tr>
                    <tr>
                        <td>
                            <label for="gender">Gender</label>
                            <br>
                            <select name="gender">
                                <option value='male'>Male</option>
                                <option value='female'>Female</option>
                                <option value='other'>Other</option>
                            </select>
                        </td>
                        <td>
                            <label for="birth">Birthday</label>
                            <input type="date" name="birth" id='birthday'>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <label for="email">Email</label> 
                            <br>
                            <input type="email" name="email" id='email' placeholder="Email" spellcheck="false">
                        </td>
                    </tr>
                </table>
                <a id="login-ac-btn"><p>Already have a account?</p></a>
            </div>

            <!-- step 2 -->

            <div id='register-form-2'>
                <h3>Account Setting</h3>
                <table width='100%' cellspacing='10px'>
                    <tr>
                        <td colspan='2'>
                            <label for="regUserID">User ID</label> 
                            <input type="text" name="regUserID" id='user-id' placeholder="User ID" spellcheck="false">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="regUserPW">Password</label> 
                            <input type="password" name="regUserPW" id='user-pw' placeholder="Password">
                        </td>
                        <td>
                            <label for="confirmPW">Confirm Password</label> 
                            <input type="password" name="confirmPW" id='confirm-pw' placeholder="Confirm Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <label for="securityQuestion">Security Question</label>
                            <select name="securityQuestion" id="security-question">
                                <option value="What is the name of your first school?">What is the name of your first school?</option>
                                <option value="What was your favorite food as a child?">What was your favorite food as a child?</option>
                                <option value="What high school did you attend?">What high school did you attend?</option>
                                <option value="In what city were you born?">In what city were you born?</option>
                                <option value="What is the name of your favorite pet?">What is the name of your favorite pet?</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td  colspan='2'>
                            <label for="securityAns">Answer</label>
                            <input type="text" name="securityAns" id="security-ans">
                        </td>
                    </tr>
                </table>
            </div>

            <!-- step 3 -->
            <div id='register-form-3'>
                <h3>Upload Profile Image</h3>
                <div class='profile-img-container'>
                    <div class="profile-img-border">
                        <img src="./images/icon-add-128.png" alt="" class='profile-img'>       
                    </div>
                </div>
            </div>

            <div class="step-link-container">
                <a class="step-btn" id='prev-btn'>
                    <i class="fas fa-long-arrow-alt-left"></i> Previous
                </a>
                <a class="step-btn" id='next-btn'>
                    Next <i class="fas fa-long-arrow-alt-right"></i>
                </a>
            </div>

            </div>

            <input type="submit" name="submitType" value="Login" id="form-action-btn" class="my-form-btn">

        </form>
    </div>
    <img src='./images/cover-04.jpg' alt="cover_image" class="img-section">

</div>

<?php 

    include_once("../includes/footer.html");

?>