<?php ob_start(); ?>

<?php include("./maintemplate.php"); ?>
<?php include('./constants.php'); ?>
<title>Check Status</title>
<style>
    .dropbtn {
        background-image: linear-gradient(to right, #c03512 0%, #e65035 51%, #f81717 100%);

        margin: 5px;
        width: 250px;
        height: 60px;
        padding: 15px 45px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
    }

    .dropbtn:hover {
        background-position: right center;
        /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }

    input {
        padding: 10px;
        border-radius: 2px;
        border: 0px;
        box-shadow: var(--box-shadow-1);
        align-items: flex-end;
        width: 50%;
        resize: vertical;
        outline: none;
        box-shadow: 0 0 8px rgb(0 0 0 / 20%);
    }
</style>
<div class="wrapper">
    <?php
    //Query to GEt all Admin
    $sql = "SELECT * FROM appointments";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res); //Function to get all the rows in database

        if ($count > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {

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
            }
        }
    }

    ?>
    <h2 id="heading">Know Your Appointment Status</h2>

    <div class="row">
        <div class="col-lg-12">
            <div class="box-element">
                <form method="POST">
                    <h3>Enter Appointment ID</h3>
                    <br>
                    <div class="form-col-75">
                        <input type="text" name="Appointment_Id" placeholder="Appointment_Id" />
                    </div>
                    <br><br><br>
                    <input type="submit" id="Info-button" value="Get Appointment Status" style='width: 65%; margin:5px; color:white'></button>
                </form>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST["Appointment_Id"])) {
        // Get all the values from form to update
        $Appointment_Id = $_POST['Appointment_Id'];

        $query = "SELECT * FROM appointments Where Appointment_Id='$Appointment_Id' ";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Status = $row['Status'];
                $Cancel_Status = $row['Cancel_Status'];
                $Rescheduled = $row['Rescheduled'];    ?>
                <div class="view_big">

                    <table>
                        <tr>
                            <th scope="col">Appointment id</th>
                            <th scope="col">Ambulance Number</th>
                            <th scope="col">Service Type</th>
                            <th scope="col">Driver Number</th>
                            <th scope="col">Booked Date </th>
                            <th scope="col">Booked Slot</th>
                            <th scope="col">Status</th>
                        </tr>
                    <?php
                    echo "<tr><td>" . $row["Appointment_Id"] . "</td>" . "<td>" .
                        $row["Ambulance_No"] . "</td><td>" .
                        $row["ServiceType"] . "</td><td>" .
                        $row["PilotContactNo"] . "</td><td>" .
                        $row["Date_d"] . "</td><td>" .
                        $row["Time_t"] . "</td>";
                    if ($Status == 1) {
                        echo '
                        <td> <span style=" margin:5px; color: rgb(131, 207, 17); font-weight: 500;">
                        Confirmed </span>   </td>                                      
                                            ';
                    } else if ($Cancel_Status == 1) {
                        echo '   
                            <td><span style=" margin:5px; color: red; font-weight: 500;">
                            Cancelled </span>   </td>
                                        ';
                    } else if ($Rescheduled == 1) {
                        echo '   <td> <span style=" margin:5px; color: rgb(131, 207, 17); font-weight: 500;">
                    Rescheduled </span>   </td>';
                    } else {
                        echo '<td> <span style="margin:5px; color: Blue; font-weight: 500;">
                            Pending </span></td>
                                        ';
                    }
                }
                    ?>
                    </table>
                </div>
<?php
        $query = "SELECT * FROM appointments Where Appointment_Id='$Appointment_Id' ";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $Status = $row['Status'];
                $Cancel_Status = $row['Cancel_Status'];
                $Rescheduled = $row['Rescheduled'];    ?>

                <div class="col-lg-12 view_small">

                    <div class="box-element">
                        <div id="sub-info" style="float: right;">
                            <?php
                            if ($Status == 1 && $Cancel_Status == 0) {
                                echo '
                                                    <span id="Confirmation-button" style="font-weight: 500;">
                                                Confirmed </span>   
                                                            
                                            ';
                                                                        } else if ($Cancel_Status == 1 && $Status == 0) {
                                                                            echo '   
                                                    <span id="Cancel-button" style="font-weight: 500;">
                                                    Cancelled </span>   ';
                                                                        } else if ($Rescheduled == 1 && $Status == 1) {
                                                                            echo '   
                                                <span id="Info-button" style="font-weight: 500;">
                                                Rescheduled </span>   ';
                                                                        } else {
                                                                            echo '
                                                <span id="Info-button" style=" font-weight: 500;">
                                                Pending </span>   ';
                            }
                            ?>
                        </div><br><br>
                        <div>

                            <h4 id="appointment-id" name="Appointment_Id">Appointmentid: <?php echo $Appointment_Id ?></h4>

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
                    </div>
                </div>

        <?php
        }}} else {
            echo '<br><center>
          <span style="color: black; font-size: 15px;align:center;" class="p-3 mb-2 bg-warning text-dark">
          No search results found !
          </span><br><br></center>';
        }        //Check whether the query executed successfully or not
    }
        ?>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="eme.js"></script>

</body>

</html>