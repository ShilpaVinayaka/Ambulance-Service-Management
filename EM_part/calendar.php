<?php include("./maintemplate.php"); ?>
<?php include("./constants.php"); ?>
<title>Book Appointment</title>
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2>Book Appointment</h2>
                <div class="box-element">
                    <h3>Select Date</h3>
                    <?php
                    $dateComponents = getdate();
                    if (isset($_GET['month']) && isset($_GET['year'])) {
                        $month = $_GET['month'];
                        $year = $_GET['year'];
                    } else {
                        $month = $dateComponents['mon'];
                        $year = $dateComponents['year'];
                    }
                    echo build_calendar($month, $year);
                    ?>
                </div>
            </div>
               
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    

</body>

</html>

<?php
function familyName($Date_d)
{
    $dat = date('Y-m-d');
    $conn = mysqli_connect('localhost', 'root', '', 'new');
    $query = "select date from blacklist where date>=$Date_d;";
    $res = mysqli_query($conn, $query);
    $flag = 0;
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $row["date"];
            if (strtotime($Date_d) == strtotime($row["date"])) {
                $flag = 1;
            } else {
                //echo "GREEN! $date";
            }
        }
    }
    if ($flag == 1)
        return 1;
    else return 0;
}
function build_calendar($month, $year)
{
    // Create array containing abbreviations of days of week.
    $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // How many days does this month contain?
    $numberDays = date('t', $firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?
    $monthName = $dateComponents['month'];

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers

    $datetoday = date('d-m-Y');

    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<div class='month-name'><h4>$monthName $year</h4>";
    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'>Previous Month</a> &nbsp; &nbsp;";
    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>Next Month</a>";
    $calendar .= "<tr>";
    '\n';
    // Create the calendar headers

    foreach ($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    }

    // Create the rest of the calendar

    // Initiate the day counter, starting with the 1st.

    $currentDay = 1;
    $calendar .= "</tr><tr>";


    // The variable $dayOfWeek is used to
    // ensure that the calendar
    // display consists of exactly 7 columns.

    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td  class='empty'></td>";
        }
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {

        // Seventh column (Saturday) reached. Start a new row.

        if ($dayOfWeek == 7) {

            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $Date_d = "$year-$month-$currentDayRel";

        $dayname = strtolower(date('l', strtotime($Date_d)));
        $eventNum = 0;
        $today = $Date_d == date('Y-m-d') ? "today" : "";
        if ($Date_d < date('Y-m-d')) {
            $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
        } elseif ($dayOfWeek == 6) {
            $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
            # code...
        } elseif ($dayOfWeek == 0) {
            $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
        } elseif (familyName($Date_d) == 1) {
            $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
        } elseif ((int)$currentDay < (int)date('d') + 8) {
             $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=" . $Date_d . "'onclick='bookSlot()' class='btn btn-success btn-xs'>Book</a>";
        } else {
            $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
        }

        $calendar .= "</td>";
        // Increment counters

        $currentDay++;
        $dayOfWeek++;
    }

    // Complete the row of the last week in month, if necessary

    if ($dayOfWeek != 7) {

        $remainingDays = 7 - $dayOfWeek;
        for ($l = 0; $l < $remainingDays; $l++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";
    echo $calendar;
}

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="./wm.js"></script>
