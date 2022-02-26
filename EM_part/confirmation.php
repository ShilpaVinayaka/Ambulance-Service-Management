<?php include("./maintemplate.php"); ?>
<?php include("./constants.php"); ?>
<title>Confirm Appointments</title>



<?php
$con = new mysqli('localhost', 'root', '', 'new');
if (isset($_POST['submit'])) {
    session_start();
    $con = mysqli_connect("localhost", "root", "", "new");

    $Appointment_Id = $_POST['Appointment_Id '];
    #echo $phone;
    $Ambulance_No = $_POST['Ambulance_No'];
    #echo $name;
    $Date_d = $_POST['Date_d'];
    #echo $date;
    $query = "select Appointment_Id,Ambulance_No,Date_d,Time_t from appointments where Date_d='$Date_d' AND Appointment_Id ='$Appointment_Id '";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
}
?>
<div class="row">
    <div class="my-6 col-12 col-md-4" style="order: 0;">
        <div class="text-center serviceIcon">
        </div>
    </div>
    <div class="my-2 col-12 col-md-4" style="order: 1;">
        <div class="text-center serviceIcon">
            <h2 class="text-center text-lg text-primary">


        </div>
    </div>


    <div class="my-3 col-12 col-md-4" style="order: 2;">
        <div class="text-center serviceIcon"></div>
    </div>
    <div class="my-3 col-12 col-md-4" style="order: 3;">
        <div class="text-center serviceIcon"></div>
    </div>
    <div class="my-3 col-12 col-md-4" style="order: 4;">
        <div class="text-center serviceIcon">
            <h3>We request you to keep a note of these details.<br><br>
                Please be 10 mins prior to the time slot alloted to you.<br><br>
                Thank you for letting us serve you!</h3>
        </div>
    </div>


    <br>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="wm.js"></script>

    </body>

    </html>