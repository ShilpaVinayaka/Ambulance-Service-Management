<?php ob_start(); ?>

<?php include('../config/constants.php'); ?>

<?php include('../templates/maintemplate.php'); ?>
<title>Cancel Appointment
</title>

<?php
// 1. Get the ID of Selected Admin
$Appointment_Id = $_GET['Appointment_Id'];

//2. Create SQL Query to get the details
$sql = "SELECT * FROM appointments WHERE Appointment_Id=$Appointment_Id";

//Execute the Query
$res = mysqli_query($conn, $sql);

//Check whethe the data is available or not
if ($res == true) {
    //Check whether the data is available or not
    $count = mysqli_num_rows($res);
    //Check whether we have admin data or not
    if ($count == 1) {
        //Get the details
        $row = mysqli_fetch_assoc($res);

        $Appointment_Id = $row['Appointment_Id'];
        $Ambulance_No = $row['Ambulance_No'];
        $ServiceType = $row['ServiceType'];
        $Date_d = $row['Date_d'];
        $Time_t = $row['Time_t'];
        $PilotContactNo = $row['PilotContactNo'];
        $EmeContactNo = $row['EmeContactNo'];
        $ZwsName = $row['ZwsName'];
        $Status = $row['Status'];
        $Cancel_Status = $row['Cancel_Status'];
        $Cancel_Reason = $row['Cancel_Reason'];
        $Rescheduled = $row['Rescheduled'];
    } else {
        //Redirect to Manage Admin Page
        header('location:' . SITEURL . 'templates/confirm.php');
    }
}

?>


<div class="modal-container" id="modal-container" role="dialog">
    <div class="modal">
        <a href="<?php echo SITEURL; ?>templates/confirm.php">
            <span id="close"><b>&#x2190;</b></span>
        </a>

        <form action="" method="POST">
            <div class="modal-content">
                <h2>Cancel Reason</h2>
                &nbsp;Other Issue:
                <div class="other-row">
                    <div class="other-col-75">
                        <input id="cancel-item" type="text" name="Cancel_Reason" value="<?php $Cancel_Reason; ?>">
                    </div>
                </div>
                <br>
                <div>
                    <input id="cancel-item" type="radio" name="Cancel_Reason" value="Bay Issue" />
                    Bay Issue <br>
                    <input id="cancel-item" type="radio" name="Cancel_Reason" value="Spare Part Issue" />
                    Spare Part Issue<br>
                    <input id="cancel-item" type="radio" name="Cancel_Reason" value="Manpower Issue" />
                    Manpower Issue <br>
                    <input id="cancel-item" type='radio' name="Cancel_Reason" value="Lubes Issue" />
                    Lubes Issue <br>
                </div>
                <br>

                <br>
                <input id="Cancel-button" type="submit" value="Cancel Appointment" name="<?php echo "CancelReason_" . $Appointment_Id ?>">

            </div>
        </form>

    </div>
</div>

<?php

if (isset($_POST['CancelReason_' . $Appointment_Id])) {
    // echo "Cancel Radio Clicked";
    $Cancel_Reason = $_POST['Cancel_Reason'];

    $sql1 = "UPDATE appointments SET
    Cancel_Status = 1, 
    Cancel_Reason = '$Cancel_Reason',
    Status = 0                                
    WHERE Appointment_Id=$Appointment_Id";

    $res1 = mysqli_query($conn, $sql1);
    if ($res1 == true) {
        //Query executed and Appointment updated
        echo "Update Done";
        $sql_1 = "SELECT * FROM eme_notifications";
        $result = mysqli_query($conn, $sql_1);

        $sql_2 = "INSERT INTO eme_notifications SET
        Message = 'Appointment $Appointment_Id cancelled.',
        msg_apt = 0";
        $result = mysqli_query($conn, $sql_2);

        $_SESSION['update'] =
            "<div class='alerts' style='visibility:visible'>
        <div class='success-alert'>Appointment #" . $Appointment_Id . " Cancelled because of " . $Cancel_Reason . "!</div></div>";
        //Redirect to manage appointment page
        header('location:' . SITEURL . 'templates/confirm.php');
    } else {
        //Failed to Update
        echo "Failed";
        $_SESSION['update'] = "<div class='fail-alert'>Cancellation Failed. Try again later.</div>";
        //Redirect to manage appointment page
        header('location:' . SITEURL . 'templates/confirm.php');
    }
    header('location:' . SITEURL . 'templates/confirm.php');
}
?>