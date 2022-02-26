<?php ob_start(); ?>


<?php include('../config/constants.php'); ?>

<?php include('../templates/maintemplate.php'); ?>

<title>Appointment Schedule</title>

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

<!-- End of Sidebar -->
<!-- Main Content -->
<div class="wrapper">
    <div class="col-lg-12">
        <div class="box-element">
            <h2 id="heading">Appointment Schedule</h2>
            <h3>Search by Date</h3> <br>
            <form action="" method="POST">
                <div> <input class="input_box" type="date" name="Date_d" style="margin:5px; float:left; " value="<?php echo $Date_d; ?>">
                </div>
                <div>
                    <input type="submit" name="submit" id="Confirmation-button" style="margin:5px; float:left;"> </button>

                </div>
            </form>
            <br>

            <?php
            // session_start();
            $con = mysqli_connect('localhost', 'root', '', 'new');
            if (isset($_POST['submit'])) {
                $Date_d = $_POST['Date_d'];
            ?>

                <table>
                    <a href="<?php echo SITEURL; ?>templates/wm.php">
                        <span class="close-symbol" style="float: right;"><b>&#x2715;</b></span>
                    </a>
                    <br>
                    <?php
                    $query = "select * from appointments where Date_d='$Date_d' order by Appointment_Id asc";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <tr>
                            <th scope="col">Appointment id</th>
                            <th scope="col">Ambulance Number</th>
                            <th scope="col">Service Type</th>
                            <th scope="col">Driver Number</th>
                            <th scope="col">EME Number</th>
                            <th scope="col">Booked Date </th>
                            <th scope="col">Booked Slot</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
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

                            if($Status == 1 || $Rescheduled == 1){
                            echo "<tr><td>" . $row["Appointment_Id"] . "</td>" . "<td>" .
                                $row["Ambulance_No"] . "</td><td>" .
                                $row["ServiceType"] . "</td><td>" .
                                $row["PilotContactNo"] . "</td><td>" .
                                $row["EmeContactNo"] . "</td><td>" .
                                $row["Date_d"] . "</td><td>" .
                                $row["Time_t"] . "</td>";
                        }}
                        ?>

                <?php
                    } else {
                        echo '<br><center>
                    <span style="color: black; font-size: 15px;align:center;" class="p-3 mb-2 bg-warning text-dark">
                    No search results found !
                    </span><br><br></center>';
                    }
                }
                ?>
                </table>

        </div>
    </div> <?php
            mysqli_close($con);
            ?>


    <div class="heading-searchbar">
        <h3 id="subheading">Confirmed Appointments</h3>
        <form class="page-search" action="schedule-search.php" method="POST">
            <input type="text" name="search" class="navbar-search-input" placeholder="Search by Appointment Number, Service or Ambulance Number...">
            <i class="fa fa-search"></i>
        </form>
    </div>

    <?php
    //Query to GEt all Admin
    $sql = "SELECT * FROM appointments";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res); //Function to get all the rows in database

        if ($count > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {
                $Status = $rows['Status'];
                $Cancel_Status = $rows['Cancel_Status'];

                if ($Status == 1 && $Cancel_Status == 0) {
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

                    //Display Values
    ?>
                    <div class="col-lg-12">
                        <div class="box-element">
                            <form action="" method="POST">
                                <a href="<?php echo SITEURL; ?>templates/cancel_wm.php?Appointment_Id=<?php echo $Appointment_Id; ?>">
                                    <input type="button" id="Cancel-button" value="Cancel Appointment" name="<?php echo "Cancel_" . $Appointment_Id ?>" style="float: right; margin:5px">
                                </a>
                                <div>
                                    <button id="Info-button" style='float: right; margin:5px'>
                                        <a href="<?php echo SITEURL; ?>templates/reschedule.php?Appointment_Id=<?php echo $Appointment_Id; ?>">Reschedule</a>
                                    </button>
                                </div>
                                <div>
                                    <h3 id="appointment-id" name="Appointment_Id">Appointmentid: <?php echo $Appointment_Id ?></h3>
                                    <br>
                                    <div class="appointment-details">
                                        <div id="sub-info">
                                            <span>Ambulance Number: <span><?php echo $Ambulance_No ?></span></span>
                                            <span>Type of Service: <span><?php echo $ServiceType ?></span></span>
                                        </div>
                                        <div id="sub-info">
                                            <span>Date: <?php echo $Date_d ?><span></span></span>
                                            <span>Timings: <span><?php echo $Time_t ?></span></span>
                                        </div>
                                        <div id="sub-info">
                                            <span>Pilot Contact No: <?php echo $PilotContactNo ?><span></span></span>
                                            <span>Eme Contact No: <span><?php echo $EmeContactNo ?></span></span>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
    <?php

                    // 

                } else {
                    continue;
                }
            } //while loop
        } else {
            //We don't have
        }
    } else {
    }
    ?>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="../js/wm.js"></script>

</body>