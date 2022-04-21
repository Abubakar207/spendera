<?php
require('controllerUserData.php');

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false) {
    $sql = "SELECT * FROM users_tb WHERE UserEmail = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
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
    <title> Transaction Page </title>
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


        <div class="new-transaction-dashboard ">

            <div class="dash-title">By Date</div>

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
                        <input type="date" id="income-date-input" name="date1" min="2022-01-01" required><br>
                        <input type="date" id="income-date-input" name="date2" min="2022-01-01" required><br>
                    </div>
                </div>
                <div class="income-button-select">

                    <div class="add-income">
                        <input type="submit"class="btn  btn-dark" value="Filter" id="add" name='SubmitDateFilterForm'>
                    </div>
                </div>
            </form>

            
            <div class="table-responsive">
                <table class="table text-center bg-light mt-2">
                    <thead>
                        <!-- <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr> -->
                    </thead>
                    <tbody>
                        <?php
                        $id = $_SESSION['id'];
                        if(isset($_POST['SubmitDateFilterForm'])){
                            $date1 = mysqli_real_escape_string($con, $_POST['date1']);
                            $date2 = mysqli_real_escape_string($con, $_POST['date2']);
                            $query = "select * from transaction_tb where UserId = $id 
                            and TransactionDate between '$date1' and '$date2' ";
                        }
                        else
                         $query = "select * from transaction_tb where UserId = $id  ";
                        $result = mysqli_query($con, $query);
                        while ($data = mysqli_fetch_assoc($result)) {
                            $id = $data['Id'];
                            $Title = $data['Title'];
                            $Category = $data['Category'];
                            $Amount = $data['Amount'];
                            $TransactionDate = $data['TransactionDate'];
                           if($data['TransactionType']=='Income'){
                            echo " <tr class='h5 text-success'>";
                            echo "<td> $Title </td>";
                            echo "<td> $Category </td>";
                            echo "<td>  €$Amount </td>";
                            echo "<td>  $TransactionDate </td>";
                           }
                           else
                           {
                            echo " <tr class='h5 text-danger'>";
                            echo "<td> $Title </td>";
                            echo "<td> $Category </td>";
                            echo "<td>  €$Amount </td>";
                            echo "<td>  $TransactionDate </td>";
                           }
                            
                        ?>
                            <!-- <td><a href="DateForm.php?DelId=<?php //echo $id ?>" style="color:black;"><i class="fa-solid fa-trash-can"> </i> </a> </td> -->
                        <?php
                            echo "</tr>";
                        }
                        ?>
                          <tr>
                            <td colspan="4"> <a href="Home.php" class="btn btn-dark  btn-lg">Back To Home</a></td>
                        </tr>

                    </tbody>
                </table>

            </div>

        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="chart.js"></script>
    <script src="budget.js"></script>
</body>

</html>