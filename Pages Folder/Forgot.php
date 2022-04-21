<div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Forgot Password</span>

                <!-- Forgot FORM -->

                <form method='post'>

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
                        <input type="email" placeholder="Enter your email" name="email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                   
                    <div class="input-field button">
                        <input  type="submit" name="check-email" value="Continue">
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