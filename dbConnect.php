<?php
  $con = new mysqli("localhost", "root", "", "moneysaver");
   $sql = "INSERT INTO moneyplan (
        planname, total_amount, frequency, paying_amount, notification,
        no_of_frequency, startdate, user_id, flag, delete_flag
    ) VALUES (
        '$sPlanName', '$sSaveAmount', '$iFrequency', '$sPayingAmount', '$sNotification',
        $iNumberOfFrequency, '$sStartDate', '1', '1', '1'
    )";


    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result)

















































    

?>