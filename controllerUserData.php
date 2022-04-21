<?php
//This Pages controls all management

use function PHPSTORM_META\type;

session_start();
require "connection.php";
$errors = array();
$success = array();



if(isset($_POST['Signup'])){
    $UserName = mysqli_real_escape_string($con, $_POST['UserName']);
    $UserEmail = mysqli_real_escape_string($con, $_POST['UserEmail']);
    $UserPassword = mysqli_real_escape_string($con, $_POST['UserPassword']);
    $ConfirmUserPassword = mysqli_real_escape_string($con, $_POST['ConfirmUserPassword']);

    $UserNameQuery = "SELECT * FROM users_tb  WHERE UserName = '$UserName'";
    $ResultUserName = mysqli_query($con, $UserNameQuery);
    $UserEmailQuery = "SELECT * FROM users_tb  WHERE UserEmail = '$UserEmail'";
    $ResultUserEmail = mysqli_query($con, $UserEmailQuery);

 
     if (mysqli_num_rows($ResultUserEmail) > 0) {
        $errors['Email'] = "Email  that you have entered is already used.";
        if ($UserPassword !== $ConfirmUserPassword)
            $errors['UserPassword'] = "Password does't matched.";
    } else if ($UserPassword !== $ConfirmUserPassword) {
        $errors['UserPassword'] = "Password does't matched.";
    }
    else{
        
        $UserPassword = password_hash($UserPassword, PASSWORD_BCRYPT);
        $InsertQuery = " INSERT INTO `users_tb` (`UserId`, `UserName`, `UserEmail`, `UserPassword`, `UserCode`, `UserStatus`) 
        VALUES (NULL, '$UserName', '$UserEmail', '$UserPassword', '0', 'verified')";
        $CheckQuery = mysqli_query($con, $InsertQuery);
        if ($CheckQuery) {
            
            $success['success'] = "Your account is successfuly created. <br> Now you can login..!";
        }
        else{
          
            $errors['error'] = "Failed To Insert data in database..!";
        }
    }
}
if(isset($_POST['Login'])){
    $email = mysqli_real_escape_string($con, $_POST['UserEmail']);
    $password = mysqli_real_escape_string($con, $_POST['UserPassword']);
    $check_email = "SELECT * FROM users_tb WHERE UserEmail = '$email'";
    $res = mysqli_query($con, $check_email);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['UserPassword'];
        $status = $fetch['UserStatus'];
        $code = $fetch['UserCode'];
        if (password_verify($password, $fetch_pass)) 
        {
        if ($status == 'verified' && $code==0) 
        {
            $_SESSION['id'] = $fetch['UserId'];
            $_SESSION['name'] = $fetch['UserName'];
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header("location: Home.php");
        }
        else
        {
           
            $errors['error'] = "It's look like you haven't still verify your email  $email";
        }
    }
    else
    {
        
        $errors['error'] = "Incorrect email or password!";
    }
    }
    else{
       
        $errors['error'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
       
    }
}

