<div class="container">

    <div class="form-section">
        <form action="/project/functions/login-functions.php" method="post" name="myForm" enctype="multipart/form-data" class="my-form">
            <h3 class='logo'>
                <i class="fas fa-gem"></i>
                IMS
            </h3>

            <?php include_once('./login-form.php'); ?>

            <?php include_once('./register-form.php'); ?>

            <input type="submit" name="submitType" value="Login" id="form-action-btn" class="my-form-btn">

        </form>
    </div>
    <img src='./images/cover-04.jpg' alt="cover_image" class="img-section">

</div>