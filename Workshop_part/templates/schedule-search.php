<?php ob_start(); ?>


<?php include('../config/constants.php'); ?>

<?php include('../templates/maintemplate.php'); ?>

<title>Search Scheduled Appointments</title>

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



<!-- End of Sidebar -->
<!-- Main Content -->
<div class="wrapper">



    <div class="heading-searchbar">
        <h3 id="subheading">Confirmed Appointments</h3>
        <form class="page-search" action="schedule-search.php" method="POST">
            <input type="text" name="search" class="navbar-search-input" placeholder="Search by Appointment Number, Service or Ambulance Number...">
            <i class="fa fa-search"></i>
        </form>
    </div>

    <?php
    $search = $_POST['search'];
    ?>

    <h3 id="searchResults">Search Results for :  <a href=""><?php echo $search ?></a> </h3>
    <div class="alerts" style="visibility: hidden; display:none;"></div>

    <?php
    $sql = "SELECT * FROM appointments WHERE Appointment_Id LIKE '%$search%' or Ambulance_No LIKE '%$search%' or ServiceType LIKE '%$search%'
    or PilotContactNo LIKE '%$search%' or EmeContactNo LIKE '%$search%' or Date_d LIKE '%$search%' or Time_t LIKE '%$search%'" ;

    $res = mysqli_query($conn, $sql);
    $flag = 0;

    //Check number of rows
    if ($count > 0) {

        while ($row = mysqli_fetch_assoc($res)) {

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

            if (($Status == 1 && $Cancel_Status == 0) ) {
                $flag = 0;


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
                // echo '<div class="box-element"><div class="fail-alert">Search Result not found!</div></div>';
                $flag = 1;
            }
        } //while loop
        if($flag == 1)
        echo '<div class="box-element"><div class="fail-alert">Search Result not found!</div></div>';
    } else {
        echo '<div class="box-element"><div class="fail-alert">Search Result not found!</div></div>';
    }

    ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="../js/wm.js"></script>

</body>