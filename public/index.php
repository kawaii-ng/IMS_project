<?php 

    include_once("../includes/header.html");
    session_start();

?>

<div class="container">

    <div class="form-section">
        <?php 

            $coverImg = "";
        
            if(isset($_GET['register_step'])){

                $_SESSION['firstName'] = "";
                $_SESSION['lastName'] = "";
                $_SESSION['gender'] = "";
                $_SESSION['birthday'] = "";
                $_SESSION['email'] = "";

                $coverImg = "./images/cover-02.jpg";

                echo "
                <form action=\"\" method=\"post\" class=\"my-form\">
                    <h5>
                        <i class=\"fas fa-gem\"></i>
                        <span>I</span>nventory <span>M</span>anagement <span>S</span>ystem
                    </h5>
                    
                    <h1>Register</h1>";

                    switch($_GET['register_step']){

                        case 1:
                            echo "
                            <h3>Personal Information</h3>
                            <table width='100%' border='0' cellspacing='10px'>
                                <tr width='100%'>
                                    <td>
                                        <label for=\"firstName\" name=\"firstName\">First Name</label> 
                                        <br>
                                        <input type=\"text\" name=\"firstName\" id=\"first-name\" placeholder=\"First Name\" spellcheck=\"false\">
                                    </td>
                                    <td>
                                        <label for=\"lastName\" name=\"firstName\">Last Name</label> 
                                        <br>
                                        <input type=\"text\" name=\"lastName\" id=\"last-name\" placeholder=\"Last Name\" spellcheck=\"false\">
                                    </td>                                
                                </tr>
                                <tr>
                                    <td>
                                        <label for=\"gender\" name=\"gender\">Gender</label>
                                        <br>
                                        <select name=\"gender\">
                                            <option value='male'>Male</option>
                                            <option value='female'>Female</option>
                                            <option value='other'>Other</option>
                                        </select>
                                    </td>
                                    <td>
                                        <label for=\"birth\" name=\"birth\">Birthday</label>
                                        <input type=\"date\" name=\"birth\">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <label for=\"email\" name=\"email\">Email</label> 
                                        <br>
                                        <input type=\"email\" name=\"email\" placeholder=\"Email\" spellcheck=\"false\">
                                    </td>
                                </tr>
                            </table>
                            <a href=\"index.php\"><p>Already have a account?</p></a>";
                            break;
                     
                        case 2:
                            echo "
                            <h3>Acount Setting</h3>
                            <label for=\"userID\" name=\"userID\">User ID</label> 
                            <input type=\"text\" name=\"userID\" placeholder=\"User ID\" spellcheck=\"false\">
                            <label for=\"userPW\" name=\"userPW\">Password</label> 
                            <input type=\"password\" name=\"userPW\" placeholder=\"Password\">
                            <label for=\"confirmPW\" name=\"confirmPW\">Confirm Password</label> 
                            <input type=\"password\" name=\"confirmPW\" placeholder=\"Confirm Password\">";
                            break;

                        case 3: 
                            $imgPath = './images/icons8-user-60.png';
                            echo "<h3>Upload Profile Image</h3>
                            <div class='center-anything'>
                            <img src='$imgPath' class='profile-img'>
                            <a>Upload</a>
                            </div>
                            ";

                        default:
                            break;

                    }
                    
                    echo "<div class=\"step-link-container\">";
                    if($_GET['register_step'] != 1){

                        echo "<a id=\"prev-step-link\" href=\"/project/functions/register-functions.php?op=prev_step\"><i class=\"fas fa-arrow-left\"></i> Previous Step </a>";

                    }
                    if($_GET['register_step'] != 3){

                        echo "<a id=\"next-step-link\">Next Step <i class=\"fas fa-arrow-right\"></i></a>";

                    }
                    
                    echo "</div>";
                    if($_GET['register_step'] == 3)
                        echo "<input type=\"submit\" value=\"Register\" class=\"my-form-btn\">";
                echo "</form>";

            }else {

                $coverImg = "./images/cover-04.jpg";

                echo "
                <form action=\"\" method=\"post\" class=\"my-form\">
                    <h5>
                        <i class=\"fas fa-gem\"></i>
                        <span>I</span>nventory <span>M</span>anagement <span>S</span>ystem
                    </h5>
                    
                    <h1>Login</h1>
                    <label for=\"userID\" name=\"userID\">User ID</label> 
                    <input type=\"text\" name=\"userID\" placeholder=\"User ID\" spellcheck=\"false\">
                    <label for=\"userPW\" name=\"userPW\">Password</label> 
                    <input type=\"password\" name=\"userPW\" placeholder=\"Password\">
                    <a href=\"\"><p>Forgot password?</p></a>
                    <a href=\"index.php?register_step=1\"><p>Do not have a account?</p></a>
                    
                    <input type=\"submit\" value=\"Login\" class=\"my-form-btn\">
                </form>
                ";

            }

        ?>
    </div>
    
    <?php 

        echo "<img src='$coverImg' alt=\"cover_image\" class=\"img-section\">";
    
    ?>

</div>

<?php 

    include_once("../includes/footer.html");

?>