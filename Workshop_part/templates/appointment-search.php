<?php ob_start(); ?>

<?php include('../config/constants.php'); ?>

<?php include('../templates/maintemplate.php'); ?>

<title>Search Appointments</title>


<div class="alerts" style="visibility: hidden; display:none;"></div>

<div class="wrapper">


    <?php
    //Get search Keyword
    $search = $_POST['search'];
    ?>
    <h3 id="searchResults">Search Results for Service <a href=""><?php echo $search ?></a> </h3>

    <?php

    //SQL Query to Get appointments on search keyword
    $sql = "SELECT * FROM appointments WHERE Appointment_Id LIKE '%$search%' or Ambulance_No LIKE '%$search%' or ServiceType LIKE '%$search%'
    or PilotContactNo LIKE '%$search%' or EmeContactNo LIKE '%$search%'";


    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Count Rows
    $count = mysqli_num_rows($res);

    //Check whether food appointment available or not
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            //Get the details
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

                <div class="box-element">

                    <form action="" method="POST">

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
                        <?php
                        if ($Status == 1 && $Cancel_Status == 0) {
                            echo '
                                        <button id="Confirmation-button" style="float: right; margin:5px;">
                                            <a href="' . SITEURL . 'templates/wm.php?Appointment_Id=' . $Appointment_Id . '" style="color:black;">Confirmed</a>
                                        </button>                                         
                            ';
                        } else if ($Cancel_Status == 1 && $Status == 0) {
                            echo '   
                            <a href="' . SITEURL . 'templates/cancelledAp.php?Appointment_Id=' . $Appointment_Id . '">
                            <input type="button" id="Cancel-Status" value="Cancelled" name="cancelled" style="float: right; margin:5px">
                            </a>
                        ';
                        } else {
                            echo '
                            <div>
                            <button id="Info-button" style="float: right; margin:5px">
                                <a href="' . SITEURL . 'templates/confirm.php?Appointment_Id' . $Appointment_Id . '">Pending</a>
                            </button>
                        </div>
                        ';
                        }
                        ?>
                    </form>
                </div>
            </div>

    <?php
        }
    } else {
        echo "<div class='fail-alert'>Search Result not found!</div>";
    }

    ?>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="../js/wm.js"></script>

</body>