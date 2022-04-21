<?php
$email = $_SESSION['email'];
if ($email == false) {
    header('Location: ./index.php');
}
?>
<div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">New Password</span>

                <!-- Forgot FORM -->

                <form method='post'>

                <?php
                        if (isset($_SESSION['info'])) {
                        ?>
                            <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                                <?php echo $_SESSION['info']; ?>
                            </div>
                        <?php
                        }
                        ?>

                <?php
                            if (count($errors) > 0) {
                            ?>
                              <div class="error">
                                  <?php
                                    foreach ($errors as $error) {
                                        echo $error.'</br>';
                                    }
                                    ?>
                              </div>
                          <?php
                            }
                ?>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Create a password" name="password" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Confirm a password" name="cpassword" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                   
                    <div class="input-field button">
                        <input  type="submit" name="change-password" value="Change">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already have an account?
                        <a href="index.php" class="text signup-link">Signin now</a>
                    </span>
                </div>
            </div>

            <!--  FORM END -->

            </div>
        </div>
    </div>