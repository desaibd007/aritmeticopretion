<?php
include 'conn.php';

$query = "SELECT * from amount order by id";
$firms = $conn->query($query);

if (isset($_POST['Submit'])) {
    $fname = $_POST['fname'];
    $credit = $_POST['credit'];
    $debit = $_POST['debit'];
    // $total = $_POST['total'];

    $to = "SELECT SUM(credit) AS cr , SUM(debit) AS de  FROM amount ";
    $result = mysqli_query($conn, $to);
    $fir =  mysqli_fetch_array($result);
    $cr = $fir["cr"];
    $de = $fir["de"];
    $bl = $cr - $de;
    // echo $bl;

    $sqlu = "SELECT * FROM amount WHERE fname='$fname' ";
    $resultu = $conn->query($sqlu);
    if ($resultu->num_rows > 0) {
        // $reerror = true;
        echo "enter a other name";
    } else {
        $sql = "INSERT INTO  `amount` (fname,credit,debit) 
        	VALUES ('$fname','$credit','$debit')";

        if ($conn->query($sql) === TRUE) {
            echo "form is sumbited";
            // $insert = true;
        } else {
            // $pass;
            echo "connection error";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial;
            font-size: 17px;
            padding: 8px;
        }

        * {
            box-sizing: border-box;
        }

        .row {
            display: -ms-flexbox;
            /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap;
            /* IE10 */
            flex-wrap: wrap;
            margin: 0 -16px;
        }

        .col-25 {
            -ms-flex: 25%;
            /* IE10 */
            flex: 25%;
        }

        .col-50 {
            -ms-flex: 50%;
            /* IE10 */
            flex: 50%;
        }

        .col-75 {
            -ms-flex: 75%;
            /* IE10 */
            flex: 75%;
        }

        .col-25,
        .col-50,
        .col-75 {
            padding: 0 20px;
        }

        .container {
            background-color: #f2f2f2;
            padding: 5px 20px 15px 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }

        input[type=text] {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        label {
            margin-bottom: 10px;
            display: block;
        }

        .icon-container {
            margin-bottom: 20px;
            padding: 7px 0;
            font-size: 24px;
        }

        .btn {
            background-color: #04AA6D;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        a {
            color: #2196F3;
        }

        hr {
            border: 1px solid lightgrey;
        }

        span.price {
            float: right;
            color: grey;
        }

        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
        @media (max-width: 800px) {
            .row {
                flex-direction: column-reverse;
            }

            .col-25 {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>

    <h2>Checkout Form</h2>

    <div class="row">
        <div class="col-75">
            <div class="container">
                <form action="" method="post">

                    <div class="row">
                        <div class="col-50">
                            <h3>Billing Address</h3>
                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="fname" name="fname" placeholder="John M. Doe">
                            <label for="credit"><i class="fa fa-envelope"></i> Credit </label>
                            <input type="text" id="credit" name="credit" placeholder="Credit amount">
                            <label for="debit"><i class="fa fa-address-card-o"></i> Debit</label>
                            <input type="text" id="debit" name="debit" placeholder="debit amount">
                            <label for="total"><i class="fa fa-institution"></i> Total Availble Fund  :- Rs.<?php echo $bl; ?></label>
                            <!-- <input type="text" id="total" name="total" value="" placeholder="Total Amount"> -->
                        </div>

                    </div>

                    <input type="submit" name="Submit" class="btn">
                </form>
            </div>
        </div>
        <div class="col-25">
            <div class="container">
                <ul>
                    <?php 
                    while ($firm = $firms->fetch_assoc()) { ?>
                        <p>
                            <li type="none">
                                <h4><span class="price" style="color:black"><b>ID No:-<?php echo $firm['id']; ?></b></h4>
                            </li>
                        </p><br>
                        <p>
                            <li type="none">
                                <span class="price" style="color:black">Name:-<?php echo $firm['fname']; ?> </span></li>
                        </p><br>
                        <p>
                            <li type="none">Date:-
                                <span class="price"><?php echo $firm['date'];  ?></span></li>
                        </p>
                        <p>
                            <li type="none">Credited Amount
                                <span class="price"><?php echo $firm['credit']; ?></span></li>
                        </p>
                        <p>
                            <li type="none">Debbited Amount
                                <span class="price"><?php echo $firm['debit']; ?></span></li>
                        </p>
                        <hr>
                        <?php $tot = $firm['credit'] - $firm['debit'] ?>
                        <p>
                            <li type="none"> Total Amount <i class="fa fa-shopping-cart"></i><span class="price" style="color:black"><b><?php echo $tot; ?></b></span>
                            <li>
                        </p>
                        <hr>
                        <hr>
                        <!-- <p><li type="none"><span class="price"></span></li></p> -->
                    <?php  }
                   ?>
                </ul>

            </div>
        </div>
    </div>

</body>

</html>