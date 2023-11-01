<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

         $to = "SELECT SUM(credit) AS cr , SUM(debit) AS de  FROM amount WHERE id='$id'";
        $result = mysqli_query($conn, $to);
        $firm =  mysqli_fetch_array($result);
        $cr=$firm["cr"];
        $de=$firm["de"];
        $bl=$cr-$de;
        echo $bl;
        
        // $sql42 = "SELECT SUM(credit) AS cr, SUM(debit) AS db FROM fund_wallet WHERE customer_id ='$uid'";
        // $result42 = mysqli_query($conn, $sql42);
        // $firm42 = mysqli_fetch_array($result42);
        // $cr=$firm42["cr"];
        // $db=$firm42["db"];
        // $bl=$cr-$db;
        // echo $bl;



// Output the sum

        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="col-50">
      
            <label for="credit"><i class="fa fa-envelope"></i> Total  Credited Amount </label>
            <input type="text" id="credit" name="credit" value="<?php echo $firm['cedit']?> placeholder="Credit amount">
            <label for="debit"><i class="fa fa-address-card-o"></i>Total Debited Amount</label>
            <input type="text" id="debit" name="debit" value="<?php echo  $firm['debit'] ?>" placeholder="debit amount">
            
          </div>

</body>
</html>