<!doctype html>
<html lang="en">
<?php session_start(); ?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title> Success </title>
    <style>
        body {
            background: #f2f2f2;
        }

        .payment {
            border: 1px solid #f2f2f2;
            height: 280px;
            border-radius: 20px;
            background: #fff;
        }

        .payment_header {
            background: rgba(255, 102, 0, 1);
            padding: 20px;
            border-radius: 20px 20px 0px 0px;

        }

        .check {
            margin: 0px auto;
            width: 150px;
            height: 150px;
            border-radius: 100%;
            background: #fff;
            text-align: center;
            
        }

        .content {
            text-align: center;
        }

        .content h1 {
            font-size: 30px;
            padding-top: 30px;

        }



        .content a:hover {
            text-decoration: none;
            background: #000;
        }
    </style>
    </style </head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto mt-5">
                <div class="payment">
                    <div class="payment_header">
                        <div class="check"> <img class="img-fluid mt-5 " src="./images/logo1.png" alt="">
                        </div>
                    </div>
                    <div class="content">
                        <h1 class="text-success">Payment Success !</h1>
                        <br>
                        <br>
                        <p> Name = <?php echo $_SESSION['name']; ?> </p>
                        <p> Email = <?php echo $_SESSION['email']; ?> </p>
                        <p> Amount = <?php echo $_SESSION['amount']; ?> </p>
                        <p> Transaction ID = <?php echo $_SESSION['txnid']; ?> </p>
                        <p> Easepay Id = <?php echo $_SESSION['easepayid']; ?> </p>
                        <div class="mt-5">
                        <a class="btn btn-warning btn-sm" id="home" href="./index.php">Go to Home</a>
                        <button class="btn btn-success btn-sm ml-3" onclick="print_data()" id="print" >Print</button>
                        </div>
                       
                    </div>

                </div>
            </div>
        </div>
    </div>



</body>

</html>
<script>
    function print_data(){
        document.getElementById('home').style.display='none';
        document.getElementById('print').style.display='none';
        window.print();

    }
</script>