t<?php
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style2.css">
</head>
<style>
    .toggle {
        display: block;
        text-align: center;
    }

    .toggle .tab1,
    .tab2,
    .tab3,
    .tab4,
    .tab5,
    .tab6,
    .tab7 {
        display: inline-block;
        cursor: pointer;
        font-size: 1.1em;
        color: #1a0034;
        font-family: 'Gilroy Bold';
        opacity: 0.4;
    }

    .toggle .tab2,
    .tab3,
    .tab4,
    .tab5,
    .tab6,
    .tab7 {
        margin-left: 5px;
    }
</style>

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
        <div class="budget-dashboard">
            <div class="dash-title">DASHBOARD</div>


            <div class="toggle">
                <!-- Nav baras -->
                <div class="tab1">
                    <a class="nav-link p-0  text-dark" href="Expense.php">Expenses </a>
                </div>
                <div class="tab2">
                    <a class="nav-link  p-0  text-dark" href="Income.php">Income </a>
                </div>
                <div class="tab3  p-0 active">
                    <a href="Home.php" class="nav-link text-dark">
                        Home
                    </a>
                </div>
                <div class="tab4  p-0 ">
                    <a href="DateForm.php" class="nav-link text-dark">
                        Date
                    </a>
                </div>
                <div class="tab5 ">
                    <a href="Receipts.php" class="nav-link text-dark">
                        Receipts
                    </a>
                </div>
                <div class="tab5">
                    <a href="#" class="nav-link text-dark">
                        Receipts
                    </a>
                </div>
                <div class="tab6">
                    <a href="Category.php" class="nav-link text-dark">Category </a>
                </div>
                <div class="tab6">
                    <a href="Analysis.php" class="nav-link text-dark">Analysis </a>
                </div>
                <div class="tab7"> <a href="Prognosis.php" class="nav-link text-dark">Prognosis </a></div>
                <!-- <div class="tab8"><input type="text">Date</div> -->
            </div>
            <!-- Pasirinkus tam tikrą skiltį, kitos paslėpiamos -->

            <div class="table-responsive">
            <table class="table text-center  bg-light mt-2" id="myTable">
                    <thead>
                    <thead>
                        <tr>
                            <th scope="col" class="h3">Expected Income</th>
                            <th scope="col"></th>
                            <th scope="col" class="h3">Expected Expense</th>
                        </tr>
                        <tr>
                            <th scope="col" class="h4 text-success"> <?php echo getExpectedIncome().'€'; ?></th>
                            <th scope="col"></th>
                            <th scope="col" class="h4 text-danger"> <?php echo getExpectedExpense().'€'; ?></th>
                        </tr>
                        <tr>
                            <th scope="col"  >
                                <form method="post">
                                    <input type="submit" class="btn btn-info" value="Expand" name='IncomeExpand'>
                                </form>
                            
                            </th>
                            <th scope="col"></th>
                            <th scope="col">
                            <form method="post">
                                    <input type="submit" class="btn btn-info" value="Expand" name='ExpenseExpand'>
                                </form>
                            </th>
                        </tr>
                        <div id='incomeExpand'>
                        <?php
                           if(isset($_POST['IncomeExpand']))
                           {
                            $id = $_SESSION['id'];
                            $query = "SELECT Sum(`Amount`) as Amount , `Category`  FROM transaction_tb  where UserId = '$id' and TransactionType = 'Income' GROUP BY `Category` ";
                            $result = mysqli_query($con, $query);
                            while ($data = mysqli_fetch_assoc($result)) {
    
                                $Category = $data['Category'];
                                $Amount = $data['Amount'];
                                $Amount =round(($Amount)/getTotalMonths(),2);
                                echo " <tr class='h4 text-success'>";
                                echo "<td colspan='2'> $Category </td>";
                                echo "<td>  €$Amount </td>";
                                echo "</tr>";
                            }
                           }
                        ?>
                         </div>

                         <div id='ExpenseExpand'>
                        <?php
                           if(isset($_POST['ExpenseExpand']))
                           {
                            $id = $_SESSION['id'];
                            $query = "SELECT Sum(`Amount`) as Amount , `Category`  FROM transaction_tb  where UserId = '$id' and TransactionType = 'Expense' GROUP BY `Category` ";
                            $result = mysqli_query($con, $query);
                            while ($data = mysqli_fetch_assoc($result)) {
                                $Category = $data['Category'];
                                $Amount = $data['Amount'];
                                $Amount =round(($Amount)/getTotalMonths(),2);
                                echo " <tr class='h4 text-danger'>";
                                echo "<td colspan='2'> $Category </td>";
                                echo "<td>  €$Amount </td>";
                                echo "</tr>";
                            }
                           }
                        ?>
                         </div>
                        <tr>
                            <th scope="col" colspan="3" class="h3">Expected Saving</th>
                        </tr>
                        <tr>
                            <th scope="col" colspan="3" class="h4 text-success">Total = <?php echo getExpectedIncome()-getExpectedExpense().'€'; ?> </th>
                        </tr>
                        
                    </thead>
                    </thead>
                    </tbody>
                </table>

            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
      $("#key").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

    </script>
</body>

</html>