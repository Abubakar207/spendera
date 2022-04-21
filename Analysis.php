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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">
    <title> Transaction Page </title>
    <style>
        .error {
            color: red;
        }
    </style>
    <html>

    <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Bill Expense'],
                    <?php
                    $id = $_SESSION['id'];
                    if (isset($_POST['SubmitDateFilterFormAnalysis'])) {
                        $date1 = mysqli_real_escape_string($con, $_POST['date1']);
                        $date2 = mysqli_real_escape_string($con, $_POST['date2']);
                        $query = "SELECT Sum(`Amount`) as Amount , `Category`  FROM transaction_tb  where
                                                 UserId = '$id' and TransactionType = 'Expense' and TransactionDate between '$date1' and '$date2'  GROUP BY `Category` ";
                    } else
                        $query = "SELECT Sum(`Amount`) as Amount , `Category`  FROM transaction_tb  where UserId = '$id' and TransactionType = 'Expense' GROUP BY `Category` ";
                    $result = mysqli_query($con, $query);
                    while ($data = mysqli_fetch_assoc($result)) {

                        $Category = $data['Category'];
                        $Amount = $data['Amount'];
                        echo "['" . $Category . "'," . $Amount . "],";
                    }
                    ?>
                ]);
                var options = {
                    'backgroundColor': 'transparent',
                    'is3D': true,
                    titleTextStyle: {
                        color: 'white'
                    },
                    pieHole: 0.6,
                    legend: {
                        textStyle: {
                            color: 'yellow',
                        }
                    },

                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        </script>
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
                    Bill
                </div>
                <div style=" color: #FFF;font-size: 2em;margin-top: 10px;font-family: 'Gilroy Bold';">
                    <small>€</small>
                    <?php
                     if (isset($_POST['SubmitDateFilterFormAnalysis'])) 
                     {
                        $date1 = mysqli_real_escape_string($con, $_POST['date1']);
                        $date2 = mysqli_real_escape_string($con, $_POST['date2']);
                        echo getExpense2($date1, $date2); 
                     }
                     else
                     echo getExpense(); 
                    ?>
                </div>
            </div>
            <!-- INCOME -->
       

                <!-- CHART -->
                <div class="chart " id="piechart" style="width: 360px; height: 180px;">

                </div>
                <!-- OUTCOME -->

         
        </div>

        <!-- SĄRAŠAS -->


        <div class="new-transaction-dashboard">
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
                        <input type="submit" class="btn  btn-dark" value="Filter" id="add" name='SubmitDateFilterFormAnalysis'>
                    </div>
                </div>
            </form>
            <div class="dash-title">Overview</div>
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
                        if (isset($_POST['SubmitDateFilterFormAnalysis'])) {
                            $date1 = mysqli_real_escape_string($con, $_POST['date1']);
                            $date2 = mysqli_real_escape_string($con, $_POST['date2']);
                            $query = "SELECT Sum(`Amount`) as Amount , `Category`  FROM transaction_tb  where
                                                     UserId = '$id' and TransactionType = 'Expense' and TransactionDate between '$date1' and '$date2'  GROUP BY `Category` ";
                        } else
                            $query = "SELECT Sum(`Amount`) as Amount , `Category`  FROM transaction_tb  where UserId = '$id' and TransactionType = 'Expense' GROUP BY `Category` ";
                        $result = mysqli_query($con, $query);
                        while ($data = mysqli_fetch_assoc($result)) {
                            $Category = $data['Category'];
                            $Amount = $data['Amount'];
                            echo " <tr class='h4'>";
                            echo "<td> $Category </td>";
                            echo "<td>  €$Amount </td>";
                            echo "</tr>";
                        }
                        ?>
                        <tr>
                            <td colspan="2"><a href="Home.php" class="btn btn-dark btn-lg">Back To Home</a></td>
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