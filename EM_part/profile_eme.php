<?php include('./constants.php'); ?>

<?php include('./maintemplate.php'); ?>
<title>Profile</title>
<div class="wrapper">
    <div class="col-lg-12">
        <div class="box-element">
            <div class="profile">
                <div class="profilePic">
                    <img src="./images/profile.png" alt="EME Image" class="dropdown-toggle" data-toggle="user-menu">
                </div>
                <div class="wmName">
                    <h4>EME Name</h4>
                </div>
                <br>
                <div class="wmAddress">
                    <div class="form-row">
                        <div class="form-col-15">
                            <span>
                                <img src="./images/address.png" alt="Workshop Manager Image" class="dropdown-toggle" data-toggle="user-menu">
                            </span>
                        </div>
                        <div class="form-col-65">
                            <label>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Inventore eos dolore quibusdam error odit ad nihil ut voluptates sint iusto.
                            </label>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <?php
            $sql = "SELECT * FROM appointments";
            $res = mysqli_query($conn, $sql);
            $count_confirm = 0;
            $count_cancelled = 0;
            $count_rescheduled = 0;
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);

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

                        if ($Rescheduled == 1)
                            $count_rescheduled++;

                        if ($Status == 1 && $Cancel_Status == 0)
                            $count_confirm++;

                        else if ($Status == 0 && $Cancel_Status == 1)
                            $count_cancelled++;
                    }
                }
            }


            ?>
            <div class="count">
                <div class="status">
                    <h4>Appointment Statistics</h4>
                </div>
                <div class="statusCounts">
                    <div class="space">
                        <div class="no_Confirmed">
                            <span><?php echo $count_confirm ?></span>
                            <div>Booked</div>
                        </div>
                    </div>

                    <div class="space">
                        <div class="no_Rescheduled">
                            <span><?php echo $count_rescheduled ?></span>
                            <div>Rescheduled</div>
                        </div>
                    </div>

                    <div class="space">
                        <div class="no_Cancelled">
                            <span><?php echo $count_cancelled ?></span>
                            <div>Cancelled</div>
                        </div>

                    </div>
                </div>

            </div>
            <?php

            ?>

        </div>
    </div>
</div>