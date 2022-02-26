<?php ob_start(); ?>

<?php include('../config/constants.php'); ?>

<?php include('../templates/maintemplate.php'); ?>

<head>
    <title>Cancelled Appointments</title>
</head>
<?php
if (isset($_SESSION['add'])) {
    echo $_SESSION['add']; //Displaying Session Message
    unset($_SESSION['add']); //Removing Session Message
}
if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete']; //Displaying Session Message
    unset($_SESSION['delete']); //Removing Session Message
}
if (isset($_SESSION['update'])) {
    echo $_SESSION['update']; //Displaying Session Message
    unset($_SESSION['update']); //Removing Session Message
}
if (isset($_SESSION['modal'])) {
    echo $_SESSION['modal']; //Displaying Session Message
    unset($_SESSION['modal']); //Removing Session Message
}
?>
<div class="alerts" style="visibility: hidden; display:none;"></div>

<div class="wrapper">
    <h2 id="heading">Cancelled Appointments</h2>

    <div class="col-lg-12">
        <form method="POST">
            <div class="box-element">
                <table>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Ambulance_No</th>
                        <th>ServiceType</th>
                        <th>Pilot Contact</th>
                        <th>Eme Contact</th>
                        <th>Cancel Reason</th>
                        <th>Modify</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM appointments";
                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res); //Function to get all the rows in database

                        if ($count > 0) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                                $Status = $rows['Status'];
                                $Cancel_Status = $rows['Cancel_Status'];

                                if ($Status == 0 && $Cancel_Status == 1) {        // Status 0 for cancelled appointments
                                    $Appointment_Id = $rows['Appointment_Id'];
                                    $Ambulance_No = $rows['Ambulance_No'];
                                    $ServiceType = $rows['ServiceType'];
                                    $Date_d = $rows['Date_d'];
                                    $Time_t = $rows['Time_t'];
                                    $PilotContactNo = $rows['PilotContactNo'];
                                    $EmeContactNo = $rows['EmeContactNo'];
                                    $ZwsName = $rows['ZwsName'];
                                    $Status = $rows['Status'];
                                    $Cancel_Status = $rows['Cancel_Status'];
                                    $Cancel_Reason = $rows['Cancel_Reason'];
                    ?>
                                    <tr>
                                        <td><?php echo $Appointment_Id ?></td>
                                        <td><?php echo $Ambulance_No ?></td>
                                        <td><?php echo $ServiceType ?></td>
                                        <td><?php echo $PilotContactNo ?></td>
                                        <td><?php echo $EmeContactNo ?></td>
                                        <td><?php echo $Cancel_Reason ?></td>
                                        <td><button id="Info-button" name="<?php echo "confirm_again_" . $Appointment_Id ?>" style="display:inherit">Confirm</button></td>
                                    </tr>

                                <?php


                                } else {
                                    continue;
                                }
                                ?>
                            <?php
                                if (isset($_POST["confirm_again_" . $Appointment_Id])) {
                                    echo "Confirm Again Button CLicked";

                                    //Create SQL Query to Update Admin
                                    $sql_ = "UPDATE appointments SET
                                        Status = 1,
                                        Cancel_Reason = NULL,
                                        Cancel_Status = 0
                                        WHERE Appointment_Id=$Appointment_Id";

                                    //Execute the Query
                                    $result = mysqli_query($conn, $sql_);

                                    if ($result == true) {
                                        echo "Update Done";
                                        $sql_1 = "SELECT * FROM eme_notifications";
                                        $result = mysqli_query($conn, $sql_1);
            
                                        $sql_2 = "INSERT INTO eme_notifications SET
                                        Message = 'Appointment $Appointment_Id confirmed again.',
                                        msg_apt = 0";
                                        $result = mysqli_query($conn, $sql_2);
            
                                        $_SESSION['update'] =
                                            "<div class='alerts' style='visibility:visible'><div class='success-alert'>Appointment #" . $Appointment_Id . " Confirmed Again!</div></div>";
                                        header('location:' . SITEURL . 'templates/cancelledAp.php');
                                    } else {
                                        echo "Failed";
                                        $_SESSION['update'] = "<div class='alerts' style='visibility:visible'><div class='fail-alert'>Confirmation Failed. Try again later.</div></div>";
                                        header('location:' . SITEURL . 'templates/cancelledAp.php');
                                    }
                                } else {
                                    echo "";
                                }
                            }
                            ?>



                </table>
        <?php
                        } else {
                            //We don't have
                        }
                    }
        ?>

            </div>
        </form>


    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


<script src="../js/wm.js" ></script>



</body>

</html>