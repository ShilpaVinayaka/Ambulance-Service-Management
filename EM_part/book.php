<?php include("./maintemplate.php"); ?>
<?php include("./constants.php"); ?>
<title>Select Slot</title>
<?php
$mysqli = new mysqli('localhost', 'root', '', 'new');
if (isset($_GET['date'])) {
    $Date_d = $_GET['date'];
    $stmt = $mysqli->prepare("select * from appointments where Date_d = ?");
    $stmt->bind_param('s', $Date_d);
    $appointments = array();
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $appointments[] = $row['Time_t'];
            }
            $stmt->close();
        }
    }
}

// PHP program to pop an alert  message box on the screen 
// Display the alert box  


$date = date_default_timezone_set('Asia/Kolkata');
$hourMin = date('H:i');
//$hour=date('H','+1 hour');
$dt = date('H', strtotime('+1 hour'));

$hourrrr = $dt . ':00';

$duration = 10;
$cleanup = 0;
$start = $hourrrr;
$end = "13:00";
if (strtotime($start) < strtotime("09:00") && $date == date('Y-m-d')) {
    $start = "09:00";
}

function timeslots($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots = array();

    for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if ($endPeriod > $end) {
            break;
        }
        $slots[] = $intStart->format("H:iA") . "-" . $endPeriod->format("H:iA");
    }
    return $slots;
}
if (date('Y-m-d') == $Date_d) {
    timeslots($duration, $cleanup, $start, $end);
} else {
    $duration = 10;
    $cleanup = 0;
    $start = "09:00";
    $end = "13:00";
    timeslots($duration, $cleanup, $start, $end);
}
if ($Date_d < date('Y-m-d')) {
    $duration = 10;
    $cleanup = 0;
    $start = "00:00";
    $end = "00:00";
    timeslots($duration, $cleanup, $start, $end);
}


?>
<?php
$mysqli = new mysqli('localhost', 'root', '', 'new');
$con = new mysqli('localhost', 'root', '', 'new');
if (isset($_POST['submit'])) {
    $Appointment_Id = $_POST['Appointment_Id'];
    $Ambulance_No = $_POST['Ambulance_No'];
    $ServiceType = $_POST['ServiceType'];
    $PilotContactNo = $_POST['PilotContactNo'];
    $EmeContactNo = $_POST['EmeContactNo'];
    $ZwsName = $_POST['ZwsName'];

    $Time_t = $_POST['Time_t'];
    $stmt = $mysqli->prepare("select * from appointments where Date_d = ? AND Time_t=?");
    $stmt->bind_param('ss', $Date_d, $Time_t);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $msg = "<div class='alerts' style='visibility:visible'><div class='fail-alert'>Already Booked</div></div>";
        } else {
            $stmt = $mysqli->prepare("INSERT INTO appointments(Appointment_Id,Ambulance_No,ServiceType,PilotContactNo,EmeContactNo,ZwsName,Time_t,Date_d) 
            VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssssss', $Appointment_Id, $Ambulance_No, $ServiceType, $PilotContactNo, $EmeContactNo, $ZwsName, $Time_t, $Date_d);
            $stmt->execute();
            $stmt->close();


            $msg = "<div class='alerts' style='visibility:visible'><div class='success-alert'>Booking Successful</div></div>  
            <form method='post' action='confirmation.php'>
            <input type='hidden' name='Ambulance_No' value='" . $Ambulance_No . "'>
            <input type='hidden' name='Date_d' value='" . $Date_d . "'>
             <input type='hidden' name='ZwsName' value='" . $ZwsName . "'></form></div>";

             $sql_1 = "SELECT * FROM wm_notifications";
             $result = mysqli_query($conn, $sql_1);
 
             $sql_2 = "INSERT INTO wm_notifications SET
             Message = 'Appointment $Appointment_Id asking for confirmation!',
             msg_apt = 0";
             $res_2 = mysqli_query($conn, $sql_2);
             $mysqli->close();
        }
    }
}

