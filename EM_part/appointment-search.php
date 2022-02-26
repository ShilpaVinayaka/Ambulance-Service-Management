<?php ob_start(); ?>

<?php include('./constants.php'); ?>
<?php include('./maintemplate.php'); ?>

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

            <div class="box-element">

                <form action="" method="POST">

                    <div>
                        <h4 id="appointment-id" name="Appointment_Id">Appointment Id: <?php echo $Appointment_Id ?></h4>

                        <div class="appointment-details">
                            <div id="sub-info">
                                <span> <b>Ambulance Number:</b> <span><?php echo $Ambulance_No ?></span></span>
                                <span> <b>Type of Service:</b> <span><?php echo $ServiceType ?></span></span>
                            </div>
                            <div id="sub-info">
                                <span> <b>Date:</b> <?php echo $Date_d ?><span></span></span>
                                <span> <b>Timings:</b> <span><?php echo $Time_t ?></span></span>
                            </div>
                            <div id="sub-info">
                                <span> <b>Pilot Contact No:</b> <?php echo $PilotContactNo ?><span></span></span>
                                <span> <b>Eme Contact No:</b> <span><?php echo $EmeContactNo ?></span></span>
                            </div>

                        </div>
                    </div>
                    <?php
                    if ($Status == 1 && $Cancel_Status == 0) {
                        echo '
                        <span id="Confirmation-button" style="float: right; float:right; margin:5px;">
                            Confirmed </span>
                                                                   
                                              ';
                    } else if ($Cancel_Status == 1 && $Status == 0) {
                        echo '   
                          <span id="Cancel-button" style=" margin:5px; color: whitesmoke; float:right; font-weight: 500;">
                          Cancelled </span>   
                                        ';
                    } else if ($Rescheduled == 1 && $Status == 1) {
                        echo '   
                          <span id="Info-button" style=" margin:5px; color: whitesmoke; float:right; font-weight: 500;">
                          Rescheduled </span>   
                                        ';
                    } else {
                        echo '
                            <span id="Info-button"  style="margin:5px; color: whitesmoke; float:right; font-weight: 500;">
                          Pending </span>  
                                          ';
                    }

                    ?>
                </form>
            </div>
            <br>

    <?php
        }
    } else {
        echo "<div class='fail-alert'>Search Result not found!</div>";
    }

    ?>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="./wm.js"></script>

</body>