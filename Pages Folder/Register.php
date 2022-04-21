
<style>
body{
    height: 105vh;
    /* width: 360px;
    height: 780px; */
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgb(19, 19, 19);
}

.container{
    position: relative;
    max-width: 430px;
    width: 100%;
    /* width: 360px;
    height: 780px; */
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin: 0 20px;
}

.container .forms{
    display: flex;
    align-items: center;
    height: 650px;
    width: 200%;
    /* transition: height 0.2s ease; */
}

</style>
<body>
    
    <div class="container">
        <div class="forms">

            <!-- REGISTRATION FORM -->

            <div class="form signup">
                <span class="title">Registration</span>

                <form  method="post">

                    <!-- DISPLAY ERRORS HERE -->
                    <?php 

                         if(isset($success['success'])){
                             echo $success['success'];
                         }
                         else{
                             ?>
                              <div class="error">

                             
                             <?php
                            if(isset( $errors['error'])){
                                echo  $errors['error'].'</br>';
                            }
                            if(isset($errors['Email'])){
                                echo $errors['Email'].'</br>';
                            }
                            if(isset($errors['UserPassword'])){
                                echo $errors['UserPassword'].'</br>';
                            }
                           ?>
                            </div>
                           <?php
                         }
                            
                     ?>

                    <div class="input-field">
                        <input type="text" placeholder="Enter your name" name="UserName" required>
                        <i class="uil uil-user"></i>
                      
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" name="UserEmail" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Create a password" name="UserPassword" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Confirm a password" name="ConfirmUserPassword" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Register Now" name="Signup">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already have an account?
                        <a href="index.php" class="text login-link">Signin now</a>
                    </span>
                </div>

                <!-- REGISTRATION FORM END -->

            </div>
        </div>
    </div>



</body>