?>
<style>
    .dropdown {
        float: left;
        overflow: hidden;
    }

    .dropdown .dropbtn {
        font-size: 17px;
        border: none;
        outline: none;
        color: black;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
    }

    .success-alert {
        background-color: #a9f886;
        color: #2e4922;
        font-weight: 500;
        border-radius: 1px;
        padding: 20px;
        margin-right: 23%;
        width: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .fail-alert {
        background-color: #ff4545;
        color: white;
        font-weight: 500;
        border-radius: 1px;
        padding: 20px;
        margin-right: 23%;
        width: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }


    .alerts {
        padding: 10px;
        margin-left: 82px;
        padding-top: 75px;
        margin-left: 276px;
        margin-right: 18%;
    }


    .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }
    @media only screen and (max-width: 1200px) and (min-width: 501px) {
        .alerts {
    padding: 10px;
    margin-left: 0px;
    padding-top: 75px;
    margin-left: 82px;
    margin-right: 0%;
  }}
    @media only screen and (max-width: 700px) and (min-width: 101px) {
        .alerts {
    padding: 10px;
    margin-left: 0px;
    padding-top: 75px;
    margin-left: 0px;
    margin-right: 0%;
  }}
    @media (min-width: 768px) {
        .modal-dialog {
            width: 640px;
            margin: 30px auto;
        }
    }
</style>


<div>
    <?php echo (isset($msg)) ? $msg : ""; ?>
</div>
<div class="alerts" style="visibility: hidden; display:none;"></div>
<div class="wrapper">
    <h2 id="heading">Select your Time Slot</h2>
    <div class="box-element">
        <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
        foreach ($timeslots as $ts) {
        ?>
            <div class="form-group">
                <?php if (in_array($ts, $appointments)) { ?>
                    <button class="btn btn-danger"><?php echo $ts; ?></button>
                <?php } else { ?>
                    <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>

                <?php }  ?>
            </div>
        <?php } ?>
    </div>


    <?php    //echo  $date;
    if (date("d-m-Y H:i") > date("d-m-Y 13:00") && $Date_d == date("Y-m-d")) {
    ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="box-element">
                    <?php
                    echo "<div><h3 style=\"position:relative;top:30px\" > Sorry slots are unavailable for </div><br><br> <h4 style='color:blue'>";
                    echo date('F d,Y', strtotime($Date_d));
                    echo "</h4> <br>";
                    echo ('<h4>Please Select another Date: </h4> ');
                    // echo date('F d,Y', strtotime('+1 day')); 
                    ?>
                    <a href="./calendar.php"><button id="Info-button">Go to Calendar</button></a>
                </div>
            </div>
        </div>

    <?php
    }
    ?>
</div>
<div class="wrapper">
    <div id="myModal" class="modal fade" role="dialog" style="width:100%">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Booking for: <span id="slot"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Time Slot</label>
                                    <input readonly type="text" class="form-control" id="timeslot" name="Time_t">
                                </div>
                                <div class="form-group">
                                    <label for="">Appointment ID</label>
                                    <input required type="text" class="form-control" name="Appointment_Id">
                                </div>

                                <div class="form-group">
                                    <label for="">Ambulance Number</label>
                                    <input required type="text" class="form-control" name="Ambulance_No">
                                </div>
                                <div class="form-group">
                                    <label for="">Service Type</label>
                                    <input required type="text" class="form-control" name="ServiceType">
                                </div>
                                <div class="form-group">
                                    <label for="">Pilot Contact Number</label>
                                    <input required type="number" class="form-control" name="PilotContactNo">
                                </div>
                                <div class="form-group">
                                    <label for="">Eme Contact Number</label>
                                    <input required type="number" class="form-control" name="EmeContactNo">
                                </div>
                                <div class="form-group">
                                    <label for="">Zws Name</label>
                                    <input required type="text" class="form-control" name="ZwsName">
                                </div>
                                <div>
                                    <div class="form-group" style="float: right;">
                                        <button name="submit" type="submit" id="Confirmation-button">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".book").click(function() {
        var timeslot = $(this).attr('data-timeslot');
        $("#slot").html(timeslot);
        $("#timeslot").val(timeslot);
        $("#myModal").modal("show");
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="wm.js"></script>


</body>

</html>