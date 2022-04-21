
<div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <!-- LOGIN FORM -->

                <form  method="post">

                                  <!-- DISPLAY ERRORS HERE -->
                                  <div class="error">
                                  <?php 


   if(isset( $errors['error'])){
       echo  $errors['error'].'</br>';
   }
 
?>
   </div>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" name="UserEmail" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Enter your password" name="UserPassword" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        
                        <a href="index.php?PageName=Forgot" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name='Login' value="Login Now">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="index.php?PageName=Register" class="text signup-link">Signup now</a>
                    </span>
                </div>
            </div>

            <!-- LOGIN FORM END -->

            </div>
        </div>
    </div>