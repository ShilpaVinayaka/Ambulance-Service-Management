<?php ob_start(); ?>

<?php include("./constants.php"); ?>
<?php include("./maintemplate.php"); ?>
<?php $Date_d = null ?>
<title>View Appointments</title>
<link rel="icon" type="image/" href="./images/logo.jpg">
<div class="wrapper">
  <div class="row">

    <div class="col-lg-12">
      <a href="./delete.php" class="input_box" id="Cancel-button" style="float: left; color: whitesmoke; font-weight: 600;">Cancel Appointment</a>
      <a href="./status.php" class="input_box" id="Info-button" style="float: right; color: white; font-weight: 600;">Check Appointment Status</a>

    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="box-element">
        <form action='view.php' method='post'>
          <h3>Pick a date to check appointments:</h3>
          <div>
            <input class="input_box" type="date" name="Date_d" value="<?php echo $Date_d ?>" style="float:left; padding: 7px; margin:12px" placeholder="Enter Date">
          </div>
          <div><input id="Confirmation-button" type="submit" style="float:left; margin:12px" name="submit" value="Submit"></div>
          <span><input class="input_box" style="float:right; color: blue; font-weight:500" type="submit" value="View All Appointments"></span>
        </form>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="box-element">
        <?php
        // session_start();
        $con = mysqli_connect('localhost', 'root', '', 'new');
        if (isset($_POST['submit'])) {
          $Date_d = $_POST['Date_d'];
          echo "<h4 style='color:black;'><center>Appointments on Date: <b>$Date_d</b> <center></h4>";

          $query = "select * from appointments where Date_d='$Date_d' order by Appointment_Id asc";
          $result = mysqli_query($con, $query);
          if (mysqli_num_rows($result) > 0) {
        ?>
            <hr>
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

                  echo "<tr><td>" . $row["Appointment_Id"] . "</td>" . "<td>" .
                    $row["Ambulance_No"] . "</td><td>" .
                    $row["ServiceType"] . "</td><td>" .
                    $row["PilotContactNo"] . "</td><td>" .
                    $row["Date_d"] . "</td><td>" .
                    $row["Time_t"] . "</td>";
                ?>
                  <td style="text-align: center;">
                    <?php
                    if ($Status == 1 && $Cancel_Status == 0) {
                      echo '
                            <span style=" margin:5px; color: rgb(131, 207, 17); font-weight: 500;">
                          Confirmed </span>   ';
                    } else if ($Cancel_Status == 1 && $Status == 0) {
                      echo '   
                        <span style=" margin:5px; color: red; font-weight: 500;">
                        Cancelled </span>   ';
                    } else if ($Rescheduled == 1 && $Status == 1) {
                      echo '   
                        <span style=" margin:5px; color: rgb(131, 207, 17); font-weight: 500;">
                        Rescheduled </span>   ';
                    } else {
                      echo '
                          <span style="margin:5px; color: Blue; font-weight: 500;">
                        Pending </span>  ';
                    }
                    ?>
                  </td>
                <?php
                } ?>
              </table>
            </div>
            <?php
            $query = "select * from appointments where Date_d='$Date_d' order by Appointment_Id asc";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
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
                  ?>
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
          }} }else {
            echo '<br><center>
                <span style="color: black; font-size: 15px;align:center;" class="p-3 mb-2 bg-warning text-dark">
                No search results found !
                </span><br><br></center>';
          }
        } else {
          $sql = "SELECT * FROM appointments";
          $res = mysqli_query($conn, $sql);

          if ($res == TRUE) {
            $count = mysqli_num_rows($res); //Function to get all the rows in database
          ?>
            <div class="view_big">
              <table>
                <tr>
                  <th scope="col">Appointment id</th>
                  <th scope="col">Ambulance Number</th>
                  <th scope="col">Service Type</th>
                  <th scope="col">Driver Number</th>
                  <th scope="col">Booked Date </th>
                  <th scope="col">Booked Slot</th>
                  <th scope="col" style="text-align:center;">Status</th>
                </tr>
                <?php
                if ($count > 0) {
                  while ($rows = mysqli_fetch_assoc($res)) {
                    $Status = $rows['Status'];
                    $Cancel_Status = $rows['Cancel_Status'];

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
                    <tr>
                      <td><?php echo $Appointment_Id ?></td>
                      <td><?php echo $Ambulance_No ?></td>
                      <td><?php echo $ServiceType ?></td>
                      <td><?php echo $PilotContactNo ?></td>
                      <td><?php echo $Date_d ?></td>
                      <td><?php echo $Time_t ?></td>
                      <td style="text-align: center;">
                        <?php
                        if ($Status == 1 && $Cancel_Status == 0) {
                          echo '
                            <span style=" margin:5px; color: rgb(131, 207, 17); font-weight: 500;">
                          Confirmed </span>   
                                                                 
                                            ';
                        } else if ($Cancel_Status == 1 && $Status == 0) {
                          echo '   
                        <span style=" margin:5px; color: red; font-weight: 500;">
                        Cancelled </span>   
                                      ';
                        } else if ($Rescheduled == 1 && $Status == 1) {
                          echo '   
                        <span style=" margin:5px; color: rgb(131, 207, 17); font-weight: 500;">
                        Rescheduled </span>   
                                      ';
                        } else {
                          echo '
                          <span style="margin:5px; color: Blue; font-weight: 500;">
                        Pending </span>  
                                        ';
                        }
                        ?>
                      </td>
                    </tr>


                  <?php
                  } ?>
              </table>
            </div>

            <?php
                }
                $sql = "SELECT * FROM appointments";
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
            ?>
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
                    }
                  }
                }
              }
            }
            mysqli_close($con);
      ?>



      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="wm.js"></script>

</body>

</html>