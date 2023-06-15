<?php

    include "config.php";
    session_start();

    if($_SESSION["vc_id"]){
    
        $channels = $_POST["channel_list"];
        $query = "SELECT `channel_name`,`price` FROM `all_channels` WHERE `channel_id` IN (".implode(',',$channels).")";
        $sql = "SELECT `base_price` FROM `static_details`";
        $result2 = $conn->query($sql);
        $b = $result2->fetch_assoc();
        $base_price = $b["base_price"];
        $total_amount = $base_price;
        $count = 0;
        $result = $conn->query($query);
        $_SESSION["channels"]["name0"] = "Base Pack";
        $_SESSION["channels"]["price0"] = $base_price;
        while($r = $result->fetch_assoc()){
            $_SESSION["channels"]["name".++$count] = $r["channel_name"];
            $_SESSION["channels"]["price".$count] = $r["price"];
            $total_amount += $r["price"];
        }
        $_SESSION["total_amount"] = $total_amount;
        header("location:checkout.php");
    }
    $conn->close();
?>