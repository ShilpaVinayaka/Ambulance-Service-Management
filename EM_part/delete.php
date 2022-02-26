<?php ob_start(); ?>

<?php include("./maintemplate.php"); ?>
<?php include('./constants.php'); ?>
<title>Cancel Appointment</title>
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
<?php
if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete']; //Displaying Session Message
    unset($_SESSION['delete']); //Removing Session Message
}
?>
<?php

if (isset($_POST['Appointment_Id'])) {
    $Appointment_Id = $_POST['Appointment_Id'];

    $sql1 = "SELECT EXISTS ( SELECT * FROM appointments WHERE Appointment_Id = $Appointment_Id)";
    $res1 = mysqli_query($conn, $sql1);

    if ($res1 == true) {
        $sql = "DELETE FROM appointments WHERE Appointment_Id = $Appointment_Id";
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            echo "<div class='alerts' style='display:block'><div class='success-alert'>Appointment #$Appointment_Id Deleted</div></div>";
            echo "<div class='alerts' style='display:none''><div class='fail-alert'>Appointment #$Appointment_Id Doesn't exist!</div></div>";
        } else {
            echo "Cant delete";
        }
    } else {
        echo "<div class='alerts' style='display:none'><div class='success-alert'>Appointment Deleted</div></div>";
        echo "<div class='alerts' style='display:block''><div class='fail-alert'>Appointment Doesn't exist!</div></div>";
    }
}

?><div class="wrapper">
    <?php
    $sql = "SELECT * FROM appointments";
    $res = mysqli_query($conn, $sql);
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
            }
        }
    }
    ?>
    <h2 id="heading">Cancel Booked Appointments</h2>

    <div class="row">
        <div class="col-lg-12">
            <div class="box-element">
                <form method="post">
                    <h3>Enter Appointment ID</h3>
                    <br>
                    <div class="form-col-75">
                        <input type="number" value="<?php $Appointment_Id ?>" name="Appointment_Id" placeholder="Appointment_Id" />
                    </div>
                    <br><br><br>
                    <div>
                        <input type="submit" id="Cancel-button" value="Cancel Appointment" style='width: 40%; margin:5px; color:white;'></button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="wm.js"></script>

</body>

</html>