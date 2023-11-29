<?php
include "credentials.php";
include "config.php";
session_start();
if($_SESSION["vc_id"] && $_SESSION["page"] == 'Payment Gateway'){

    $orderId = $_GET["order-id"];
    $details = $_GET["details"];
    if (!$orderId) {
        header("location:login.php");
    }
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => $api_url."/".$orderId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'x-client-id: '.$client_id,
            'x-client-secret: '.$secret_key,
            'x-api-version: 2021-05-21'
        ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    echo '
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    
    ';
    if(!$err) {
        $result = json_decode($response, true);
        $amount =  $result["order_amount"];
        $vc_id = $result["customer_details"]["customer_id"];
        $name = $result["customer_details"]["customer_name"];
        $t_id = $result["cf_order_id"];
        if($result["order_status"] == 'PAID'){
            $sql = "INSERT INTO `recharge_details`(`customer_name`, `vc_id`, `pack_details`, `transaction_id`, `amount`, `status`) VALUES ('$name', $vc_id, '$details', '$t_id', $amount, 'pending')";
            if ($conn->query($sql) === TRUE) {
                echo '
                <title>Payment Success!</title>
                </head>
                
                <body>
                <div class="vh-100 d-flex justify-content-center align-items-center">
                <div class="m-auto">
                <div class="mb-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
                </div>
                <div class="text-center">
                <h1 class="text-success">Thank You !</h1>
                <p>Your Recharge request was successful!!</p>
                <a class="btn btn-dark" href="login.php">Back Home</a>
                </div>
                </div>';
                header("refresh:4;url=login.php");
            } else {
              echo "<h3>Payment successful but problem at server, Please contact your operator</h3>";
            }
        } else{
            echo '
            <title>Payment Error!</title>
            </head>
            
            <body>
            <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="m-auto">
            <div class="text-center">
            <h1 class="text-danger">There was some problem with the payment</h1>
            <p>Please contact the operator if amount has been debited from your account and provide this <b>Order Number '.$orderId.'</b></p>
            <a class="btn btn-dark" href="login.php">Back Home</a>
            </div>
            </div>
            ';
        }
    } else {
        echo  $err;
    }
    echo '
    </body>
    
    </html>';
}else{
    header('location:login.php');
}
$conn->close();
    ?>