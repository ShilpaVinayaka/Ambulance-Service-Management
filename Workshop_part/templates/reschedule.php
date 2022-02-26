<?php ob_start(); ?>
<?php include('../config/constants.php'); ?>

<?php include('../templates/maintemplate.php'); ?>
<title>Reschedule Appointment</title>
<!-- End of Sidebar -->
<!-- Main Content -->
<div class="wrapper">
    <button class="backBtn"><a href="../templates/confirm.php"><b>&#x2190;</b> Back </a></button><br><br>

    <h2 id="heading">Reschedule Appointment</h2>
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
            // echo "Appointment Available";
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
    <div class="col-lg-12">
        <div class="box-element">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-col-25">
                        <label for="AmbulanceNum"><b> Appointment ID: </b></label>
                    </div>
                    <div class="form-col-75">
                        <input readonly type="number" name="Appointment_Id" placeholder="<?php echo $Appointment_Id; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col-25">
                        <label for="AmbulanceNum"><b> Ambulance Number: </b></label>
                    </div>
                    <div class="form-col-75">
                        <input readonly type="text" name="Ambulance_No" placeholder="<?php echo $Ambulance_No; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col-25">
                        <label for="ServiceType"><b>Service Type:</b></label>
                    </div>
                    <div class="form-col-75">
                        <input readonly type="text" name="ServiceType" placeholder="<?php echo $ServiceType; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col-25">
                        <label for="Changedate"><b> Change of Date: </b></label>
                    </div>
                    <div class="form-col-75">
                        <input type="date" name="Date_d" value="<?php echo $Date_d; ?>"><br><br>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col-25">
                        <label for="timeSlot"><b> Time Slot:</b></label>
                    </div>
                    <div class="form-col-75">
                        <input type="time" name="Time_t" value="<?php echo $Time_t; ?>"><br><br>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col-25">
                        <label for="ServiceType"><b>Pilot Contact Number:</b></label>
                    </div>
                    <div class="form-col-75">
                        <input readonly type="number" name="PilotContactNo" placeholder="<?php echo $PilotContactNo; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col-25">
                        <label for="ServiceType"><b>EME Contact Number:</b></label>
                    </div>
                    <div class="form-col-75">
                        <input readonly type="number" name="EmeContactNo" placeholder="<?php echo $EmeContactNo; ?>">
                    </div>
                </div>

                <div class="form-row-button">
                    <input type="submit" id="Confirmation-button" style='float: right; margin:5px; ' name="confirm" value="Confirm Appointment" 
                    <?php $Rescheduled = 1 ?> <?php $Status =1 ?>>

                    <button id="Cancel-button" style='float: right; margin:5px; '><a href="../templates/confirm.php">Cancel</a></button>
                </div>

            </form>
        </div>

    </div>
</div>

<?php

//Check whether the Submit Button is Clicked or not
if (isset($_POST['confirm'])) {
    echo "Confirmed";
    //Get all the values from form to update
    $Date_d = $_POST['Date_d'];
    $Time_t = $_POST['Time_t'];
    $Status = $_POST['Status'];
    $Rescheduled = $_POST['Rescheduled'];

    //Create SQL Query to Update Admin
    $sql = "UPDATE appointments SET
    Date_d = '$Date_d',
    Time_t = '$Time_t',
    Status = 1,
    Rescheduled = 1
    WHERE Appointment_Id=$Appointment_Id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if ($res == true) {
        //Query executed and Appointment updated
        $sql_1 = "SELECT * FROM eme_notifications";
        $result = mysqli_query($conn, $sql_1);

        $sql_2 = "INSERT INTO eme_notifications SET
        Message = 'Appointment $Appointment_Id Rescheduled to $Date_d $Time_t.',
        msg_apt = 0";
        $result = mysqli_query($conn, $sql_2);

        echo "Update Done";
        $_SESSION['update'] = "<div class='alerts' style='visibility:visible'><div class='success-alert'>Appointment #" . $Appointment_Id . " rescheduled successfully and confirmed!</div></div>";
        //Redirect to manage appointment page
        header('location:' . SITEURL . 'templates/confirm.php');
    } else {
        //Failed to Update
        echo "Failed";
        $_SESSION['update'] = "<div class='alerts' style='visibility:visible'><div class='fail-alert'>Reschedule Failed. Try Again Later!</div></div>";
        //Redirect to manage appointment page
        header('location:' . SITEURL . 'templates/confirm.php');
    }
} 
// else {
//     echo "Submit Access Failed";
// }

?>