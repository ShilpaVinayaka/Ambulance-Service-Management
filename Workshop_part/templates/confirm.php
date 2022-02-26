<?php ob_start(); ?>

<?php include('../config/constants.php'); ?>

<?php include('../templates/maintemplate.php'); ?>


<title>Confirm Appointments</title>
<!-- End of Sidebar -->
<!-- Main Content -->
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
    <div class="heading-searchbar">
        <h2 id="heading">Confirm Appointments</h2>
        <form class="page-search" action="confirm-search.php" method="POST">
            <input type="text" name="search" class="navbar-search-input" placeholder="Search by Appointment Number, Service or Ambulance Number...">
            <i class="fa fa-search"></i>
        </form>
    </div>
    <br>
    <!-- <h3 id="subheading">Today's Appointments</h3> -->
    <?php
    //Query to GEt all Admin
    $sql = "SELECT * FROM appointments";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query is executed or not
    if ($res == TRUE) {
        //Count Rows to check whether we have data in db or not
        $count = mysqli_num_rows($res); //Function to get all the rows in database

        $records = 0;

        //Check number of rows
        if ($count > 0) {
            //We have data in db
            while ($rows = mysqli_fetch_assoc($res)) {
                //Using while loop to get all data from database
                //and while loop will run as long as we have data in db

                //Get individual data
                $Status = $rows['Status'];
                $Cancel_Status = $rows['Cancel_Status'];

                if ($Status == 0 && $Cancel_Status == 0) {
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
                    $Rescheduled = $rows['Rescheduled'];
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
                            //Query executed and Appointment updated
                            echo "Update Done";
                            $sql_1 = "SELECT * FROM eme_notifications";
                            $result = mysqli_query($conn, $sql_1);

                            $sql_2 = "INSERT INTO eme_notifications SET
                            Message = 'Appointment $Appointment_Id confirmed',
                            msg_apt = 0";
                            $result = mysqli_query($conn, $sql_2);

                            $_SESSION['update'] =
                                "<div class='alerts' style='visibility:visible'><div class='success-alert'>Appointment #" . $Appointment_Id . " confirmed!</div></div>";
                            //Redirect to manage appointment page
                            header('location:' . SITEURL . 'templates/confirm.php');
                        } else {
                            //Failed to Update
                            echo "Failed";
                            $_SESSION['update'] = "<div class='alerts' style='visibility:visible'><div class='fail-alert'>Confirmation Failed. Try again later.</div></div>";
                            //Redirect to manage appointment page
                            header('location:' . SITEURL . 'templates/confirm.php');
                        }
                    } else {

                        echo '';
                    }
                } 
            } //while loop
            
        }
    }


    ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="../js/wm.js"></script>








</body>