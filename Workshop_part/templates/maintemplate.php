<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/" href="../images/logo.jpg">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/wm.css">

</head>

<?php
if (isset($_SESSION['notification'])) {
    echo $_SESSION['notification']; //Displaying Session Message
    unset($_SESSION['notification']); //Removing Session Message
}
?>

<body class="overlay-scrollbar">
    <!-- Navbar -->
    <div class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link">
                    <i class="fa fa-bars" onclick="collapseSidebar()"></i>
                </a>
            </li>
            <li class="nav-item">
                <img src="../images/logo_main.jpg" alt="GVK EMRI" class="logo">
            </li>
        </ul>

        <form class="navbar-search" action="appointment-search.php" method="POST">
            <input type="text" name="search" class="navbar-search-input" placeholder="Search Appointments...">
            <i class="fa fa-search"></i>
        </form>



        <ul class="navbar-nav nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link">
                    <?php
                    $sql = "SELECT * FROM wm_notifications WHERE Status ='unread' ORDER BY 'Date_time' DESC";
                    $res = mysqli_query($conn, $sql);

                    if ($res == TRUE) {
                        $count = mysqli_num_rows($res);
                    ?>
                        <i class="fa fa-bell dropdown-toggle" data-toggle="notification-menu"></i>
                        <span class="navbar-badge"><?php echo $count ?></span>

                </a>
                <ul id="notification-menu" class="dropdown_menu notification-menu">
                    <div class="dropdown-menu-header">
                        <span>Notifications</span>
                    </div>

                    <div class="dropdown-menu-content overlay-scrollbar scrollbar-hover">
                        <?php
                        if ($count > 0) {
                        ?>
                            <form method="POST">
                                <?php
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    $id = $rows['id'];
                                    $Date_time = $rows['Date_time'];
                                    $Message = $rows['Message'];
                                    $msg_apt = $rows['msg_apt'];
                                    $confirm_cancel = $rows['confirm_cancel'];
                                    $Status = $rows['Status'];

                                    if ($Status == "unread") {
                                ?>
                                        <li class="dropdown-menu-item">
                                            <a href="#" class="dropdown-menu-link">
                                                <div><i class="fa fa-tasks"></i></div>
                                                <span>
                                                    <?php echo $Message ?>
                                                    <br>
                                                    <span><?php echo $Date_time ?></span>
                                                </span>
                                            </a>
                                        </li>
                            </form>
                    <?php
                                    }
                                }
                            } else {
                    ?>
                    <li class="dropdown-menu-item">
                        <a href="#" class="dropdown-menu-link">
                            <div></div>
                            <span>
                                <i><?php echo "No Records Yet" ?></i>
                                <br>
                            </span>
                        </a>
                    </li>
                <?php
                            }
                ?>
                    </div>

                    <div class="dropdown-menu-footer">
                        <a href="../templates/history.php"><span style="color: blue;">View all notifications</span></a>
                    </div>
                </ul>
            <?php
                    }
            ?>
            </li>
            <li class="nav-item avt-wrapper">
                <div class="avt dropdown">
                    <img src="../images/wm-profile.png" alt="Workshop Manager Image" class="dropdown-toggle" data-toggle="user-menu">
                    <ul id="user-menu" class="dropdown_menu nav-profile">
                        <li class="dropdown-menu-item green">
                            <a href="../templates/profile.php" class="dropdown-menu-link">
                                <div>
                                    <i><img src="../images/wm-profile.png" alt=""></i>
                                </div>
                                <span>Profile</span>
                            </a>
                        </li>
                        <!-- <li class="dropdown-menu-item blue">
                            <a href="#nowhere" class="dropdown-menu-link">
                                <div>
                                    <i><img src="../images/settings.png" alt=""></i>
                                </div>
                                <span>Settings</span>
                            </a>
                        </li> -->
                        <li class="dropdown-menu-item red">
                            <a href="../templates/index.html" class="dropdown-menu-link">
                                <div>
                                    <i><img src="../images/logout.png" alt=""></i>
                                </div>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
        </ul>

    </div>
    <!-- End of Navbar -->
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item">
                <a href="../templates/wm.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="../images/schedule.png" alt=""></i>
                    </div>
                    <span>Appointment Schedule</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="../templates/confirm.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="../images/confirm_appointment.png" alt=""></i>
                    </div>
                    <span>Confirm Appointment</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="../templates/cancelledAp.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="../images/cancelled_appointments.png" alt=""></i>
                    </div>
                    <span>Cancelled Appointments</span>
                </a>
            </li>
            <!-- <li class="sidebar-nav-item">
                <a href="" class="sidebar-nav-link">
                    <div>
                        <i><img src="../images/messages.png" alt=""></i>
                    </div>
                    <span>Messages</span>
                </a>
            </li> -->
            <li class="sidebar-nav-item">
                <a href="../templates/help.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="../images/help.png" alt=""></i>
                    </div>
                    <span>Help</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="../templates/profile.php" class="sidebar-nav-link sidebar-profile">
                    <div>
                        <i><img src="../images/sidebar_profile.png" alt=""></i>
                    </div>
                    <span>Workshop Name</span>
                </a>
            </li>
        </ul>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="../js/wm.js"></script>
</body>