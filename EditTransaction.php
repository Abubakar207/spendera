<?php
require('controllerUserData.php');

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false && isset($_GET['EditId'])) {
    $id = $_GET['EditId'];
    $_SESSION['Tid'] =$id;
    $sql = "SELECT * FROM transaction_tb WHERE Id = '$id'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $data = mysqli_fetch_assoc($run_Sql);
    }
} else {
    echo "<script>   window.history.back(); </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">
    <title> Edit Transaction Page </title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

      <!-- BUDGET HEADER IKI DASHBOARD -->
      <div class="budget-container mt-5">
        <div class="container">
            <div class="row">
            <div class="col">
            <div class=" h4 text-light  mt-4 pt-2"> <a href="Home.php" class="nav-link" style="color: #03989e;"> <?php echo $_SESSION['name']; ?></a></div>
            </div>
            <div class="col"></div>
            <div class="col">
            <div class=" h4 text-light  mt-4 pt-2"> <a href="Logout.php" style="color: #03989e;" class="nav-link">Logout</a></div>
            </div>
            </div>
        </div>
   
        <div class="app-title" style=" font-family: 'Gilroy Bold';background:#131414;">
           <img src="logo.png" width="100%" height="10%" alt="">
        </div>
        <!-- Analizė -->
        <div class="budget-header">
            <div class="balance">
                <div class="title">
                    Balance
                </div>
                <div style=" color: #FFF;font-size: 2em;margin-top: 10px;font-family: 'Gilroy Bold';">
                    <small>€</small>
                    <?php echo getBalance();  ?>
                </div>
            </div>
            <!-- INCOME -->
            <div class="account">
                <div class="income">
                    <div class="title h5">
                        Income
                    </div>
                    <div style=" color: rgb(28, 192, 77); font-family: 'Gilroy Bold';">
                        <small>€</small>
                        <?php echo getIncome();  ?>
                    </div>
                </div>
                <!-- CHART -->
                <div class="chart"></div>
                <!-- OUTCOME -->
                <div class="outcome">
                    <!-- Total -->
                    <div class="title h5">
                        Expenses
                    </div>
                    <div style=" color: #f0624d; font-family: 'Gilroy Bold';">
                        <small>€</small>
                        <?php echo getExpense();  ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- SĄRAŠAS -->


        <div class="new-transaction-dashboard">

            <div class="dash-title">Edit Transaction</div>

            <form method="post">
                <div id="income">
                    <!-- DISPLAY ERRORS HERE -->
                    <?php

                    if (isset($success['success'])) {
                        echo $success['success'];
                    } else {
                    ?>
                        <div class="error">


                            <?php
                            if (isset($errors['error'])) {
                                echo  $errors['error'] . '</br>';
                            }
                            ?>
                        </div>
                    <?php
                    }

                    ?>

                    <div class="input">
                        <input type="text" id="income-title-input" name="title" value="<?php echo $data['Title']; ?>" placeholder="Title" required>
                        <input type="text"  id="income-date-input"  value="<?php echo $data['Amount']; ?>" name="amount" required placeholder="€0"><br>
                        <input type="text" id="income-date-input"  value="<?php echo 'Previous '.$data['TransactionDate']; ?>" disabled><br>
                        <input type="date" name="date" id="income-date-input"   required><br>
            
                    </div>
                </div>
                <div class="income-button-select">

                    <div class="add-income">
                        <input type="submit" class="btn btn-dark " value="Save Changes" id="add" name='SubmitTEditForm'>
                    </div>
                </div>
            </form>



            <div class="income-button-select">

                <div class="back-to-main">
                    <a href="Home.php">
                        <button id="back" class="btn btn-dark ">Back To Home</button>
                    </a>
                </div>
                
            </div>
        </div>


    </div>

    <script src="chart.js"></script>
    <script src="budget.js"></script>
</body>

</html>