<?php ob_start(); ?>

<?php include('../config/constants.php'); ?>

<?php include('../templates/maintemplate.php'); ?>
<title>Confirmed Appointments Search</title>
<?php
if (isset($_SESSION['alert'])) {
    echo $_SESSION['alert']; //Displaying Session Message
    unset($_SESSION['alert']); //Removing Session Message
}
?>

<div class="wrapper">
    <div class="heading-searchbar">
        <h2 id="heading">Confirm Appointments</h2>
        <form class="page-search" action="confirm-search.php" method="POST">
            <input type="text" name="search" class="navbar-search-input" placeholder="Search by Appointment Number, Service or Ambulance Number...">
            <i class="fa fa-search"></i>
        </form>
    </div>

    <br>

    <?php
    //Get search Keyword
    $search = $_POST['search'];
    ?>
    <h3 id="searchResults">Search Results for Service <a href=""><?php echo $search ?></a> </h3>
    <div class="alerts" style="visibility: hidden; display:none;"></div>

    <?php
    $sql = "SELECT * FROM appointments WHERE Appointment_Id LIKE '%$search%' or Ambulance_No LIKE '%$search%' or ServiceType LIKE '%$search%'
    or PilotContactNo LIKE '%$search%' or EmeContactNo LIKE '%$search%'";

    $res = mysqli_query($conn, $sql);

    //Check number of rows
    if ($count > 0) {

        while ($row = mysqli_fetch_assoc($res)) {
            $Status = $row['Status'];
            $Cancel_Status = $row['Cancel_Status'];

            if ($Status == 0 && $Cancel_Status == 0) {
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

    ?>
                <div class="col-lg-12">
                    <div class="box-element-confirm">
                        <form action="" method="POST">
                            <a href="<?php echo SITEURL; ?>templates/confirm.php?Appointment_Id=<?php echo $Appointment_Id; ?>">
                                <input type="submit" value="Confirm" id="Confirmation-button" name="<?php echo "confirm_" . $Appointment_Id ?>" style='float: right; margin:5px'>
                            </a>

                            <button id="Info-button" style='float: right; margin:5px'>
                                <a href="<?php echo SITEURL; ?>templates/reschedule.php?Appointment_Id=<?php echo $Appointment_Id; ?>">Reschedule</a>
                            </button>

                            <a href="<?php echo SITEURL; ?>templates/cancel_option.php?Appointment_Id=<?php echo $Appointment_Id; ?>">
                                <input type="button" id="Cancel-button" value="Cancel" name="<?php echo "Cancel_" . $Appointment_Id ?>" style="float: right; margin:5px">
                            </a>
                            <h4 id="appointment-id" name="Appointment_Id">Appointmentid: <?php echo $Appointment_Id ?></h4>


                            <div class="appointment-details">
                                <table>
                                    <tr>
                                        <th>Ambulance</th>
                                        <th>Service</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $Ambulance_No ?></td>
                                        <td><?php echo $ServiceType ?></td>
                                        <td><?php echo $Date_d ?></td>
                                        <td><?php echo $Time_t ?></td>

                                    </tr>
                                </table>
                            </div>

                        </form>
                    </div>
                </div>

    <?php
                if (isset($_POST["confirm_" . $Appointment_Id])) {
                    // Get all the values from form to update
                    $Status = $_POST['Status'];

                    //Create SQL Query to Update Admin
                    $sql_ = "UPDATE appointments SET
                                Status = 1
                                WHERE Appointment_Id=$Appointment_Id";

                    //Execute the Query
                    $result = mysqli_query($conn, $sql_);

                    //Check whether the query executed successfully or not
                    if ($result == true) {
                        $_SESSION['update'] =
                            "<div class='alerts' style='visibility:visible'><div class='success-alert'>Appointment #" . $Appointment_Id . " confirmed!</div></div>";
                        //Redirect to manage appointment page
                        header('location:' . SITEURL . 'templates/confirm.php');
                    } else {
                        $_SESSION['update'] = "<div class='alerts' style='visibility:visible'><div class='fail-alert'>Confirmation Failed. Try again later.</div></div>";
                        //Redirect to manage appointment page
                        header('location:' . SITEURL . 'templates/confirm.php');
                    }
                }
            }
        } //while loop
    } else {
        echo '<div class="fail-alert">Search Result not found!</div>';
    }


    ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="../js/wm.js"></script>


</body>