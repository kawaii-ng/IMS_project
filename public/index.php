<?php 

    include_once("../includes/header.html");
    session_start();

?>

<div class="container">

    <div class="form-section">
        <form action="" method="post" class="my-form">
            <h5>
                <i class="fas fa-gem"></i>
                <span>I</span>nventory <span>M</span>anagement <span>S</span>ystem
            </h5>

            <div id="login-form">
                <!-- login -->
                <h1>Login</h1>
                <label for="userID" name="userID">User ID</label> 
                <input type="text" name="userID" placeholder="User ID" spellcheck="false">
                <label for="userPW" name="userPW">Password</label> 
                <input type="password" name="userPW" placeholder="Password">
                <a href=""><p>Forgot password?</p></a>
                <a id="create-ac-btn"><p>Do not have a account?</p></a>
            </div>

            <div id="register-form">
            <!-- register -->
            <h1>Register</h1>

            <!-- step 1 -->
            <div id="register-form-1">
                
                <h3>Personal Information</h3>
                <table width='100%' cellspacing='10px'>
                    <tr width='100%'>
                        <td>
                            <label for="firstName" name="firstName">First Name</label> 
                            <br>
                            <input type="text" name="firstName" id="first-name" placeholder="First Name" spellcheck="false">
                        </td>
                        <td>
                            <label for="lastName" name="firstName">Last Name</label> 
                            <br>
                            <input type="text" name="lastName" id="last-name" placeholder="Last Name" spellcheck="false">
                        </td>                                
                    </tr>
                    <tr>
                        <td>
                            <label for="gender" name="gender">Gender</label>
                            <br>
                            <select name="gender">
                                <option value='male'>Male</option>
                                <option value='female'>Female</option>
                                <option value='other'>Other</option>
                            </select>
                        </td>
                        <td>
                            <label for="birth" name="birth">Birthday</label>
                            <input type="date" name="birth">
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <label for="email" name="email">Email</label> 
                            <br>
                            <input type="email" name="email" placeholder="Email" spellcheck="false">
                        </td>
                    </tr>
                </table>
                <a id="login-ac-btn"><p>Already have a account?</p></a>
            </div>

            <!-- step 2 -->

            <div id='register-form-2'>
                <h3>Account Setting</h3>
                <label for="userID" name="userID">User ID</label> 
                <input type="text" name="userID" placeholder="User ID" spellcheck="false">
                <label for="userPW" name="userPW">Password</label> 
                <input type="password" name="userPW" placeholder="Password">
                <label for="confirmPW" name="confirmPW">Confirm Password</label> 
                <input type="password" name="confirmPW" placeholder="Confirm Password">
            </div>

            <div class="step-link-container">
                <a class="step-btn" id='prev-btn'>
                    Previous
                </a>
                <a class="step-btn" id='next-btn'>
                    Next
                </a>
            </div>

            </div>

            <input type="submit" value="Login" id="form-action-btn" class="my-form-btn">

        </form>
    </div>
    <img src='./images/cover-04.jpg' alt="cover_image" class="img-section">

</div>

<?php 

    include_once("../includes/footer.html");

?>