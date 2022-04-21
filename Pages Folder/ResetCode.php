<div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Code Verification</span>

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
                        <input type="text" name="otp" placeholder="Enter code" onkeypress="return /[0-9]/i.test(event.key)" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                   
                    <div class="input-field button">
                        <input type="submit" name="check-reset-otp" value="Submit">
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