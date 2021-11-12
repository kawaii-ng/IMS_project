<div id="login-form">
    <!-- login -->
    <h1>Login</h1>
    <label for="userID">User ID</label> 
    <input type="text" name="userID" id='login-id' placeholder="User ID" spellcheck="false">
    <label for="userPW">Password</label> 
    <input type="password" name="userPW" id='login-pw' placeholder="Password">
    <a id='forgot-pw-btn'><p>Forgot password?</p></a>
    <a id="create-ac-btn"><p>Do not have a account?</p></a>
    <?php 
        if(isset($_GET['error']) && $_GET['error'] == "login_fail")
            echo "<p class=\"error\"><i class='fas fa-exclamation-circle'></i> Login Failed. </p>";
    ?>
</div>