//if user click continue button in forgot password form
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM users_tb WHERE UserEmail='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE users_tb SET UserCode = $code WHERE UserEmail = '$email'";
        $run_query =  mysqli_query($con, $insert_code);

        if ($run_query) {
            $_SESSION['email'] = $email;
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $sender = "f180207@nu.edu.pk";
            if (mail($email, $subject, $message, $sender)) {
                $info = "We've sent a passwrod reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: index.php?PageName=ResetCode');
               // exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

//if user click check reset otp button
if (isset($_POST['check-reset-otp'])) {

    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM users_tb WHERE UserCode = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['UserEmail'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: index.php?PageName=NewPassword');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}
//if user click change password button
if (isset($_POST['change-password'])) {
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    } else {
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $password = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE users_tb SET UserCode = $code, UserPassword = '$password' WHERE UserEmail = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if ($run_query) {
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: index.php?PageName=NewPassword');
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}
function getExpense(){

    $id=$_SESSION['id'];
    $query = "SELECT sum(Amount) as expense FROM `transaction_tb` WHERE `UserId` = $id  and `TransactionType` = 'Expense' ";
    $result = mysqli_query($GLOBALS['con'], $query);
    $expense =0;
    if ($data = mysqli_fetch_assoc($result))
    {
        $expense =$data['expense'];            
    }
    return $expense;
}
function getIncome(){

    $id=$_SESSION['id'];
    $query = "SELECT sum(Amount) as Income FROM `transaction_tb` WHERE `UserId` = $id  and `TransactionType` = 'Income' ";
    $result = mysqli_query($GLOBALS['con'], $query);
    $income =0;
    if ($data = mysqli_fetch_assoc($result))
    {
        $Income =$data['Income'];            
    }
    return $Income;
}
function getExpense2($date1 , $date2){

    $id=$_SESSION['id'];
    $query = "SELECT sum(Amount) as expense FROM `transaction_tb` WHERE `UserId` = $id  and `TransactionType` = 'Expense'   and TransactionDate between '$date1' and '$date2' ";
    $result = mysqli_query($GLOBALS['con'], $query);
    $expense =0;
    if ($data = mysqli_fetch_assoc($result))
    {
        $expense =$data['expense'];            
    }
    return $expense;
}
function getBalance(){
    return getIncome()-getExpense();
}

if(isset($_POST['SubmitIncomeForm'])){
    $id=$_SESSION['id'];
    $Title = mysqli_real_escape_string($con, $_POST['title']);
    $Category = mysqli_real_escape_string($con, $_POST['category']);
    $Amount = mysqli_real_escape_string($con, $_POST['amount']);
    $Date = mysqli_real_escape_string($con, $_POST['date']);
    $Rtransaction = isset($_POST['rtransaction']) && $_POST['rtransaction']  ? "True" : "False";
    $insert_query = "INSERT INTO `transaction_tb` (`Id`, `Title`, `Category`, `Amount`, `TransactionType`, `TransactionDate`, `RTransaction`,  `UserId`)
     VALUES (NULL, '$Title', '$Category', '$Amount', 'Income', '$Date', '$Rtransaction',  '$id')";
    $run_query =  mysqli_query($con, $insert_query);
    if ($run_query) {
       $success['success'] = "Tansaction is Added successfuly..!";
    }
    else
    $errors['error'] = "Failed To Insert data in database..!";

}
if(isset($_POST['SubmitExpenseForm'])){
    $id=$_SESSION['id'];
    $Title = mysqli_real_escape_string($con, $_POST['title']);
    $Category = mysqli_real_escape_string($con, $_POST['category']);
    $Amount = mysqli_real_escape_string($con, $_POST['amount']);
    $Date = mysqli_real_escape_string($con, $_POST['date']);
    $filename=$_FILES['file']['name'];
    $filetype=$_FILES['file']['type'];
  
    if($filetype=='image/jpeg' or $filetype=='image/png' or $filetype=='image/gif' or $filename=='' )
    {
    move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$filename);
    $filepath="`upload`/".$filename;
    $insert_query = "INSERT INTO `transaction_tb` (`Id`, `Title`, `Category`, `Amount`, `TransactionType`, `TransactionDate`, `RTransaction`,`ImageUrl` , `UserId`)
     VALUES (NULL, '$Title', '$Category', '$Amount', 'Expense', '$Date', 'False',  '$filename','$id')";
    $run_query =  mysqli_query($con, $insert_query);
    if ($run_query) {
       $success['success'] = "Expense Tansaction is Added successfuly..!";
    }
    else
    $errors['error'] = "Failed To Insert Transaction in database..!";
    }
    else
    $errors['error'] = "File format is not valid..!";
}
if(isset($_POST['SubmitCategoryForm'])){
    $Category = mysqli_real_escape_string($con, $_POST['category']);
    $CategoryType = mysqli_real_escape_string($con, $_POST['categoryType']);
    $insert_query = "INSERT INTO `category_tb` (`Id`, `Category`,`CategoryType`) VALUES (NULL, '$Category','$CategoryType')";
    $run_query =  mysqli_query($con, $insert_query);
    if ($run_query) {
       $success['success'] = "Category is Added successfuly..!";
    }
    else
    $errors['error'] =" Failed To Insert data in database..!";
}

if(isset($_GET['DelId'])){
    $id = $_GET['DelId'];
    if(mysqli_query($con, "DELETE FROM `transaction_tb` WHERE Id ='$id'")){
        $success['success'] = "Transaction  is deleted successfuly..!";
    } else
    $errors['error'] =" Failed To delete this in transaction..!";
}
if(isset($_GET['DelIdCategory'])){
    $id = $_GET['DelIdCategory'];
    if(mysqli_query($con, "DELETE FROM `category_tb` WHERE Id ='$id'")){
        $success['success'] = "Category  is deleted successfuly..!";
    } else
    $errors['error'] =" Failed To delete this Category..!";
}
if(isset($_POST['SubmitTEditForm'])){
    $Tid=$_SESSION['Tid'];
    $Title = mysqli_real_escape_string($con, $_POST['title']);
    $Amount = mysqli_real_escape_string($con, $_POST['amount']);
    $Date = mysqli_real_escape_string($con, $_POST['date']);
    $query = "UPDATE `transaction_tb` SET `Title`='$Title',`Amount`='$Amount',`TransactionDate`='$Date' WHERE Id = '$Tid'";
    $run_query =  mysqli_query($con, $query);
    if ($run_query) {
       $success['success'] = "Tansaction is updated successfuly..!";
    }
  else
      $errors['error'] = "Failed To update  Transaction in database..!";

}
function getTotalMonths(){

    $id=$_SESSION['id'];
    $query = "SELECT MIN(`TransactionDate`) as minDate, MAX(`TransactionDate`) as maxDate FROM transaction_tb WHERE `UserId` = $id ";
    $result = mysqli_query($GLOBALS['con'], $query);
    $MinDate =null;
    $MaxDate =null;
    $months =1;
    if ($data = mysqli_fetch_assoc($result))
    {
        $MinDate =$data['minDate'];            
        $MaxDate =$data['maxDate'];   
       // echo $MinDate.'</br>'.$MaxDate.'</br>';
        $query = "SELECT YEAR('$MaxDate')*12 + MONTH('$MaxDate') - (YEAR('$MinDate')*12 + MONTH('$MinDate')) as months";
        $result = mysqli_query($GLOBALS['con'], $query);
        if($data = mysqli_fetch_assoc($result))
        $months =$data['months'];   
    }
    return $months+1;
}
function getExpectedIncome(){

    $id=$_SESSION['id'];
    $query = "SELECT sum(Amount) as Income FROM `transaction_tb` WHERE `UserId` = $id  and `TransactionType` = 'Income' ";
    $result = mysqli_query($GLOBALS['con'], $query);
    $income =0;
    if ($data = mysqli_fetch_assoc($result))
    {
        $Income =$data['Income'];        
        $Income = $Income/getTotalMonths();
    }
    return round($Income,2);
}
function getExpectedExpense(){

    $id=$_SESSION['id'];
    $query = "SELECT sum(Amount) as Expense FROM `transaction_tb` WHERE `UserId` = $id  and `TransactionType` = 'Expense' ";
    $result = mysqli_query($GLOBALS['con'], $query);
    $Expense =0;
    if ($data = mysqli_fetch_assoc($result))
    {
        $Expense =$data['Expense'];        
        $Expense = $Expense/getTotalMonths();
    }
    return round($Expense,2);
}