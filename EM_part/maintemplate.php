<?php include('./constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/" href="./images/logo.jpg">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="eme.css">
    <link rel="stylesheet" href="wm.css">

</head>
<style>
.sidebar{
    margin-top: 66px;
}
.navbar-nav i {
    font-size: 2rem;
}
.navbar-nav>li>a {
    padding-top: 20px;
    padding-bottom: 10px;
    line-height: 14px;
}
.navbar-badge {
    right: -7px;
    top: 2px;
}

@media (min-width: 768px){
.navbar-nav>li>a {
    padding-top: 22px;
    padding-bottom: 15px;
}
}

    </style>
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
                <img src="./images/logo_main.jpg" alt="GVK EMRI" class="logo">
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
                    $sql = "SELECT * FROM eme_notifications WHERE Status ='unread'";
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
                        <a href="./history.php"><span style="color: blue">View all notifications</span></a>
                    </div>
                </ul>
            <?php
                    }
            ?>
            </li>
            <li class="nav-item avt-wrapper">
                <div class="avt dropdown">
                    <img src="./images/wm-profile.png" alt="Workshop Manager Image" class="dropdown-toggle" data-toggle="user-menu">
                    <ul id="user-menu" class="dropdown_menu nav-profile">
                        <li class="dropdown-menu-item green">
                            <a href="./profile_eme.php" class="dropdown-menu-link">
                                <div>
                                    <i><img src="./images/wm-profile.png" alt=""></i>
                                </div>
                                <span>Profile</span>
                            </a>
                        </li>
                        <!-- <li class="dropdown-menu-item blue">
                            <a href="#nowhere" class="dropdown-menu-link">
                                <div>
                                    <i><img src="./images/settings.png" alt=""></i>
                                </div>
                                <span>Settings</span>
                            </a>
                        </li> -->
                        <li class="dropdown-menu-item red">
                            <a href="./logoutin.html" class="dropdown-menu-link">
                                <div>
                                    <i><img src="./images/logout.png" alt=""></i>
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
                <a href="./home.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="./images/home.png" alt=""></i>
                    </div>
                    <span>Home</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="./calendar.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="./images/book_appoitment.png" alt=""></i>
                    </div>
                    <span>Book Appointment</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="view.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="./images/view_appointments.png" alt=""></i>
                    </div>
                    <span>View Appointments</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="delete.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="./images/cancel.png" alt=""></i>
                    </div>
                    <span>Cancel Appointments</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="status.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="./images/status.png" alt=""></i>
                    </div>
                    <span>Appointment Status</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="contact.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="./images/contact.png" alt=""></i>
                    </div>
                    <span>Contacts</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="./help.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="./images/help.png" alt=""></i>
                    </div>
                    <span>Help</span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="about.php" class="sidebar-nav-link">
                    <div>
                        <i><img src="./images/about.png" alt=""></i>
                    </div>
                    <span>About</span>
                </a>
            </li>

        </ul>
    </div>

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="wm.js"></script>
