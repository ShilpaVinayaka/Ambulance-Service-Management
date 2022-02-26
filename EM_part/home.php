<?php ob_start(); ?>

<?php include("./maintemplate.php"); ?>
<?php include('./constants.php'); ?>
<title>Home</title>
<div class="home-wrapper">
    <div class="home">
        <h3>Welcome to the Automatic System of Ambulance Service Appointment!</h3>
    </div>
    <div class="col-lg-12">
        <div class="home-element">
            <div>
                <img src="./images/GVK_EMRI.jpg" alt="">
            </div>
            <div>
                <h2>Ambulance Repair and Service</h2>
                <p>Book your appointment for the service needed for the Ambulance.</p>
                <button id="Cancel-button"><a href="./calendar.php">Book
                        Appointment</a></button>
            </div>
        </div>
    </div>
    <hr>
    <div class="col-lg-12">
        <div class="home-element">
            <div>
                <img src="./images/Ambulance2.jpg" alt="">
            </div>
            <div>
                <h2>View Appointments</h2>
                <p>Check your Appointments of approval or reschedule. </p>
                <p>And also to cancel the appointments if not needed.</p>
                <button id="Confirmation-button"><a href="./view.php">View Appointment</a></button>
            </div>

        </div>
    </div>
    <hr>
    <div class="col-lg-12">
        <div class="home-element">
            <div>
                <img src="./images/Ambulance.jpg" alt="">
            </div>
            <div>
                <h2>Contact Workshop for further Information</h2>
                <p>Incase of query or feedback please reach out the workshop contacts</p>
                <button id="Info-button"><a href="./contact.php">Contact Workshop</a></button>
            </div>
        </div>
    </div>
    <hr>


    <div class="col-lg-12">
        <div class="home-element">

            <div class="services" id="services">
                <div class="side-right">
                    <h2 class="sub-head">Our Services</h2>
                </div>
                <div class="services__wrapper">
                    <div class="services__card">
                        <img src="images/20943392.jpg" alt="Avatar">
                        <h5>Repair of Mechanical Breakdown</h5>
                    </div>
                    <div class="services__card">
                        <img src="images/20944573.jpg" alt="Avatar">
                        <h5>General Checkup & Repairs</h6>

                    </div>
                    <div class="services__card">
                        <img src="images/20945487.jpg" alt="Avatar">
                        <h5>Minor and Major Accidental Services</h5>
                    </div>
                    <div class="services__card">
                        <img src="images/20944361.jpg" alt="Avatar">
                        <h5>Scheduled Services</h5>
                    </div>
                    <div class="services__card">
                        <img src="images/20945983.jpg" alt="Avatar">
                        <h5>Tyre & Battery Repairs</h5>
                    </div>
                    <div class="services__card">
                        <img src="images/20943565.jpg" alt="Avatar">
                        <h5>Insurance and Vehicle Fitness</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="wm.js"></script>

</body>

</html>