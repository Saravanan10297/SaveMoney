
<?php
include_once('dataBaseConfig.php');

// Use $_GET or $_POST for $sFlag depending on how it's sent
$sFlag = isset($_GET['sFlag']) ? $_GET['sFlag'] : '';

if ($sFlag == "addPlan") {

    // Collect POST data safely
    $sSaveAmount = $_POST['sSaveAmount'];
    $iFrequency = $_POST['iFrequency'];
    $sPayingAmount = $_POST['sPayingAmount'];
    $sNotification = $_POST['sNotification'];
    $sPlanName = $_POST['sPlanName'];
    $iNumberOfFrequency = isset($_POST['iNumberOfFrequency']) ? $_POST['iNumberOfFrequency'] : 'NULL';
    $sStartDate = $_POST['sStartDate'];

    // Debug
    echo $sNotification;
    echo $sStartDate;

    //SQL Insert Statement
    $sql = "INSERT INTO moneyplan (
        planname, total_amount, frequency, paying_amount, notification,
        no_of_frequency, startdate, user_id, flag, delete_flag
    ) VALUES (
        '$sPlanName', '$sSaveAmount', '$iFrequency', '$sPayingAmount', '$sNotification',
        $iNumberOfFrequency, '$sStartDate', '1', '1', '1'
    )";


    $result = mysqli_query($con, $sql);
    $count=0;
    $dSDate=$sStartDate;
    if ($result) {
       
         $iSplitAmount = $sSaveAmount / $iNumberOfFrequency;
         $dSDate = $sStartDate;
         $plan_id=  mysqli_insert_id($con);
            for ($iii = 0; $iii < $iNumberOfFrequency; $iii++) {
                $date = new DateTime($dSDate);
                $date->add(new DateInterval("P{$iFrequency}D"));
                $dSaveDate = $date->format('Y-m-d');
                $dSDate = $dSaveDate;
                $count++;

                $sql1 = "INSERT INTO addsaveplan (
                    user_id, plan_id, plan_name, save_amount, save_date, flag, submit_stamp
                ) VALUES (
                    1, $plan_id, '$sPlanName', '$iSplitAmount', '$dSaveDate', 1, NOW()
                )";

                $result1 = mysqli_query($con, $sql1);

                if ($result1) {
                    echo "Entry $count saved: $dSaveDate | ₹$iSplitAmount<br>";
                } else {
                    echo "Insert Error (addsaveplan): " . mysqli_error($con);
                }
            }

        

        echo "Model data inserted successfully.<br>".$dSaveDate."##".$iSplitAmount."&&".$sStartDate;
    } else {
        echo "Error: " . mysqli_error($con);  
     }



}
if (isset($_GET['sFlag']) && $_GET['sFlag'] == "getplan") {
    $iPlanid = $_POST['iUserid'];

    // Validate and sanitize user input
    $iUserid = intval($iPlanid); // Convert to integer to prevent injection

    $sql = "SELECT * FROM addsaveplan WHERE plan_id = '$iPlanid'";
    $result = mysqli_query($con, $sql);

    $plans = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $plans[] = $row;
        }
        echo json_encode($plans);
    } else {
        echo json_encode([]); // return empty array if no data
    }
}
if (isset($_GET['sFlag']) && $_GET['sFlag'] == "getSavePlanDetails") {
    // Safely get POST data
    $iPlanSaveid = isset($_POST['iPlanSaveid']) ? intval($_POST['iPlanSaveid']) : 0;

    if ($iPlanSaveid > 0) {
        // Query to fetch user's active money plans
        $sql = "SELECT * FROM moneyplan WHERE user_id = $iPlanSaveid AND flag = 1";
        $result = mysqli_query($con, $sql);

        $plans = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $plans[] = $row;
            }
            echo json_encode($plans);
        } else {
            echo json_encode([]); // No data found
        }
    } else {
        echo json_encode(["error" => "Invalid user ID."]);
    }
}


if(isset($_GET['sFlag']) && $_GET['sFlag'] == "PayingMoney"){
    $id= $_POST['iId'];
    $userid= $_POST['iUserid'];
    $planid= $_POST['iPlanid'];
    $iAmount = $_POST['iAmount'];
    $sEmail='saravananp10297@gmail.com';
    
    $sql = "Update  addsaveplan set flag =2 where id='$id'";
    $result = mysqli_query($con,$sql);
    echo $planid;

}


?>


